<?php
/**
 * Public Lead Capture Endpoint
 * - Stores every submission in /data/leads.json (visible in CMS -> Leads & Inquiries)
 * - Forwards the same fields to Formester so existing automations keep working
 * - Optionally saves uploaded reports under /assets/uploads/leads/
 * - Supports both AJAX/JSON responses and direct HTTP 302 redirects
 */

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
       || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

function lead_respond($success, $redirectUrl, $errorMsg = '') {
    global $isAjax;
    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success'  => $success,
            'redirect' => $redirectUrl,
            'error'    => $errorMsg
        ]);
        exit;
    }
    header('Location: ' . $redirectUrl);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    lead_respond(false, '/contact-us-top-neurologist-delhi-ncr', 'Invalid request method');
}

$dataDir   = dirname(__DIR__) . '/data';
$leadsFile = $dataDir . '/leads.json';
$uploadDir = dirname(__DIR__) . '/assets/uploads/leads';

// Allowlisted Formester endpoints
$FORMESTER_URLS = [
    'main' => 'https://app.formester.com/forms/MUVNkRKYA/submissions',
    'lp'   => 'https://app.formester.com/forms/4a08Yw78e/submissions',
];
$formKey       = ($_POST['form_key'] ?? '') === 'lp' ? 'lp' : 'main';
$FORMESTER_URL = $FORMESTER_URLS[$formKey];

// ---- Honeypot: bots fill this hidden field, humans never see it -------------
if (!empty($_POST['website'])) {
    $thankYouUrl = ($formKey === 'lp') ? '/enquire/thank-you' : '/thank-you';
    lead_respond(true, $thankYouUrl);
}

// ---- Basic rate limit: 10 submissions / 10 minutes / IP ---------------------
$ip     = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rlFile = sys_get_temp_dir() . '/lead_rl_' . md5($ip);
$hits   = [];
if (is_file($rlFile)) {
    $hits = json_decode((string)file_get_contents($rlFile), true) ?: [];
}
$now  = time();
$hits = array_values(array_filter($hits, function ($t) use ($now) { return ($now - (int)$t) < 600; }));
if (count($hits) >= 10) {
    $errorBack = ($formKey === 'lp') ? '/enquire?error=rate' : '/contact-us-top-neurologist-delhi-ncr?error=rate';
    lead_respond(false, $errorBack, 'Rate limit exceeded. Please try again later.');
}
$hits[] = $now;
@file_put_contents($rlFile, json_encode($hits), LOCK_EX);

// ---- Collect + sanitize ------------------------------------------------------
function lead_clean($key, $maxLen = 500) {
    $v = trim((string)($_POST[$key] ?? ''));
    $v = strip_tags($v);
    if (function_exists('mb_substr')) {
        return mb_substr($v, 0, $maxLen);
    }
    return substr($v, 0, $maxLen);
}

$name     = lead_clean('name', 120);
$phone    = lead_clean('phone', 40);
$email    = lead_clean('email', 160);
$subject  = lead_clean('subject', 120);
$message  = lead_clean('message', 3000);
$formType = lead_clean('form_type', 120);

// Landing page uses a "condition" select instead of "subject"
if ($subject === '') {
    $subject = lead_clean('condition', 120);
}

// Fallbacks for inquiry/diagnosis fields from sub-service forms
if ($message === '') {
    $message = lead_clean('inquiry', 3000);
}
if ($message === '') {
    $message = lead_clean('diagnosis', 3000);
}

if ($formType === '') {
    $formType = $formKey === 'lp' ? 'Landing Page Appointment' : 'Website Enquiry';
}

$errorBack = ($formKey === 'lp') ? '/enquire?error=' : '/contact-us-top-neurologist-delhi-ncr?error=';

// Submissions must have at least a phone number or email or name
if ($name === '' && $phone === '' && $email === '') {
    lead_respond(false, $errorBack . 'missing', 'Please provide your contact information.');
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    lead_respond(false, $errorBack . 'email', 'Please provide a valid email address.');
}

// ---- Optional file upload ----------------------------------------------------
$savedFile = '';
if (isset($_FILES['report']) && $_FILES['report']['error'] === UPLOAD_ERR_OK) {
    $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($_FILES['report']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $allowed, true) && $_FILES['report']['size'] <= 5 * 1024 * 1024) {
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }
        $safeName = date('Ymd_His') . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['report']['name']);
        if (move_uploaded_file($_FILES['report']['tmp_name'], $uploadDir . '/' . $safeName)) {
            $savedFile = 'assets/uploads/leads/' . $safeName;
        }
    }
}
if ($savedFile !== '') {
    $message .= "\n[Uploaded report: " . $savedFile . "]";
}

// ---- Forward to Formester ---------------------------------------------------
if (function_exists('curl_init')) {
    $fields = [
        'form_type' => $formType,
        'name'      => $name,
        'phone'     => $phone,
        'email'     => $email,
        'subject'   => $subject,
        'condition' => $subject,
        'message'   => $message,
    ];
    $ch = curl_init($FORMESTER_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query($fields),
        CURLOPT_TIMEOUT        => 5,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    curl_exec($ch);
}

// ---- Thank the user: Dedicated thank-you page for LP, default for main website --
$thankYouUrl = ($formKey === 'lp') ? '/enquire/thank-you' : '/thank-you';
lead_respond(true, $thankYouUrl);


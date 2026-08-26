<?php
/**
 * Public Lead Capture Endpoint
 * - Stores every submission in /data/leads.json (visible in CMS -> Leads & Inquiries)
 * - Forwards the same fields to Formester so existing automations keep working
 * - Optionally saves uploaded reports under /assets/uploads/leads/
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../contact-us-top-neurologist-delhi-ncr');
    exit;
}

$dataDir = dirname(__DIR__) . '/data';
$leadsFile = $dataDir . '/leads.json';
$uploadDir = dirname(__DIR__) . '/assets/uploads/leads';

// Allowlisted Formester endpoints (never accept arbitrary URLs from the request)
$FORMESTER_URLS = [
    'main' => 'https://app.formester.com/forms/MUVNkRKYA/submissions',
    'lp'   => 'https://app.formester.com/forms/4a08Yw78e/submissions',
];
$formKey = ($_POST['form_key'] ?? '') === 'lp' ? 'lp' : 'main';
$FORMESTER_URL = $FORMESTER_URLS[$formKey];

// ---- Honeypot: bots fill this hidden field, humans never see it -------------
if (!empty($_POST['website'])) {
    header('Location: ../thank-you');
    exit;
}

// ---- Basic rate limit: 10 submissions / 10 minutes / IP ---------------------
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rlFile = sys_get_temp_dir() . '/lead_rl_' . md5($ip);
$hits = [];
if (is_file($rlFile)) {
    $hits = json_decode((string)file_get_contents($rlFile), true) ?: [];
}
$now = time();
$hits = array_values(array_filter($hits, function ($t) use ($now) { return ($now - (int)$t) < 600; }));
if (count($hits) >= 10) {
    header('Location: ../contact-us-top-neurologist-delhi-ncr?error=rate');
    exit;
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

if ($formType === '') {
    $formType = $formKey === 'lp' ? 'Landing Page Appointment' : 'Website Enquiry';
}

// Newsletter-style submissions may only carry an email
if ($name === '' && $email === '') {
    header('Location: ../contact-us-top-neurologist-delhi-ncr?error=missing');
    exit;
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../contact-us-top-neurologist-delhi-ncr?error=email');
    exit;
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

// ---- Store locally -----------------------------------------------------------
if (!is_dir($dataDir)) {
    @mkdir($dataDir, 0755, true);
}

$lead = [
    'id'         => bin2hex(random_bytes(8)),
    'created_at' => date('Y-m-d H:i:s'),
    'name'       => $name,
    'phone'      => $phone,
    'email'      => $email,
    'source'     => $formType,
    'subject'    => $subject,
    'message'    => $message,
];

$leads = [];
if (is_file($leadsFile)) {
    $decoded = json_decode((string)file_get_contents($leadsFile), true);
    if (is_array($decoded)) {
        $leads = $decoded;
    }
}
$leads[] = $lead;

$tmp = $leadsFile . '.tmp.' . uniqid();
if (@file_put_contents($tmp, json_encode($leads, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), LOCK_EX) !== false) {
    @rename($tmp, $leadsFile);
}

// ---- Forward to Formester (best effort, never blocks the user) ---------------
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
    curl_close($ch);
}

// ---- Thank the user ------------------------------------------------------------
header('Location: ../thank-you');
exit;

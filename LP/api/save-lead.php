<?php
/**
 * Lead Capture Endpoint - Dr. Praveen Gupta Landing Page (/LP)
 * - Stores every submission in /data/leads.json (visible in CMS -> Leads & Inquiries)
 * - Forwards the same fields to Formester LP endpoint
 * - Redirects the user to the thank you page
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

// Locate data directory (prefer parent project data/ if present, fallback to local LP/data/)
$parentDataDir = dirname(dirname(__DIR__)) . '/data';
if (is_dir($parentDataDir) || is_file(dirname(dirname(__DIR__)) . '/includes/config.php')) {
    $dataDir = $parentDataDir;
} else {
    $dataDir = dirname(__DIR__) . '/data';
}
$leadsFile = $dataDir . '/leads.json';

// Formester LP endpoint
$FORMESTER_URL = 'https://app.formester.com/forms/4a08Yw78e/submissions';

// ---- Honeypot ---------------------------------------------------------------
if (!empty($_POST['website'])) {
    header('Location: ../thank-you');
    exit;
}

// ---- Basic rate limit: 10 submissions / 10 minutes / IP ---------------------
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$rlFile = sys_get_temp_dir() . '/lp_lead_rl_' . md5($ip);
$hits = [];
if (is_file($rlFile)) {
    $hits = json_decode((string)file_get_contents($rlFile), true) ?: [];
}
$now = time();
$hits = array_values(array_filter($hits, function ($t) use ($now) { return ($now - (int)$t) < 600; }));
if (count($hits) >= 10) {
    header('Location: ../index.php?error=rate');
    exit;
}
$hits[] = $now;
@file_put_contents($rlFile, json_encode($hits), LOCK_EX);

// ---- Collect + sanitize ------------------------------------------------------
function lp_lead_clean($key, $maxLen = 500) {
    $v = trim((string)($_POST[$key] ?? ''));
    $v = strip_tags($v);
    if (function_exists('mb_substr')) {
        return mb_substr($v, 0, $maxLen);
    }
    return substr($v, 0, $maxLen);
}

$name     = lp_lead_clean('name', 120);
$phone    = lp_lead_clean('phone', 40);
$email    = lp_lead_clean('email', 160);
$subject  = lp_lead_clean('condition', 120);
$message  = lp_lead_clean('message', 3000);
$formType = lp_lead_clean('form_type', 120);

if ($subject === '') {
    $subject = lp_lead_clean('subject', 120);
}
if ($formType === '') {
    $formType = 'Landing Page Appointment';
}

if ($name === '' && $phone === '') {
    header('Location: ../index.php?error=missing');
    exit;
}

// Formester endpoint
$FORMESTER_URL = 'https://app.formester.com/forms/4a08Yw78e/submissions';

// ---- Forward to Formester ----------------------------------------------------
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

// ---- Redirect to Thank You page ----------------------------------------------
header('Location: ../thank-you');
exit;

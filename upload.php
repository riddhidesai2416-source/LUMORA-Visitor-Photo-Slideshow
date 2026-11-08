<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
function fail_upload(): never { header('Location: index.php?status=error#share'); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verify_csrf() || empty($_POST['consent'])) fail_upload();
$name = trim($_POST['name'] ?? '');
$mobile = preg_replace('/\D+/', '', $_POST['mobile'] ?? '');
if ($name === '' || mb_strlen($name) > 100 || strlen($mobile) < 10 || strlen($mobile) > 15) fail_upload();
if (!isset($_FILES['photos']) || !is_array($_FILES['photos']['name'])) fail_upload();
$names = $_FILES['photos']['name'];
if (count($names) < 1 || count($names) > 10) fail_upload();
$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare('SELECT id, name FROM visitors WHERE mobile = ?');
    $stmt->execute([$mobile]);
    $visitor = $stmt->fetch();
    if ($visitor) {
        $visitorId = (int)$visitor['id'];
        $pdo->prepare('UPDATE visitors SET name = ?, last_visit = NOW() WHERE id = ?')->execute([$name, $visitorId]);
    } else {
        $pdo->prepare('INSERT INTO visitors (name, mobile, first_visit, last_visit) VALUES (?, ?, NOW(), NOW())')->execute([$name, $mobile]);
        $visitorId = (int)$pdo->lastInsertId();
    }
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $allowed = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp'];
    $insert = $pdo->prepare('INSERT INTO photos (visitor_id, filename, original_name, status, consent_given, consent_at, uploaded_at) VALUES (?, ?, ?, "pending", 1, NOW(), NOW())');
    $saved = [];
    foreach ($names as $i => $original) {
        if ($_FILES['photos']['error'][$i] !== UPLOAD_ERR_OK || $_FILES['photos']['size'][$i] > 5 * 1024 * 1024) throw new RuntimeException('Invalid upload');
        $tmp = $_FILES['photos']['tmp_name'][$i];
        $mime = $finfo->file($tmp);
        if (!isset($allowed[$mime]) || !getimagesize($tmp)) throw new RuntimeException('Invalid image');
        $filename = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
        if (!move_uploaded_file($tmp, $uploadDir . $filename)) throw new RuntimeException('Could not store image');
        $saved[] = $filename;
        $insert->execute([$visitorId, $filename, basename($original)]);
    }
    $pdo->commit();
    header('Location: index.php?status=success#share');
} catch (Throwable $ex) {
    $pdo->rollBack();
    foreach (($saved ?? []) as $filename) if (is_file(__DIR__ . '/uploads/' . $filename)) unlink(__DIR__ . '/uploads/' . $filename);
    error_log('LUMORA upload: ' . $ex->getMessage());
    fail_upload();
}

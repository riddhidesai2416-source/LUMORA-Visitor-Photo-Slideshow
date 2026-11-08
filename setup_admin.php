<?php
// Run once from localhost/LUMORA_Visitor_Photo_Slideshow/setup_admin.php, then DELETE this file.
require_once __DIR__.'/config/database.php';
$username='admin'; $password='ChangeMe123!';
$hash=password_hash($password,PASSWORD_DEFAULT);
$pdo->prepare('INSERT INTO admins (username,password_hash) VALUES (?,?) ON DUPLICATE KEY UPDATE password_hash=VALUES(password_hash)')->execute([$username,$hash]);
echo 'Admin created. Username: admin | Temporary password: ChangeMe123! Change it before public deployment, then delete setup_admin.php.';

<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
$notice = $_GET['status'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>LUMORA | Memories in Motion</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="site-bg">
<nav class="navbar navbar-expand-lg navbar-dark px-4 py-3"><a class="navbar-brand brand" href="index.php">LUMORA<span>.</span></a><div class="ms-auto d-flex gap-3"><a class="nav-link" href="slideshow.php">Live slideshow</a><a class="nav-link" href="admin/login.php">Admin</a></div></nav>
<main class="container py-5">
<div class="row align-items-center g-5">
<section class="col-lg-6">
<div class="eyebrow">MEMORIES IN MOTION</div>
<h1 class="hero-title">Every visit.<br><span>A memory that stays.</span></h1>
<p class="lead muted">Share your moments and see them become part of our living photo wall.</p>
<div class="d-flex gap-3 flex-wrap mt-4"><a class="btn btn-glow" href="#share">Share your photos</a><a class="btn btn-outline-light rounded-pill px-4" href="slideshow.php">Explore the wall ↗</a></div>
<div class="stats-row mt-5"><div><strong>10s</strong><small>Per photo</small></div><div><strong>LIVE</strong><small>Auto-updating wall</small></div><div><strong>SAFE</strong><small>Consent-first sharing</small></div></div>
</section>
<section class="col-lg-6">
<div class="visual-stage"><div class="orb orb-one"></div><div class="orb orb-two"></div><div class="floating-card card-back">YOUR MOMENTS<br><small>beautifully remembered</small></div><div class="floating-card card-front"><div class="photo-placeholder">✦</div><div class="card-caption"><b>A wall of memories</b><small>Created together</small></div></div></div>
</section>
</div>
<section id="share" class="glass-panel mt-5 p-4 p-md-5">
<div class="row g-4"><div class="col-lg-4"><div class="eyebrow">ADD TO THE STORY</div><h2 class="section-title">Share your<br>memories.</h2><p class="muted">Returning visitor? Use the same mobile number to connect your new photos with your earlier visit.</p><div class="small muted">Accepted: JPG, JPEG, PNG, WEBP · Maximum 5 MB each</div></div>
<div class="col-lg-8">
<?php if($notice==='success'): ?><div class="alert alert-success">Your photos were uploaded and are awaiting approval. Thank you!</div><?php elseif($notice==='error'): ?><div class="alert alert-danger">Upload could not be completed. Please check your details and try again.</div><?php endif; ?>
<form action="upload.php" method="post" enctype="multipart/form-data" class="row g-3">
<input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
<div class="col-md-6"><label class="form-label">Your name</label><input class="form-control lumora-input" name="name" maxlength="100" required></div>
<div class="col-md-6"><label class="form-label">Mobile number</label><input class="form-control lumora-input" name="mobile" inputmode="numeric" pattern="[0-9+\-\s]{10,16}" maxlength="16" required placeholder="10-digit mobile number"></div>
<div class="col-12"><label class="form-label">Choose your photos</label><input class="form-control lumora-input" type="file" name="photos[]" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" multiple required><div id="fileHint" class="form-text text-light-emphasis">Up to 10 images per upload, 5 MB each.</div></div>
<div class="col-12"><label class="consent"><input type="checkbox" name="consent" value="1" required> I give permission for these photos to be reviewed and, if approved, displayed on the public slideshow. I understand I can request their removal.</label></div>
<div class="col-12"><button class="btn btn-glow" type="submit">Upload memories <span>↗</span></button></div>
</form></div></div>
</section>
</main>
<footer class="text-center py-4 muted small">LUMORA · A consent-first visitor photo experience</footer>
<script src="assets/js/app.js"></script>
</body></html>
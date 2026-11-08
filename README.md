# LUMORA – Visitor Photo Slideshow

A PHP + MySQL visitor photo sharing and moderated slideshow application built for Assignment 1.

## Features
- Visitor registration using a mobile number to identify returning visitors.
- Multiple image uploads (JPG/JPEG/PNG/WEBP; maximum 5 MB each; maximum 10 per submission).
- Explicit consent recorded with upload time.
- New uploads start as **pending** and are not public until approved by an administrator.
- Full-screen slideshow of approved images, changing every 10 seconds and polling for updates every 10 seconds.
- Admin photo moderation and basic statistics.

## Requirements
- XAMPP with Apache, PHP 8+ and MySQL/MariaDB.
- Google Chrome or another modern browser.

## Installation
1. Copy the `LUMORA_Visitor_Photo_Slideshow` folder into `C:\xampp\htdocs\`.
2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql` (or open it in the SQL tab and run it).
5. Check database settings in `config/database.php`. XAMPP defaults are `localhost`, database `visitor_slideshow`, user `root`, empty password.
6. Ensure `uploads/` exists and is writable by PHP.
7. Open `http://localhost/LUMORA_Visitor_Photo_Slideshow/`.
8. Create the first admin by visiting `http://localhost/LUMORA_Visitor_Photo_Slideshow/setup_admin.php` once.
   - Temporary username: `admin`
   - Temporary password: `ChangeMe123!`
9. **Immediately delete `setup_admin.php` after creating the admin.** For a real deployment, change the temporary password and use a strong database password.
10. Admin login: `http://localhost/LUMORA_Visitor_Photo_Slideshow/admin/login.php`.
11. Slideshow: `http://localhost/LUMORA_Visitor_Photo_Slideshow/slideshow.php`.

## Database
The supplied `database.sql` creates `visitors`, `photos`, `admins`, and `removal_requests`. Visitor mobile number is unique. Photo records reference their visitor.

## Notes and limitations
- This is a college assignment starter implementation. Test it locally before demonstration.
- Removal requests are represented in the schema but a public request form and admin workflow are not yet implemented.
- The application does not include an automated deployment URL. Add one to this README only after deploying.
- Use a public GitHub repository for assignment submission, but never commit real credentials or personal visitor photos.

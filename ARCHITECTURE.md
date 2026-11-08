# Architecture

## Stack and reasons
- **Core PHP:** straightforward server-side handling and suitable for the required XAMPP environment.
- **MySQL:** relational storage for visitors, photos and administrator accounts.
- **HTML/CSS/JavaScript:** browser interface and timed slideshow.
- **PDO prepared statements:** parameterized database access.

## Main data model
- `visitors` 1 — many `photos`
- `admins` stores password hashes for administrator login.
- `removal_requests` is reserved for future removal-request workflow.

## Upload workflow
1. Visitor submits name, mobile number, image files and consent.
2. Server validates CSRF token, visitor fields, file count, upload errors, size, MIME type and image readability.
3. Existing visitor is found by normalized mobile number or a new visitor is created.
4. Images are assigned random filenames and stored in `uploads/`.
5. Photo metadata and consent timestamp are stored in MySQL with `pending` status.
6. Administrator reviews and approves/rejects the photo.

## Slideshow workflow
1. `slideshow.php` loads the display shell.
2. `assets/js/slideshow.js` requests `api/photos.php`.
3. API returns only approved photos.
4. Browser displays one image for 10 seconds and polls for new approved photos every 10 seconds.

## Architecture diagram
```text
Visitor Browser
   | name + mobile + images + consent
   v
index.php --> upload.php --> PHP validation
                              |          |
                              v          v
                         uploads/     MySQL
                                      visitors
                                      photos (pending)
                                          |
                                          v
Admin Browser --> admin/dashboard.php --> approve/reject
                                          |
                                          v
TV / Display --> slideshow.php --> api/photos.php
                                      |
                                      v
                               approved photos only
```

## Security considerations
Uploads are MIME-checked server-side, renamed randomly, and stored outside the executable PHP code path. Admin passwords are hashed. Sensitive forms use CSRF tokens. Public API returns no mobile numbers and only approved image records.

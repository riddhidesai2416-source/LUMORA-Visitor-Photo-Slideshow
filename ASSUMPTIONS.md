# Assumptions

1. **Visitor identity:** The brief asks how returning visitors are identified but does not specify an identifier. This implementation uses a normalized mobile number because it is familiar and can be entered on each visit. A unique database constraint prevents duplicate visitor records.
2. **Photo duration:** The brief says each photo plays for a specific duration but does not define it. The slideshow uses 10 seconds per photo.
3. **Approval before public display:** The brief requires privacy and consent but does not specify a moderation workflow. Every upload requires explicit consent and starts in `pending`; an admin must approve it before it appears publicly.
4. **Accepted formats:** The brief does not list formats. JPG/JPEG, PNG and WEBP are supported.
5. **Upload limits:** The brief does not specify limits. Each image is limited to 5 MB and each submission to 10 images.
6. **Simultaneous uploads:** Unique random filenames and independent database records avoid filename collisions. PHP/MySQL handle separate requests; local XAMPP capacity still depends on server configuration.
7. **Slideshow refresh:** The brief says a completed upload should play as soon as possible. The display polls approved-photo data every 10 seconds; newly uploaded photos appear after approval and the next refresh.
8. **Returning visitor photos:** All previously approved photos belonging to the identified visitor remain associated with that visitor and are eligible for the shared slideshow.
9. **Admin account:** A local development admin is created using a one-time setup helper. The helper must be deleted immediately after use.
10. **Deployment:** No hosting provider or domain was specified, so the project is delivered for local XAMPP execution. A deployed link can be added after deployment.

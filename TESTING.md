# Manual Test Plan

Run each test locally and replace the result column with the actual observed result before submission.

| Test | Steps | Expected result | Actual result |
|---|---|---|---|
| New visitor | Submit a new name, mobile and valid image with consent. | Visitor is created; image is pending. | Not yet tested |
| Returning visitor | Submit again with the same mobile. | Existing visitor is reused; no duplicate visitor. | Not yet tested |
| Multiple images | Upload 2–3 valid images. | Each gets its own photo record. | Not yet tested |
| Invalid file | Rename a non-image file to `.jpg` and upload. | Server rejects it. | Not yet tested |
| Oversized image | Upload image over 5 MB. | Server rejects it. | Not yet tested |
| Consent | Submit without checking consent. | Submission is rejected. | Not yet tested |
| Approval | Admin approves a pending photo. | Photo status becomes approved. | Not yet tested |
| Slideshow | Open slideshow after approval. | Approved photo appears. | Not yet tested |
| Auto refresh | Approve another photo while slideshow is open. | New photo is loaded after polling. | Not yet tested |
| Previous photo | Returning visitor uploads another photo. | Both approved photos remain linked to that visitor. | Not yet tested |
| Delete | Admin deletes a photo. | DB record and stored file are removed. | Not yet tested |
| Admin protection | Open dashboard without login. | Redirect to login. | Not yet tested |
| Concurrent upload | Submit from two browser sessions close together. | Filenames do not overwrite each other. | Not yet tested |

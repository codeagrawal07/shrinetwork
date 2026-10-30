
# SHRI NETWORK – Informational Website

A lightweight PHP website for Hostinger shared hosting. This is an informational website only:
Home, About, Plans and Contact. It does **not** include registration, member login, wallet,
matrix placement, payments or MLM management software.

## Requirements
- PHP 8.1+ recommended
- Apache hosting (Hostinger shared hosting is suitable)
- MySQL is not required for this version
- Composer for PHPMailer installation

## Pages
- `index.php` – Home
- `about.php` – About
- `plans.php` – Plan cards
- `contact.php` – Contact form using PHPMailer SMTP

## Update plan cards using JSON
Edit `config/plans.json`. Each plan supports:
- `name`, `price`, `subtitle`, `description`
- `product_name`, `product_pack`, `matrix_label`
- `image` (path relative to website root)
- `card_color`, `text_color`, `button_color`
- `featured`, `active`

To add a plan, copy one plan object inside the `plans` array, change its `id` to a unique value,
and save valid JSON. Set `active` to `false` to hide a plan. Upload product images into
`assets/images/` and set the `image` path accordingly.

The default ₹25 and ₹50 product descriptions are based on the supplied reference PDFs. The
₹100 and ₹200 descriptions are intentionally marked for confirmation because the supplied
reference does not define their product packs.

## Install on Hostinger
1. Download and extract the ZIP.
2. Open Hostinger hPanel → Websites → Manage → File Manager.
3. Upload the contents of this project into `public_html/` (not the enclosing project folder).
4. In hPanel, select a supported PHP version (PHP 8.1 or newer recommended).
5. Create a Hostinger email account for your domain.
6. On your computer, run `composer install` in this project folder, then upload the generated
   `vendor/` folder and `composer.lock` to `public_html/`. Alternatively, use SSH/Terminal if
   your hosting plan supports Composer.
7. Copy `config/mail.example.php` to `config/mail.php`.
8. Edit `config/mail.php` with your actual Hostinger SMTP username, password, sender and
   receiving email. Use `smtp.hostinger.com`, port `587`, STARTTLS for a typical Hostinger
   email setup. Confirm the exact values in your hPanel/email setup.
9. Visit `https://yourdomain.com/contact.php` and submit a test enquiry.
10. Confirm the message arrives. Check spam and Hostinger email logs if necessary.

## Important security notes
- Never upload `mail.example.php` with real credentials. Keep real SMTP details in `mail.php`.
- Do not share SMTP passwords or commit them to a public repository.
- Use HTTPS and keep PHP updated.
- Configure a backup and test the contact form after deployment.
- Consider adding a privacy notice and consent checkbox before collecting visitor information.

## Business-content note
Plan descriptions and matrix labels are informational only. Do not publish guaranteed income,
returns or recruitment-based reward claims. Have all product, direct-selling and compensation
claims reviewed for applicable Indian legal requirements before publishing.

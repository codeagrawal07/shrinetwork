<?php
$pageTitle='Contact Us';
$success = false; $error = '';
$selectedPlan = trim($_GET['plan'] ?? '');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $token = $_SESSION['contact_csrf'] ?? '';
    if (!isset($_POST['csrf_token']) || !hash_equals($token, (string)$_POST['csrf_token'])) {
        $error = 'Your session could not be verified. Please refresh the page and try again.';
    } elseif (!empty($_POST['website'])) {
        $error = 'Unable to process your request.';
    } else {
        $name = trim(strip_tags($_POST['name'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
        $phone = preg_replace('/[^0-9+()\\- ]/', '', trim($_POST['phone'] ?? ''));
        $plan = trim(strip_tags($_POST['plan'] ?? 'General enquiry'));
        $message = trim(strip_tags($_POST['message'] ?? ''));
        if ($name === '' || !$email || $message === '') {
            $error = 'Please enter your name, a valid email address and your message.';
        } else {
            // Configure SMTP in config/mail.php after installing PHPMailer with Composer.
            $mailConfigPath = __DIR__ . '/config/mail.php';
            if (file_exists($mailConfigPath)) {
                $mailConfig = require $mailConfigPath;
                $autoload = __DIR__ . '/vendor/autoload.php';
                if (file_exists($autoload)) {
                    require_once $autoload;
                    try {
                        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = $mailConfig['host'];
                        $mail->SMTPAuth = true;
                        $mail->Username = $mailConfig['username'];
                        $mail->Password = $mailConfig['password'];
                        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = (int)$mailConfig['port'];
                        $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
                        $mail->addAddress($mailConfig['to_email'], $mailConfig['to_name']);
                        $mail->addReplyTo($email, $name);
                        $mail->isHTML(false);
                        $mail->Subject = 'Website enquiry - SHRI NETWORK';
                        $mail->Body = "Name: {$name}\\nEmail: {$email}\\nPhone: {$phone}\\nPlan: {$plan}\\n\\nMessage:\\n{$message}";
                        $mail->send();
                        $success = true;
                    } catch (Throwable $e) {
                        error_log('SHRI NETWORK mail error: ' . $e->getMessage());
                        $error = 'We could not send your message right now. Please try again later.';
                    }
                } else {
                    $error = 'Email service is not installed yet. Please install PHPMailer using Composer.';
                }
            } else {
                $error = 'Email settings are not configured yet. Please complete config/mail.php.';
            }
        }
    }
}
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (empty($_SESSION['contact_csrf'])) $_SESSION['contact_csrf'] = bin2hex(random_bytes(32));
include 'includes/header.php';
?>
<section class="page-hero"><div class="container"><span class="eyebrow">We are here to help</span><h1>Contact Us</h1><p>Send your question to the SHRI NETWORK team. Please provide accurate contact details so we can respond.</p></div></section>
<section class="section"><div class="container contact-grid">
  <aside class="contact-info"><h2>Get in touch</h2><p>For plan details, product information, availability or general enquiries, use the form or contact the company through its official channels.</p><div class="contact-item"><small>Company</small><strong>SHRI NETWORK</strong></div><div class="contact-item"><small>Enquiry support</small><strong>Submit the form on this page</strong></div><div class="contact-item"><small>Response</small><strong>Our team will reply to the email address you provide.</strong></div></aside>
  <div class="contact-form"><h2>Send an enquiry</h2>
    <?php if ($success): ?><div class="form-message">Thank you. Your enquiry has been sent successfully.</div><?php endif; ?>
    <?php if ($error): ?><div class="form-message error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post" action="contact.php" novalidate>
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['contact_csrf']) ?>">
      <div style="position:absolute;left:-9999px" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
      <div class="form-row"><label for="name">Full name *</label><input id="name" name="name" required maxlength="100" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"></div>
      <div class="form-row"><label for="email">Email address *</label><input id="email" type="email" name="email" required maxlength="160" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></div>
      <div class="form-row"><label for="phone">Phone number</label><input id="phone" name="phone" maxlength="25" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"></div>
      <div class="form-row"><label for="plan">Interested plan</label><select id="plan" name="plan" style="width:100%;padding:13px;border:1px solid #cbdccc;border-radius:12px;font:inherit"><option>General enquiry</option><?php foreach (['Basic Plan - ₹25','Silver Plan - ₹50','Gold Plan - ₹100','Premium Plan - ₹200'] as $p): ?><option <?= (($_POST['plan'] ?? $selectedPlan) === $p || ($_POST['plan'] ?? $selectedPlan) === str_replace(' Plan','',$p)) ? 'selected' : '' ?>><?= htmlspecialchars($p) ?></option><?php endforeach; ?></select></div>
      <div class="form-row"><label for="message">Your message *</label><textarea id="message" name="message" required maxlength="4000"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea></div>
      <button class="btn" type="submit">Send Message</button>
    </form>
  </div>
</div></section>
<?php include 'includes/footer.php'; ?>

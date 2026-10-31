<?php
$configFile = __DIR__ . '/../config/plans.json';
$config = json_decode(file_get_contents($configFile), true);
$plans = $config['plans'] ?? [];
$activePlans = array_values(array_filter($plans, fn($p) => !empty($p['active'])));
?>
<div class="plan-grid">
<?php foreach ($activePlans as $plan): ?>
  <article class="plan-card <?= !empty($plan['featured']) ? 'featured' : '' ?>"
    style="--card-bg:<?= htmlspecialchars($plan['card_color'] ?? '#fff') ?>;--card-text:<?= htmlspecialchars($plan['text_color'] ?? '#155b35') ?>;--button-color:<?= htmlspecialchars($plan['button_color'] ?? '#155b35') ?>">
    <img src="<?= htmlspecialchars($plan['image'] ?? 'assets/images/toothbrush.svg') ?>" alt="<?= htmlspecialchars($plan['product_name'] ?? $plan['name']) ?>">
    <span class="plan-subtitle"><?= htmlspecialchars($plan['subtitle'] ?? '') ?></span>
    <h3><?= htmlspecialchars($plan['name']) ?></h3>
    <div class="plan-price">₹<?= number_format((float)$plan['price'], 0) ?></div>
    <p><?= htmlspecialchars($plan['description'] ?? '') ?></p>
    <div class="plan-meta"><strong>Product:</strong> <?= htmlspecialchars($plan['product_name'] ?? 'Details to be updated') ?><br>
    <strong>Pack:</strong> <?= htmlspecialchars($plan['product_pack'] ?? 'Please enquire') ?><br>
    <strong>Structure:</strong> <?= htmlspecialchars($plan['matrix_label'] ?? 'Please enquire') ?></div>
    <a class="btn" href="contact.php?plan=<?= urlencode($plan['name']) ?>">Enquire about this plan</a>
  </article>
<?php endforeach; ?>
</div>

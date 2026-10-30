<?php $pageTitle='Home'; include 'includes/header.php'; ?>
<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="eyebrow">Welcome to SHRI NETWORK</span>
      <h1>Good choices begin with the right connection.</h1>
      <p>Explore our product plans, learn about our approach, and connect with the SHRI NETWORK team for clear information and support.</p>
      <div class="hero-actions"><a class="btn" href="plans.php">Explore Plans</a><a class="btn btn-outline" href="about.php">About SHRI NETWORK</a></div>
    </div>
    <div class="hero-art"><img src="assets/images/toothbrush.svg" alt="Bamboo toothbrush product illustration"></div>
  </div>
</section>
<section class="section">
  <div class="container">
    <div class="section-head"><span class="eyebrow">Our plans</span><h2>Choose a plan to explore</h2><p>Compare the available plan cards and contact us if you need product or pack details.</p></div>
    <?php include 'includes/plan-cards.php'; ?>
    <p class="plan-note">Plan information is provided for general reference. Product contents, prices, availability and applicable terms should be confirmed with SHRI NETWORK before placing an order.</p>
  </div>
</section>
<section class="section" style="padding-top:0">
  <div class="container">
    <div class="feature-grid">
      <div class="feature"><div class="feature-icon">🌿</div><h3>Product information</h3><p>Review product and pack details displayed with each available plan.</p></div>
      <div class="feature"><div class="feature-icon">🤝</div><h3>Clear communication</h3><p>Reach our team with questions about plans, products and company information.</p></div>
      <div class="feature"><div class="feature-icon">📩</div><h3>Personal assistance</h3><p>Send an enquiry through the contact form and our team can follow up with you.</p></div>
    </div>
  </div>
</section>
<section class="section" style="padding-top:0"><div class="container"><div class="cta"><div><h2>Have a question?</h2><p>Contact SHRI NETWORK for current product and plan information.</p></div><a class="btn" href="contact.php">Contact Us</a></div></div></section>
<?php include 'includes/footer.php'; ?>

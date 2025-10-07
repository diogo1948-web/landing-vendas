<?php require __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Men's Force — Bonuses Portal</title>
    <meta name="description" content="Get access to all your Men's Force bonuses">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
    <style>
      /* Minor helpers to reflect Men's Force brand in header */
      .logo-mens { color:#fff; font-weight:800; letter-spacing:2px; font-size: 1.25rem; display:inline-block; }
      .logo-force { color:#dc2626; font-weight:800; letter-spacing:2px; font-style:italic; margin-top:0; display:inline-block; }
      .hero-mens { color:#ffffff; display:inline-block; }
      .hero-force { color:#dc2626; display:inline-block; font-style: italic; }

      /* Instructions Section */
      .instructions-section {
        padding: 60px 20px;
        background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);
      }

      .instructions-box {
        max-width: 960px;
        margin: 0 auto;
        background: white;
        border-radius: 24px;
        padding: 48px 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 3px solid #dc2626;
        position: relative;
      }

      .instructions-badge {
        display: inline-block;
        background: #dc2626;
        color: white;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 1px;
        margin-bottom: 20px;
      }

      .instructions-title {
        font-size: 36px;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0 0 36px 0;
        text-align: center;
      }

      .instruction-card {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        padding: 28px 32px;
        border-radius: 16px;
        margin-bottom: 20px;
        border-left: 5px solid;
        transition: transform 0.2s ease;
      }

      .instruction-card:hover {
        transform: translateX(4px);
      }

      .instruction-card:last-child {
        margin-bottom: 0;
      }

      .pink-card {
        background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
        border-left-color: #ec4899;
      }

      .pink-card .instruction-icon {
        color: #ec4899;
      }

      .blue-card {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-left-color: #3b82f6;
      }

      .blue-card .instruction-icon {
        color: #3b82f6;
      }

      .green-card {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-left-color: #10b981;
      }

      .green-card .instruction-icon {
        color: #10b981;
      }

      .instruction-icon {
        flex-shrink: 0;
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .instruction-content {
        flex: 1;
      }

      .instruction-content h3 {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 8px 0;
      }

      .instruction-content p {
        font-size: 16px;
        line-height: 1.6;
        color: #4a4a4a;
        margin: 0;
      }

      .instruction-content p strong {
        color: #dc2626;
        font-weight: 700;
      }

      .instruction-content a {
        color: #10b981;
        text-decoration: none;
        font-weight: 600;
      }

      .instruction-content a:hover {
        text-decoration: underline;
      }

      @media (max-width: 768px) {
        .instructions-section {
          padding: 40px 16px;
        }

        .instructions-box {
          padding: 32px 24px;
          border-width: 2px;
        }

        .instructions-title {
          font-size: 28px;
          margin-bottom: 28px;
        }

        .instruction-card {
          flex-direction: column;
          padding: 24px;
          gap: 16px;
        }

        .instruction-icon {
          width: 48px;
          height: 48px;
        }

        .instruction-content h3 {
          font-size: 20px;
        }

        .instruction-content p {
          font-size: 15px;
        }
      }

      /* Terms Modal */
      .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(4px);
        animation: fadeIn 0.3s ease;
      }

      .modal-overlay.active {
        display: flex;
      }

      .modal-content {
        background: white;
        border-radius: 20px;
        max-width: 700px;
        width: 100%;
        max-height: 85vh;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border: 3px solid #dc2626;
        animation: slideUp 0.3s ease;
        display: flex;
        flex-direction: column;
      }

      .modal-header {
        padding: 32px 40px;
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #991b1b;
      }

      .modal-header h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 0.5px;
      }

      .modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid white;
        color: white;
        font-size: 32px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        line-height: 1;
        padding: 0;
      }

      .modal-close:hover {
        background: white;
        color: #dc2626;
        transform: rotate(90deg);
      }

      .modal-body {
        padding: 40px;
        overflow-y: auto;
        flex: 1;
      }

      .modal-body h3 {
        margin: 0 0 20px 0;
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        padding-bottom: 12px;
        border-bottom: 3px solid #dc2626;
      }

      .modal-body p {
        margin: 0;
        line-height: 1.8;
        font-size: 16px;
        color: #4a4a4a;
        text-align: justify;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }

      @keyframes slideUp {
        from {
          transform: translateY(30px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
      }

      @media (max-width: 768px) {
        .modal-content {
          max-width: 100%;
          max-height: 90vh;
          border-radius: 16px;
        }

        .modal-header {
          padding: 24px;
        }

        .modal-header h2 {
          font-size: 22px;
        }

        .modal-close {
          width: 38px;
          height: 38px;
          font-size: 28px;
        }

        .modal-body {
          padding: 24px;
        }

        .modal-body h3 {
          font-size: 20px;
          margin-bottom: 16px;
        }

        .modal-body p {
          font-size: 15px;
          line-height: 1.7;
        }
      }

      /* Label Information Section */
      .label-info-section {
        padding: 60px 20px;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .label-info-button {
        display: flex;
        align-items: center;
        gap: 16px;
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
        border: none;
        padding: 20px 48px;
        border-radius: 16px;
        font-size: 20px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(220, 38, 38, 0.3);
        letter-spacing: 0.5px;
      }

      .label-info-button:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(220, 38, 38, 0.4);
        background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
      }

      .label-info-button:active {
        transform: translateY(-2px);
      }

      .label-info-icon {
        display: flex;
        align-items: center;
        justify-content: center;
      }

      /* Label Modal Specific Styles */
      .label-modal-content {
        max-width: 800px;
      }

      .label-modal-body {
        padding: 32px 40px;
      }

      .label-section {
        margin-bottom: 28px;
        padding-bottom: 24px;
        border-bottom: 2px solid #f3f4f6;
      }

      .label-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
      }

      .label-section p {
        margin: 8px 0;
        line-height: 1.7;
        font-size: 15px;
        color: #374151;
      }

      .label-section h4 {
        margin: 0 0 12px 0;
        font-size: 18px;
        font-weight: 700;
        color: #dc2626;
      }

      .ingredients-list,
      .warning-list {
        list-style: none;
        padding: 0;
        margin: 12px 0 0 0;
      }

      .ingredients-list li,
      .warning-list li {
        padding: 8px 0 8px 28px;
        position: relative;
        line-height: 1.6;
        color: #374151;
        font-size: 15px;
      }

      .ingredients-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #10b981;
        font-weight: 700;
        font-size: 18px;
      }

      .warning-list li:before {
        content: "⚠";
        position: absolute;
        left: 0;
        font-size: 16px;
      }

      .warning-section {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        padding: 20px;
        border-radius: 12px;
        border: 2px solid #f59e0b;
        border-bottom: 2px solid #f59e0b;
      }

      .warning-section h4 {
        color: #b45309;
      }

      .manufacturer-section {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        padding: 20px;
        border-radius: 12px;
      }

      .manufacturer-section p {
        margin: 8px 0;
      }

      @media (max-width: 768px) {
        .label-info-section {
          padding: 40px 16px;
        }

        .label-info-button {
          padding: 16px 32px;
          font-size: 18px;
          gap: 12px;
        }

        .label-info-icon svg {
          width: 28px;
          height: 28px;
        }

        .label-modal-body {
          padding: 24px;
        }

        .label-section {
          margin-bottom: 20px;
          padding-bottom: 20px;
        }

        .label-section h4 {
          font-size: 16px;
        }

        .label-section p {
          font-size: 14px;
        }

        .ingredients-list li,
        .warning-list li {
          font-size: 14px;
          padding-left: 24px;
        }
      }
    </style>
    <script>
      function openTermsModal(event) {
        event.preventDefault();
        document.getElementById('termsModal').classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeTermsModal(event) {
        event.preventDefault();
        document.getElementById('termsModal').classList.remove('active');
        document.body.style.overflow = 'auto';
      }

      function openLabelModal(event) {
        event.preventDefault();
        document.getElementById('labelModal').classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeLabelModal(event) {
        event.preventDefault();
        document.getElementById('labelModal').classList.remove('active');
        document.body.style.overflow = 'auto';
      }

      // Close modals on ESC key
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
          closeTermsModal(event);
          closeLabelModal(event);
        }
      });
    </script>
  </head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="index.php" class="logo">
                    <span class="logo-text">
                        <span class="logo-mens">MEN'S</span>
                        <span class="logo-force">FORCE</span>
                    </span>
                </a>

                <nav class="nav desktop-nav">
                    <a href="index.php" class="nav-link">Home</a>
                    <a href="logout.php" class="nav-link">Logout</a>
                </nav>

                <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <nav class="mobile-nav" id="mobileNav">
                <a href="index.php" class="nav-link">Home</a>
                <a href="logout.php" class="nav-link">Logout</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero: Men's Force only + subtitle, no buttons -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span class="hero-mens">MEN'S</span>
                        <span class="hero-force">FORCE</span>
                    </h1>
                    <p class="hero-subtitle">Get access to all your bonuses.</p>
                </div>
            </div>
        </section>

        <!-- How to Use Instructions -->
        <section class="instructions-section">
            <div class="container">
                <div class="instructions-box">
                    <div class="instructions-badge">IMPORTANT INSTRUCTIONS</div>
                    <h2 class="instructions-title">How to Use Your Men's Force</h2>

                    <div class="instruction-card pink-card">
                        <div class="instruction-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <path d="M9 11h6M12 8v6"/>
                            </svg>
                        </div>
                        <div class="instruction-content">
                            <h3>Daily Dosage</h3>
                            <p>Take <strong>1 capsule per day</strong> with water.</p>
                        </div>
                    </div>

                    <div class="instruction-card blue-card">
                        <div class="instruction-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="instruction-content">
                            <h3>Best Time</h3>
                            <p>Take at <strong>the same time every day</strong> — choose a time that works for your schedule and stick to it for best results.</p>
                        </div>
                    </div>

                    <div class="instruction-card green-card">
                        <div class="instruction-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="instruction-content">
                            <h3>Need Help?</h3>
                            <p>For questions or support, please contact: <a href="mailto:clientassistdesk@gmail.com">clientassistdesk@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Deliverables -->
        <section class="modules">
            <div class="container">
                <div class="modules-grid">
                    <a href="bonus-positions.php" class="module-card featured">
                        <div class="module-icon">❤️</div>
                        <h3>The Five Positions to Make Her Squirt</h3>
                        <p>Carefully selected positions inspired by ancient Kama Sutra to trigger deep sensitivity points and deliver new levels of pleasure.</p>
                    </a>

                    <a href="bonus-private-session.php" class="module-card">
                        <div class="module-icon">🧠</div>
                        <h3>Adult Actor Performance Masterclass</h3>
                        <p>In‑depth written protocol to build control and endurance — practical drills, pacing, and breathwork to go 30–60+ minutes.</p>
                    </a>

                    <a href="bonus-lesbian-trick.php" class="module-card">
                        <div class="module-icon">💋</div>
                        <h3>The Lesbian Trick</h3>
                        <p>Practical, explicit guide on how to make a woman climax using only your tongue and fingers — understand every pleasure button.</p>
                    </a>
                </div>
                
            </div>
        </section>

        <!-- Extra Bonuses (existing modules reused) -->
        <section class="modules">
            <div class="container">
                <div class="section-header">
                    <h2>Extra Bonuses</h2>
                    <p>Additional resources to accelerate your results.</p>
                </div>
                <div class="modules-grid">
                    <a href="bonus-audio.php" class="module-card">
                        <div class="module-icon">🎧</div>
                        <h3>3‑Minute Confidence Audio</h3>
                        <p>Quick mental reset to eliminate anxiety and activate performance confidence.</p>
                    </a>
                    <a href="aphrodisiac-african-juice.php" class="module-card">
                        <div class="module-icon">🧪</div>
                        <h3>Aphrodisiac African Juice</h3>
                        <p>Core daily protocol to support hardness, stamina, and confidence.</p>
                    </a>
                    <a href="additional-recipes.php" class="module-card">
                        <div class="module-icon">📚</div>
                        <h3>Additional Recipes</h3>
                        <p>Complementary combinations to layer on top of your main stack.</p>
                    </a>
                    <a href="daily-tips.php" class="module-card">
                        <div class="module-icon">🎯</div>
                        <h3>Daily Wellness Tips</h3>
                        <p>Simple lifestyle tweaks that compound into lasting results.</p>
                    </a>
                    <a href="exercises.php" class="module-card">
                        <div class="module-icon">💪</div>
                        <h3>Exercise Program</h3>
                        <p>Targeted exercises for control, blood flow, and endurance.</p>
                    </a>
                    <a href="foods-to-avoid.php" class="module-card">
                        <div class="module-icon">⚠️</div>
                        <h3>Foods to Avoid</h3>
                        <p>Identify and remove foods that undermine your performance.</p>
                    </a>
                    <a href="advanced-techniques.php" class="module-card">
                        <div class="module-icon">🧠</div>
                        <h3>Advanced Techniques</h3>
                        <p>Methods to intensify pleasure and control with precision.</p>
                    </a>
                    <a href="mental-preparation.php" class="module-card">
                        <div class="module-icon">❤️</div>
                        <h3>Mental Preparation</h3>
                        <p>Fast pre‑session routine to reset your mind and body.</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Label Information Section -->
        <section class="label-info-section">
            <div class="container">
                <button class="label-info-button" onclick="openLabelModal(event)">
                    <div class="label-info-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                    </div>
                    <span>Label Information</span>
                </button>
            </div>
        </section>

        <!-- Label Modal -->
        <div id="labelModal" class="modal-overlay" onclick="closeLabelModal(event)">
            <div class="modal-content label-modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>Label Information</h2>
                    <button class="modal-close" onclick="closeLabelModal(event)">&times;</button>
                </div>
                <div class="modal-body label-modal-body">
                    <div class="label-section">
                        <p><strong>30 vegetarian capsules</strong></p>
                        <p>Dietary supplement</p>
                        <p>Net quantity: 23.88 g</p>
                    </div>

                    <div class="label-section">
                        <h4>Ingredients per daily dose (1 capsule):</h4>
                        <ul class="ingredients-list">
                            <li>Maca root extract (Lepidium meyenii) – 300 mg</li>
                            <li>Tribulus terrestris extract (Tribulus terrestris) – 300 mg</li>
                            <li>Ashwagandha root extract (Withania somnifera) – 100 mg</li>
                            <li>Capsule composition – 100% hypromellose</li>
                        </ul>
                    </div>

                    <div class="label-section">
                        <h4>Directions for use:</h4>
                        <p>Take 1 capsule daily with water</p>
                    </div>

                    <div class="label-section warning-section">
                        <h4>Warning:</h4>
                        <ul class="warning-list">
                            <li>Do not exceed the recommended daily dose</li>
                            <li>Do not use as a substitute for a varied diet</li>
                            <li>Store at room temperature, out of reach of children</li>
                        </ul>
                    </div>

                    <div class="label-section manufacturer-section">
                        <p><strong>Batch:</strong> L0725 | <strong>Expiration date:</strong> July 31, 2027</p>
                        <p><strong>Batch:</strong> L0825 | <strong>Expiration date:</strong> August 31, 2027</p>
                        <p><strong>Reg. no.:</strong> П142407528</p>
                        <p style="margin-top: 16px;"><strong>Manufactured by:</strong><br>Evelin 29 EOOD, Nikolaevsko shose 3, Radomir 2400, Bulgaria</p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div>
                        <div class="footer-logo">
                            <div class="logo-endurox">MEN'S</div>
                            <div class="logo-prime">FORCE</div>
                        </div>
                        <p>Your private portal for Men's Force bonuses.</p>
                        <p style="margin-top: 8px; font-size: 14px;">Contact: <a href="mailto:clientassistdesk@gmail.com" style="color: #dc2626; text-decoration: none; font-weight: 600;">clientassistdesk@gmail.com</a></p>
                    </div>
                    <div class="footer-section">
                        <h3>Account</h3>
                        <ul>
                            <li><a class="nav-link" href="logout.php">Logout</a></li>
                            <li><a class="nav-link" href="#" onclick="openTermsModal(event)" style="cursor: pointer;">Terms and Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="copyright">
                    <p>© <?php echo date('Y'); ?> Men's Force. All rights reserved. This website is for informational purposes only.</p>
                </div>
            </div>
        </footer>

        <!-- Terms Modal -->
        <div id="termsModal" class="modal-overlay" onclick="closeTermsModal(event)">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h2>Terms and Information</h2>
                    <button class="modal-close" onclick="closeTermsModal(event)">&times;</button>
                </div>
                <div class="modal-body">
                    <h3>Limitation of Liability</h3>
                    <p>The products offered on this website are dietary supplements and should not be used as a substitute for a balanced diet or a healthy lifestyle. Results may vary significantly from person to person, depending on individual factors such as genetics, age, physical activity, diet, health conditions, among others. We do not guarantee specific results or concrete effects. The experiences shared by other users are individual testimonials and do not represent promises of effectiveness. These products are not intended to diagnose, treat, cure, or prevent any disease, nor should they be construed as medical treatments. They have also not been evaluated by the European Food Safety Authority (EFSA) or any other medical or governmental body. This website has no commercial relationship, sponsorship, or affiliation with Meta (Facebook, Instagram), TikTok, Google, or other platforms mentioned.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

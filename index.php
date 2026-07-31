<?php
require_once('sys_dbconnection.php');

$isLoggedIn = !empty($_SESSION['MatriID']);

$featuredProfiles = [
    ['name' => 'Aarav Deshmukh', 'type' => 'वर', 'age' => '29', 'city' => 'Pune', 'profession' => 'Software Engineer', 'image' => 'img/yb5.jpeg', 'tag' => 'Verified'],
    ['name' => 'Ishita Patil', 'type' => 'वधू', 'age' => '26', 'city' => 'Mumbai', 'profession' => 'Chartered Accountant', 'image' => 'img/img1.jpg', 'tag' => 'Premium'],
    ['name' => 'Rohan Kulkarni', 'type' => 'वर', 'age' => '31', 'city' => 'Nashik', 'profession' => 'Business Owner', 'image' => 'img/yb7.jpeg', 'tag' => 'Highlighted'],
    ['name' => 'Mrunal Jadhav', 'type' => 'वधू', 'age' => '25', 'city' => 'Kolhapur', 'profession' => 'Doctor', 'image' => 'img/img2.jpg', 'tag' => 'नवीन'],
];

$successPreview = [];
$storyQuery = mysqli_query($con, "SELECT * FROM successstory WHERE approve='Yes' ORDER BY id DESC LIMIT 3");
if ($storyQuery) {
    while ($story = mysqli_fetch_assoc($storyQuery)) {
        $successPreview[] = $story;
    }
}

$plansPreview = [];
$planQuery = mysqli_query($con, "SELECT * FROM membershipplan WHERE plan_status='Active' ORDER BY planid ASC LIMIT 4");
if ($planQuery) {
    while ($plan = mysqli_fetch_assoc($planQuery)) {
        $plansPreview[] = $plan;
    }
}

$testimonials = [
    ['name' => 'सपना पांडुरंग गोळे', 'text' => 'थँक यू सर मला सगळ्यात बेस्ट लाईफ पार्टनर आणि फॅमिली शोधून दिल्या बद्दल.'],
    ['name' => 'श्री शंकर ज्ञानदेव जाधव', 'text' => 'हरेकृष्ण सर माझी ४ वर्षांची प्रतीक्षा आपल्या येथे अवघ्या ७ दिवसांत पूर्ण झाली.'],
    ['name' => 'काजल पांडुरंग आढाव', 'text' => 'मनापासून आभारी आहे मनपसंद जोडीदार चे. माझ्या बहिणीला आमच्या इच्छेनुसार स्थळ शोधून दिल्याबद्दल.'],
];

include('header3.php');
?>

<style>
/* ══════════════════════════════════════════
   MANPASAND JODIDAR — Home Page
═══════════════════════════════════════════ */

/* ─── HERO ─── */
.mj-hero {
  min-height: 680px;
  display: flex;
  align-items: center;
  position: relative;
  background:
    linear-gradient(135deg,
      rgba(255,249,246,0.97) 0%,
      rgba(255,249,246,0.92) 40%,
      rgba(255,249,246,0.1) 70%),
    url('template/assets/images/maratha-wedding-hero.jpg') 65% center / cover no-repeat;
  overflow: hidden;
}

.mj-hero::before {
  content: '';
  position: absolute;
  width: 400px;
  height: 400px;
  border-radius: 50%;
  border: 1px solid rgba(233,78,119,0.12);
  left: -220px;
  top: 20px;
  pointer-events: none;
}

.mj-hero::after {
  content: '';
  position: absolute;
  width: 550px;
  height: 550px;
  border-radius: 50%;
  border: 1px solid rgba(200,155,60,0.08);
  left: -310px;
  top: -60px;
  pointer-events: none;
}

.mj-hero-content {
  position: relative;
  z-index: 2;
  max-width: 600px;
  animation: mjFadeInUp 0.8s var(--mj-ease) both;
}

.mj-hero .mj-eyebrow {
  margin-bottom: 12px;
  background: var(--mj-primary);
  color: #fff;
}

.mj-hero-title {
  font-family: var(--mj-font-heading);
  font-size: clamp(2rem, 5vw, 3.2rem);
  font-weight: 800;
  color: var(--mj-primary);
  line-height: 1.2;
  margin-bottom: 16px;
}

.mj-hero-title em {
  font-family: var(--mj-font-display);
  font-style: italic;
  color: var(--mj-secondary);
}

.mj-hero-desc {
  font-size: 1.05rem;
  color: var(--mj-text-secondary);
  line-height: 1.7;
  margin-bottom: 28px;
  max-width: 520px;
}

.mj-hero-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 36px;
}

.mj-hero-trust {
  display: flex;
  gap: 28px;
  flex-wrap: wrap;
}

.mj-hero-trust-item {
  text-align: center;
}

.mj-hero-trust-item strong {
  display: block;
  font-size: 1.6rem;
  font-weight: 800;
  color: var(--mj-primary);
  line-height: 1.2;
}

.mj-hero-trust-item span {
  font-size: 0.78rem;
  color: var(--mj-text-secondary);
  font-weight: 500;
}

/* ─── SEARCH STRIP ─── */
.mj-search-strip {
  background: var(--mj-white);
  border-radius: var(--mj-radius-xl);
  padding: 24px 28px;
  box-shadow: var(--mj-shadow-lg);
  border: 1px solid var(--mj-border);
  margin-top: -40px;
  position: relative;
  z-index: 5;
}

.mj-search-strip form {
  display: flex;
  gap: 12px;
  align-items: flex-end;
  flex-wrap: wrap;
}

.mj-search-field {
  flex: 1;
  min-width: 140px;
}

.mj-search-field label {
  display: block;
  font-size: 0.75rem;
  font-weight: 600;
  color: var(--mj-text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 6px;
}

.mj-search-field select,
.mj-search-field input {
  width: 100%;
  padding: 10px 14px;
  border: 1.5px solid var(--mj-border);
  border-radius: var(--mj-radius-sm);
  font-family: var(--mj-font);
  font-size: 0.88rem;
  color: var(--mj-text);
  background: var(--mj-cream);
  outline: none;
  transition: all 0.2s;
  height: 44px !important;
}

.mj-search-field select:focus,
.mj-search-field input:focus {
  border-color: var(--mj-secondary);
  box-shadow: 0 0 0 3px rgba(233,78,119,0.08);
}

/* ─── ABOUT / WELCOME ─── */
.mj-about-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 48px;
  align-items: center;
}

.mj-about-image {
  position: relative;
}

.mj-about-image-frame {
  border-radius: var(--mj-radius-xl);
  overflow: hidden;
  box-shadow: var(--mj-shadow-lg);
  border: 3px solid var(--mj-accent-pale);
  aspect-ratio: 4/5;
  max-width: 420px;
}

.mj-about-image-frame img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.mj-about-image-frame::after {
  content: '';
  position: absolute;
  inset: 0;
  border-radius: inherit;
  border: 2px solid var(--mj-accent);
  opacity: 0.3;
  pointer-events: none;
}

.mj-about-floating-card {
  position: absolute;
  bottom: -16px;
  right: -16px;
  background: var(--mj-white);
  border-radius: var(--mj-radius);
  padding: 16px 20px;
  box-shadow: var(--mj-shadow-lg);
  display: flex;
  align-items: center;
  gap: 12px;
  animation: mjPulse 3s ease-in-out infinite;
}

.mj-about-floating-card .icon-circle {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--mj-secondary), var(--mj-primary));
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 1.2rem;
}

.mj-about-floating-card .info strong {
  display: block;
  font-size: 1.1rem;
  font-weight: 800;
  color: var(--mj-primary);
}

.mj-about-floating-card .info span {
  font-size: 0.75rem;
  color: var(--mj-text-secondary);
}

.mj-about-copy .mj-section-title {
  text-align: left;
  margin-bottom: 8px;
}

.mj-about-copy p {
  font-size: 0.95rem;
  color: var(--mj-text-secondary);
  line-height: 1.8;
  margin-bottom: 16px;
}

.mj-feature-row {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
  margin-bottom: 24px;
}

.mj-mini-feature {
  flex: 1;
  min-width: 120px;
  padding: 14px 16px;
  background: var(--mj-cream);
  border-radius: var(--mj-radius);
  border: 1px solid var(--mj-border);
  text-align: center;
  transition: all 0.3s var(--mj-ease);
}

.mj-mini-feature:hover {
  border-color: var(--mj-secondary-light);
  box-shadow: var(--mj-shadow-sm);
  transform: translateY(-2px);
}

.mj-mini-feature b {
  display: block;
  font-size: 0.88rem;
  color: var(--mj-primary);
  margin-bottom: 2px;
}

.mj-mini-feature span {
  font-size: 0.75rem;
  color: var(--mj-text-secondary);
}

/* ─── STATS ─── */
.mj-stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.mj-stat {
  text-align: center;
  padding: 28px 16px;
  background: var(--mj-white);
  border-radius: var(--mj-radius-lg);
  border: 1px solid var(--mj-border);
  transition: all 0.3s var(--mj-ease);
  position: relative;
  overflow: hidden;
}

.mj-stat::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--mj-secondary), var(--mj-accent));
  border-radius: 3px 3px 0 0;
}

.mj-stat:hover {
  transform: translateY(-4px);
  box-shadow: var(--mj-shadow-md);
  border-color: var(--mj-accent-light);
}

.mj-stat strong {
  display: block;
  font-family: var(--mj-font-heading);
  font-size: 2rem;
  font-weight: 800;
  color: var(--mj-primary);
  line-height: 1.2;
  margin-bottom: 4px;
}

.mj-stat span {
  font-size: 0.82rem;
  color: var(--mj-text-secondary);
  font-weight: 500;
}

/* ─── PROCESS ─── */
.mj-process-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

.mj-process-card {
  text-align: center;
  padding: 28px 20px;
  background: var(--mj-white);
  border-radius: var(--mj-radius-lg);
  border: 1px solid var(--mj-border);
  transition: all 0.3s var(--mj-ease);
  position: relative;
}

.mj-process-card:hover {
  transform: translateY(-6px);
  box-shadow: var(--mj-shadow-lg);
  border-color: var(--mj-secondary-light);
}

.mj-process-number {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--mj-secondary), var(--mj-primary));
  color: #fff;
  font-family: var(--mj-font-heading);
  font-size: 1rem;
  font-weight: 800;
  margin-bottom: 14px;
}

.mj-process-card h3 {
  font-family: var(--mj-font-heading);
  font-size: 0.88rem;
  font-weight: 700;
  color: var(--mj-primary);
  margin-bottom: 8px;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}

.mj-process-card p {
  font-size: 0.85rem;
  color: var(--mj-text-secondary);
  line-height: 1.6;
}

/* ─── FEATURED PROFILES ─── */
.mj-profiles-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

/* ─── TESTIMONIALS ─── */
.mj-testimonial-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.mj-quote-card {
  padding: 24px;
  background: var(--mj-white);
  border-radius: var(--mj-radius-lg);
  border: 1px solid var(--mj-border);
  transition: all 0.3s var(--mj-ease);
  position: relative;
}

.mj-quote-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--mj-shadow-md);
  border-color: var(--mj-secondary-light);
}

.mj-quote-card .quote {
  font-family: var(--mj-font-display);
  font-size: 3rem;
  color: var(--mj-secondary);
  line-height: 1;
  margin-bottom: 8px;
  opacity: 0.4;
}

.mj-quote-card p {
  font-size: 0.92rem;
  color: var(--mj-text-secondary);
  line-height: 1.7;
  margin-bottom: 12px;
  font-style: italic;
}

.mj-quote-card b {
  font-size: 0.85rem;
  color: var(--mj-primary);
  font-weight: 600;
}

/* ─── CTA ─── */
.mj-cta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  padding: 44px 48px;
  background: linear-gradient(135deg, var(--mj-primary) 0%, var(--mj-primary-light) 50%, var(--mj-secondary) 100%);
  border-radius: var(--mj-radius-xl);
  color: #fff;
  position: relative;
  overflow: hidden;
}

.mj-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  pointer-events: none;
}

.mj-cta h2 {
  color: #fff;
  font-size: clamp(1.3rem, 2.5vw, 1.8rem);
  margin-bottom: 4px;
  position: relative;
  z-index: 1;
}

.mj-cta p {
  font-size: 0.95rem;
  color: rgba(255,255,255,0.8);
  position: relative;
  z-index: 1;
}

.mj-cta .mj-btn {
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

/* ─── CALLBACK ─── */
.mj-callback-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: start;
}

.mj-contact-points {
  display: flex;
  gap: 20px;
  margin-top: 20px;
}

.mj-contact-point {
  padding: 16px;
  background: var(--mj-cream);
  border-radius: var(--mj-radius);
  border: 1px solid var(--mj-border);
  flex: 1;
}

.mj-contact-point b {
  display: block;
  font-size: 0.78rem;
  color: var(--mj-text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 4px;
}

.mj-contact-point span {
  font-size: 0.92rem;
  color: var(--mj-primary);
  font-weight: 600;
}

.mj-form-card {
  background: var(--mj-white);
  border-radius: var(--mj-radius-lg);
  padding: 28px;
  border: 1px solid var(--mj-border);
  box-shadow: var(--mj-shadow-md);
}

.mj-form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

.mj-form-grid .field.wide,
.mj-form-grid .wide {
  grid-column: 1 / -1;
}

.mj-form-grid .field label {
  display: block;
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--mj-text);
  margin-bottom: 4px;
}

.mj-form-grid .field input,
.mj-form-grid .field select,
.mj-form-grid .field textarea {
  width: 100%;
  padding: 10px 14px;
  border: 1.5px solid var(--mj-border);
  border-radius: var(--mj-radius-sm);
  font-family: var(--mj-font);
  font-size: 0.88rem;
  color: var(--mj-text);
  background: var(--mj-cream);
  outline: none;
  transition: all 0.2s;
  height: auto !important;
}

.mj-form-grid .field input:focus,
.mj-form-grid .field select:focus,
.mj-form-grid .field textarea:focus {
  border-color: var(--mj-secondary);
  box-shadow: 0 0 0 3px rgba(233,78,119,0.08);
  background: var(--mj-white);
}

.mj-form-grid .field textarea {
  min-height: 90px;
  resize: vertical;
}

/* ─── RESPONSIVE ─── */
@media (max-width: 1050px) {
  .mj-hero { min-height: 600px; background-position: 62% center; }
  .mj-hero-content { max-width: 55%; }
  .mj-profiles-grid { grid-template-columns: repeat(2, 1fr); }
  .mj-stats { grid-template-columns: repeat(2, 1fr); }
  .mj-process-grid { grid-template-columns: repeat(2, 1fr); }
  .mj-testimonial-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 768px) {
  .mj-hero {
    min-height: auto;
    padding: 60px 0 40px;
    background:
      linear-gradient(180deg,
        rgba(255,249,246,0.98) 0%,
        rgba(255,249,246,0.92) 55%,
        rgba(255,249,246,0.2) 100%),
      url('template/assets/images/maratha-wedding-hero.jpg') 70% bottom / auto 48% no-repeat,
      var(--mj-cream);
  }
  .mj-hero-content { max-width: 100%; padding: 0 0 240px; }
  .mj-hero-title { font-size: clamp(1.8rem, 7vw, 2.5rem); }
  .mj-about-grid { grid-template-columns: 1fr; gap: 28px; }
  .mj-about-image-frame { max-width: 100%; }
  .mj-callback-grid { grid-template-columns: 1fr; gap: 28px; }
  .mj-cta { flex-direction: column; text-align: center; padding: 32px 24px; }
  .mj-search-strip { padding: 16px 18px; }
  .mj-search-strip form { flex-direction: column; }
  .mj-search-field { min-width: 100%; }
  .mj-contact-points { flex-direction: column; }
}

@media (max-width: 600px) {
  .mj-profiles-grid { grid-template-columns: 1fr; }
  .mj-stats { grid-template-columns: 1fr 1fr; gap: 12px; }
  .mj-process-grid { grid-template-columns: 1fr; }
  .mj-testimonial-grid { grid-template-columns: 1fr; }
  .mj-form-grid { grid-template-columns: 1fr; }
  .mj-feature-row { flex-direction: column; }
  .mj-hero-trust { gap: 16px; }
}
</style>

<main id="main">
  <!-- ═══ HERO ═══ -->
  <section class="mj-hero">
    <div class="mj-container">
      <div class="mj-hero-content">
        <span class="mj-eyebrow">Manpasand Jodidar · Since 2012</span>
        <h1 class="mj-hero-title">Find Your <em>Perfect</em> Life Partner</h1>
        <p class="mj-hero-desc">Manpasand Jodidar — मराठा समाजातील वधू-वरांसाठी सन्माननीय, सुरक्षित आणि विश्वासार्ह विवाह माध्यम. Your journey to a beautiful partnership starts here.</p>
        <div class="mj-hero-actions">
          <?php if ($isLoggedIn) { ?>
            <a class="mj-btn mj-btn-primary mj-btn-lg" href="index_dashboard">My Dashboard <i class="bi bi-arrow-right"></i></a>
            <a class="mj-btn mj-btn-outline mj-btn-lg" href="latest_matches">View Matches</a>
          <?php } else { ?>
            <a class="mj-btn mj-btn-primary mj-btn-lg" href="signup">Register Free <i class="bi bi-arrow-right"></i></a>
            <a class="mj-btn mj-btn-outline mj-btn-lg" href="login">Login</a>
          <?php } ?>
        </div>
        <div class="mj-hero-trust">
          <div class="mj-hero-trust-item"><strong>12+</strong><span>Years Experience</span></div>
          <div class="mj-hero-trust-item"><strong>8K+</strong><span>Happy Couples</span></div>
          <div class="mj-hero-trust-item"><strong>100%</strong><span>Verified Profiles</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ SEARCH STRIP ═══ -->
  <section class="mj-section" style="padding-top:0;padding-bottom:0;">
    <div class="mj-container">
      <div class="mj-search-strip mj-reveal">
        <form method="get" action="search">
          <div class="mj-search-field">
            <label for="looking">I'm looking for</label>
            <select id="looking" name="gender">
              <option value="Female">Bride</option>
              <option value="Male">Groom</option>
            </select>
          </div>
          <div class="mj-search-field">
            <label for="age">Age group</label>
            <select id="age" name="age">
              <option value="">Any age</option>
              <option value="18-25">18 - 25</option>
              <option value="26-30">26 - 30</option>
              <option value="31-35">31 - 35</option>
              <option value="36+">36+</option>
            </select>
          </div>
          <div class="mj-search-field">
            <label for="religion">Religion</label>
            <select id="religion" name="religion">
              <option value="">Any</option>
              <option value="Hindu">Hindu</option>
              <option value="Muslim">Muslim</option>
              <option value="Christian">Christian</option>
            </select>
          </div>
          <div class="mj-search-field">
            <label for="city">City</label>
            <input type="text" id="city" name="location" placeholder="Enter city">
          </div>
          <button class="mj-btn mj-btn-secondary" type="submit"><i class="bi bi-search"></i> Search</button>
        </form>
      </div>
    </div>
  </section>

  <!-- ═══ ABOUT ═══ -->
  <section class="mj-section">
    <div class="mj-container">
      <div class="mj-about-grid mj-reveal">
        <div class="mj-about-image">
          <div class="mj-about-image-frame">
            <img src="img/_DSC3901%20copy.jpeg" alt="Manpasand Jodidar representative portrait">
          </div>
          <div class="mj-about-floating-card">
            <div class="icon-circle"><i class="bi bi-heart-fill"></i></div>
            <div class="info">
              <strong>8000+</strong>
              <span>Happy Marriages</span>
            </div>
          </div>
        </div>
        <div class="mj-about-copy">
          <span class="mj-eyebrow">Welcome to Manpasand Jodidar</span>
          <h2 class="mj-section-title" style="text-align:left;">मनपसंद जोडीदार<br>वधू वर सूचक केंद्र®</h2>
          <p>छत्रपती शिवाजी महाराजांच्या पदस्पर्शाने पावन झालेल्या व मराठ्यांची राजधानी असलेल्या सातारा जिल्ह्यामधे हेड ऑफिस असून गेल्या अनेक वर्षांपासून मराठा समाजातील वधु - वरांचे विवाह जमवणारी देशातील एक विश्वसनीय विवाह माध्यम म्हणून आम्ही काम करत आलेलो आहे.</p>
          <p>आपल्या विवाह केंद्रामध्ये फक्त मराठा समाजातील मुला व मुलींचीच नावे नोंद केली जातात. त्यामध्ये प्रथम वधु व वर, तसेच घटस्फोटित, विधवा, विधुर व अपंग स्थळांची नोंदणी केली जाते.</p>
          <div class="mj-feature-row">
            <div class="mj-mini-feature"><b>Verified</b><span>Authentic profiles</span></div>
            <div class="mj-mini-feature"><b>Private</b><span>Your data is safe</span></div>
            <div class="mj-mini-feature"><b>Personal</b><span>Assistant facility</span></div>
          </div>
          <a class="mj-btn mj-btn-outline" href="about-us">Know More <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ STATS ═══ -->
  <section class="mj-section mj-section-soft">
    <div class="mj-container">
      <div class="mj-stats mj-reveal mj-stagger">
        <div class="mj-stat"><strong>12+</strong><span>Years of Experience</span></div>
        <div class="mj-stat"><strong>8K+</strong><span>Happy Customers</span></div>
        <div class="mj-stat"><strong>98%</strong><span>Satisfaction Rate</span></div>
        <div class="mj-stat"><strong>100%</strong><span>Verified Profiles</span></div>
      </div>
    </div>
  </section>

  <!-- ═══ FEATURED PROFILES ═══ -->
  <?php if (!empty($featuredProfiles)) { ?>
  <section class="mj-section">
    <div class="mj-container">
      <div class="mj-section-head">
        <span class="mj-eyebrow">Featured Profiles</span>
        <h2 class="mj-section-title">Find Your Ideal Match</h2>
        <p class="mj-section-subtitle">Browse verified profiles from our community. Every profile is authenticated for your trust and safety.</p>
      </div>
      <div class="mj-profiles-grid mj-reveal mj-stagger">
        <?php foreach ($featuredProfiles as $profile) { ?>
          <article class="mj-profile-card">
            <div class="mj-profile-card-image">
              <img src="<?php echo htmlspecialchars($profile['image']); ?>" alt="<?php echo htmlspecialchars($profile['name']); ?>">
              <span class="mj-profile-card-badge <?php echo $profile['tag'] === 'Verified' ? 'mj-badge-verified' : ($profile['tag'] === 'Premium' ? 'mj-badge-premium' : 'mj-badge-verified'); ?>">
                <i class="fas fa-<?php echo $profile['tag'] === 'Verified' ? 'check-circle' : ($profile['tag'] === 'Premium' ? 'crown' : 'star'); ?>"></i>
                <?php echo htmlspecialchars($profile['tag']); ?>
              </span>
            </div>
            <div class="mj-profile-card-body">
              <div class="mj-profile-card-name"><?php echo htmlspecialchars($profile['name']); ?></div>
              <div class="mj-profile-card-meta">
                <span><i class="bi bi-calendar3"></i> <?php echo $profile['age']; ?> yrs</span>
                <span><i class="bi bi-geo-alt"></i> <?php echo $profile['city']; ?></span>
              </div>
              <div class="mj-profile-card-meta">
                <span><i class="bi bi-briefcase"></i> <?php echo $profile['profession']; ?></span>
              </div>
              <div class="mj-profile-card-actions">
                <a class="mj-btn mj-btn-ghost mj-btn-sm" href="#"><i class="bi bi-heart"></i> Connect</a>
                <a class="mj-btn mj-btn-primary mj-btn-sm" href="#">View Profile</a>
              </div>
            </div>
          </article>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php } ?>

  <!-- ═══ PROCESS ═══ -->
  <section class="mj-section mj-section-soft">
    <div class="mj-container">
      <div class="mj-section-head">
        <span class="mj-eyebrow">Simple & Transparent</span>
        <h2 class="mj-section-title">Our Process</h2>
        <p class="mj-section-subtitle">Your journey from registration to finding the right match — made simple in four clear steps.</p>
      </div>
      <div class="mj-process-grid mj-reveal mj-stagger">
        <article class="mj-process-card">
          <span class="mj-process-number">01</span>
          <h3>Submit Enroll Form</h3>
          <p>Submit your Bio-Data/Profile through our easy registration form.</p>
        </article>
        <article class="mj-process-card">
          <span class="mj-process-number">02</span>
          <h3>Backend Approval</h3>
          <p>Our team verifies your profile and sends an SMS for payment.</p>
        </article>
        <article class="mj-process-card">
          <span class="mj-process-number">03</span>
          <h3>Make Payment</h3>
          <p>Complete your membership payment as per the instructions.</p>
        </article>
        <article class="mj-process-card">
          <span class="mj-process-number">04</span>
          <h3>Profile Live</h3>
          <p>After payment, your profile goes live and matches start rolling in.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ═══ TESTIMONIALS ═══ -->
  <section class="mj-section">
    <div class="mj-container">
      <div class="mj-section-head">
        <span class="mj-eyebrow">Words from Our Families</span>
        <h2 class="mj-section-title">Testimonials</h2>
      </div>
      <div class="mj-testimonial-grid mj-reveal mj-stagger">
        <?php foreach ($testimonials as $item) { ?>
          <article class="mj-quote-card">
            <div class="quote">"</div>
            <p><?php echo htmlspecialchars($item['text']); ?></p>
            <b>— <?php echo htmlspecialchars($item['name']); ?></b>
          </article>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- ═══ CTA ═══ -->
  <section class="mj-section" id="enroll">
    <div class="mj-container">
      <div class="mj-cta mj-reveal">
        <div>
          <h2>तुमच्या नव्या प्रवासाची सुरुवात आजच करा</h2>
          <p>Create your profile and discover verified matches from the community.</p>
        </div>
        <?php if ($isLoggedIn) { ?>
          <a class="mj-btn mj-btn-gold mj-btn-lg" href="latest_matches">View My Matches <i class="bi bi-arrow-right"></i></a>
        <?php } else { ?>
          <a class="mj-btn mj-btn-gold mj-btn-lg" href="signup">Enroll Your Bio-data <i class="bi bi-arrow-right"></i></a>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- ═══ CALLBACK ═══ -->
  <section class="mj-section mj-section-soft" id="callback">
    <div class="mj-container">
      <div class="mj-callback-grid">
        <div class="mj-reveal">
          <span class="mj-eyebrow">We're Here to Help</span>
          <h2 class="mj-section-title" style="text-align:left;">Get a Call Back</h2>
          <p class="mj-section-subtitle" style="margin:0;text-align:left;">If you need to speak to us about a general query, fill in the form and we will call you back within the same working day.</p>
          <div class="mj-contact-points">
            <div class="mj-contact-point">
              <b>Call Us</b>
              <span>+91 94035 50087</span>
            </div>
            <div class="mj-contact-point">
              <b>Email Us</b>
              <span>info@manpasandjodidar.com</span>
            </div>
          </div>
        </div>
        <form class="mj-form-card mj-reveal" method="post" action="contact">
          <div class="mj-form-grid">
            <div class="field"><label for="fullName">Full name</label><input id="fullName" name="name" required placeholder="Enter your name"></div>
            <div class="field"><label for="mobile">Mobile number</label><input id="mobile" name="mobile" type="tel" required placeholder="+91 00000 00000"></div>
            <div class="field wide"><label for="help">How can we help?</label><select id="help" name="subject"><option>Membership</option><option>Membership Payment</option><option>Other</option></select></div>
            <div class="field wide"><label for="message">Message</label><textarea id="message" name="message" placeholder="Tell us briefly about your query"></textarea></div>
            <div class="wide"><button class="mj-btn mj-btn-primary" type="submit">Request a Call Back <i class="bi bi-send"></i></button></div>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

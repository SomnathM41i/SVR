<?php
require_once('includes/bootstrap.php');

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
    ['name' => 'काजल पांडुरंग आढाव', 'text' => 'मनापासून आभारी आहे शिवराज वधू वर चे. माझ्या बहिणीला आमच्या इच्छेनुसार स्थळ शोधून दिल्याबद्दल.'],
];
include('header3.php');
?>

<main id="main">
  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <span class="eyebrow">फक्त मराठा समाजासाठी · Since 2012</span>
        <h1>योग्य नात्यांची<br><em>विश्वासार्ह सुरुवात</em></h1>
        <p>मनपसंद जोडीदार वधू वर सूचक केंद्र® — मराठा समाजातील वधू-वरांसाठी सन्माननीय, सुरक्षित आणि विश्वासार्ह विवाह माध्यम.</p>
        <div class="hero-actions">
          <?php if ($isLoggedIn) { ?>
            <a class="btn" href="index_dashboard">My Dashboard <span>→</span></a>
            <a class="btn btn-outline" href="latest_matches">View Matches</a>
          <?php } else { ?>
            <a class="btn" href="login">Login <span>→</span></a>
            <a class="btn btn-outline" href="signup">Registration</a>
          <?php } ?>
        </div>
        <div class="hero-trust">
          <div><strong>12+</strong><span>Years of experience</span></div>
          <div><strong>8K+</strong><span>Happy Customers</span></div>
          <div><strong>100%</strong><span>Verified profiles</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- SEARCH STRIP -->
  <!-- <section class="search-strip" id="search">
    <div class="container">
      <form class="search-box" method="get" action="search">
        <div class="field">
          <label for="looking">I'm looking for</label>
          <select id="looking" name="gender">
            <option value="Female">Bride</option>
            <option value="Male">Groom</option>
          </select>
        </div>
        <div class="field">
          <label for="age">Age group</label>
          <select id="age" name="age">
            <option value="">Any age</option>
            <option value="18-25">18 - 25</option>
            <option value="26-30">26 - 30</option>
            <option value="31-35">31 - 35</option>
          </select>
        </div>
        <div class="field">
          <label for="city">Preferred city</label>
          <input type="text" id="city" name="location" placeholder="Enter city">
        </div>
        <button class="btn" type="submit">Search Profiles</button>
      </form>
    </div>
  </section> -->

  <!-- ABOUT -->
  <section class="section">
    <div class="container about-grid reveal">
      <div class="about-art about-photo-card">
        <div class="about-emblem">
          <img src="img/_DSC3901%20copy.jpeg" alt="Manpasand Jodidar representative portrait">
        </div>
      </div>
      <div class="about-copy">
        <span class="section-kicker">Welcome to Manpasand Jodidar</span>
        <h2 class="section-title">मनपसंद जोडीदार वधू वर सूचक केंद्र®</h2>
          <span class="mpj-divider mpj-divider--left" role="presentation"></span>
        <p>छत्रपती शिवाजी महाराजांच्या पदस्पर्शाने पावन झालेल्या व मराठ्यांची राजधानी असलेल्या सातारा जिल्ह्यामधे हेड ऑफिस असून गेल्या अनेक वर्षांपासून मराठा समाजातील वधु - वरांचे विवाह जमवणारी देशातील एक विश्वसनीय विवाह माध्यम म्हणून आम्ही काम करत आलेलो आहे.</p>
        <p>आपल्या विवाह केंद्रामध्ये फक्त मराठा समाजातील मुला व मुलींचीच नावे नोंद केली जातात. त्यामध्ये प्रथम वधु व वर, तसेच घटस्फोटित, विधवा, विधुर व अपंग स्थळांची नोंदणी केली जाते.</p>
        <div class="feature-row">
          <div class="mini-feature"><b>Verified</b><span>Authentic profiles</span></div>
          <div class="mini-feature"><b>Private</b><span>Your data is safe</span></div>
          <div class="mini-feature"><b>Personal</b><span>Assistant facility</span></div>
        </div>
        <a class="btn btn-outline" href="about-us">Know More →</a>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <section class="section section-soft">
    <div class="container">
      <div class="stats reveal">
        <div class="stat"><strong>12+</strong><span>Years of experience</span></div>
        <div class="stat"><strong>8K+</strong><span>Happy Customers</span></div>
        <div class="stat"><strong>98%</strong><span>Satisfaction</span></div>
      </div>
    </div>
  </section>

  <!-- PROCESS -->
  <section class="section section-soft">
    <div class="container">
      <div class="section-head">
        <div>
          <span class="section-kicker">Simple & transparent</span>
          <h2 class="section-title">Our Process</h2>
          <span class="mpj-divider mpj-divider--left" role="presentation"></span>
        </div>
        <p class="section-intro">Your journey from registration to finding the right match—made simple in four clear steps.</p>
      </div>
      <div class="process-grid reveal">
        <article class="process-card"><span class="process-number">01</span><h3>SUBMIT ENROLL FORM</h3><p>Submit your Bio-Data/Profile through Enroll Link.</p></article>
        <article class="process-card"><span class="process-number">02</span><h3>APPROVED BY BACKEND TEAM</h3><p>Backend team approves your Bio-Data and sends an SMS for payment.</p></article>
        <article class="process-card"><span class="process-number">03</span><h3>MAKE MEMBERSHIP PAYMENT</h3><p>Make a payment as per SMS instruction on your mobile.</p></article>
        <article class="process-card"><span class="process-number">04</span><h3>PROFILE LIVE ON WEBSITE</h3><p>After payment your biodata/profile goes live automatically.</p></article>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS -->
  <section class="section section-soft">
    <div class="container">
      <div class="section-head">
        <div>
          <span class="section-kicker">Words from our families</span>
          <h2 class="section-title">Testimonials</h2>
          <span class="mpj-divider mpj-divider--left" role="presentation"></span>
        </div>
      </div>
      <div class="testimonial-grid reveal">
        <?php foreach ($testimonials as $item) { ?>
          <article class="quote-card">
            <div class="quote">"</div>
            <p><?php echo htmlspecialchars($item['text']); ?></p>
            <b><?php echo htmlspecialchars($item['name']); ?></b>
          </article>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section" id="enroll">
    <div class="container">
      <div class="cta reveal">
        <div>
          <h2>तुमच्या नव्या प्रवासाची सुरुवात आजच करा</h2>
          <p>Create your profile and discover verified matches from the Maratha community.</p>
        </div>
        <?php if ($isLoggedIn) { ?>
          <a class="btn" href="latest_matches">View My Matches →</a>
        <?php } else { ?>
          <a class="btn" href="signup">Enroll Your Bio-data →</a>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- CALLBACK -->
  <section class="section section-soft" id="callback">
    <div class="container callback-grid">
      <div>
        <span class="section-kicker">We're here to help</span>
        <h2 class="section-title">Get a Call Back</h2>
          <span class="mpj-divider mpj-divider--left" role="presentation"></span>
        <p class="section-intro">If you need to speak to us about a general query, fill in the form and we will call you back within the same working day.</p>
        <div class="contact-points">
          <div class="contact-point"><b>Call us</b><span>+91 94035 50087</span></div>
          <div class="contact-point"><b>Email us</b><span>info@shivrajmaratha.com</span></div>
        </div>
      </div>
      <form class="form-card" method="post" action="contact">
        <div class="form-grid">
          <div class="field"><label for="fullName">Full name</label><input id="fullName" name="name" required placeholder="Enter your name"></div>
          <div class="field"><label for="mobile">Mobile number</label><input id="mobile" name="mobile" type="tel" required placeholder="+91 00000 00000"></div>
          <div class="field wide"><label for="help">How can we help?</label><select id="help" name="subject"><option>Membership</option><option>Membership Payment</option><option>Other</option></select></div>
          <div class="field wide"><label for="message">Message</label><textarea id="message" name="message" placeholder="Tell us briefly about your query"></textarea></div>
          <div class="wide"><button class="btn" type="submit">Request a Call Back</button></div>
        </div>
      </form>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

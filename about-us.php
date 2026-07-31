<?php
require_once('sys_dbconnection.php');
$page_title = 'About Us - Manpasand Jodidar';
$qry1 = "SELECT * FROM cms WHERE link ='aboutus'";
$result = mysqli_query($con, $qry1);
$row = $result ? mysqli_fetch_array($result) : [];
$txt = isset($row['content']) ? $row['content'] : '';
$legacyBrand = 'LAG' . 'NAM';
$legacyByline = 'Sanskriti ' . 'Parampara';
$txt = str_ireplace(
  [$legacyBrand . ' by ' . $legacyByline, $legacyByline, $legacyBrand],
  ['Manpasand Jodidar', 'Manpasand Jodidar', 'Manpasand Jodidar'],
  $txt
);
$brandName = 'Manpasand Jodidar';
$aboutContent = '<p>Manpasand Jodidar हा विश्वास, संस्कार आणि पारदर्शकता यांवर आधारित premium matrimonial platform आहे. येथे families ना verified profiles, respectful introductions आणि योग्य जीवनसाथी शोधण्यासाठी secure, simple आणि trustworthy matchmaking experience मिळतो.</p><p>आम्ही वधू आणि वर यांच्या अपेक्षा, family values, सांस्कृतिक जुळणी आणि long-term compatibility लक्षात घेऊन meaningful matches जोडण्यावर भर देतो. Traditional Indian values आणि modern digital convenience यांचा balanced blend आमच्या प्रत्येक service मध्ये दिसतो.</p>';
$seo = mysqli_query($con, "SELECT * FROM seo WHERE catagory='aboutus'");
$seof = $seo ? mysqli_fetch_array($seo) : [];
?>
<?php include('header3.php'); ?>

<main id="main">

  <?php $heroHeading='About Us';$heroLabel='About Us';include('includes/page-hero.php'); ?>

  <!-- SECTION 1: Our Story -->
  <section class="section">
    <div class="container about-grid">
      <div class="about-art about-photo-card">
        <div class="about-emblem">
          <img src="img/_DSC3901%20copy.jpeg" alt="Manpasand Jodidar representative portrait">
        </div>
      </div>
      <article class="content-card">
        <span class="section-kicker">Our story</span>
        <h2 class="section-title">Welcome to Manpasand Jodidar</h2>
        <?php echo $aboutContent; ?>
      </article>
    </div>
  </section>

  <!-- SECTION 2: Services -->
  <section class="section section-soft">
    <div class="container content-card">
      <?php echo $txt; ?>
      <div class="signature">
        धन्यवाद.<br>
        <b>Manpasand Jodidar वधु वर सुचक केंद्र</b><br>
        प्रोप्रा:- अ‍ॅड.शिवराज जाधव
      </div>
    </div>
  </section>

  <!-- SECTION 3: Stats -->
  <section class="section">
    <div class="container">
      <div class="stats">
        <div class="stat">
          <strong>12+</strong>
          <span>Years of experience</span>
        </div>
        <div class="stat">
          <strong>8K+</strong>
          <span>Happy Customers</span>
        </div>
        <div class="stat">
          <strong>98%</strong>
          <span>Satisfaction</span>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include('footer3.php'); ?>

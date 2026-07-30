<?php
require_once('sys_dbconnection.php');
$strid = isset($_SESSION['MatriID']) ? $_SESSION['MatriID'] : '';
$record = [];
if (!empty($strid)) {
    $safeId = mysqli_real_escape_string($con, $strid);
    $result = mysqli_query($con, "SELECT * FROM register WHERE MatriID = '$safeId'");
    $record = $result ? mysqli_fetch_array($result) : [];
}
$seo = mysqli_query($con, "SELECT * FROM seo WHERE catagory='membership'");
$seof = $seo ? mysqli_fetch_array($seo) : [];
?>
<?php include('header3.php'); ?>

<main id="main">
  <?php $heroHeading='Membership';$heroLabel='Membership';include('includes/page-hero.php'); ?>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="text-center mb-5">
        <div class="mvv-eyebrow">तुमचा plan निवडा</div>
        <h2 class="mvv-title">Transparent Pricing, Meaningful Benefits</h2>
        <p class="mvv-subtitle">प्रत्येक plan families ना confidence, privacy आणि clarity सोबत profiles evaluate करण्यासाठी तयार केला आहे.</p>
      </div>

      <div class="mvv-plan-grid">
        <?php
        $plan_num = 0;
        $qry_plan = mysqli_query($con, "SELECT * FROM membershipplan WHERE plan_status='Active' ORDER BY planid ASC");
        if ($qry_plan && mysqli_num_rows($qry_plan) > 0) {
          while ($plan = mysqli_fetch_array($qry_plan)) {
            $plan_num++;
            $is_featured = ($plan_num === 2);
        ?>
          <article class="mvv-plan <?php echo $is_featured ? 'featured' : ''; ?>">
            <?php if ($is_featured) { ?><span class="mvv-plan-ribbon">Best Value</span><?php } ?>
            <div class="mvv-plan-body">
              <span class="mvv-icon"><i class="bi bi-gem"></i></span>
              <h3><?php echo htmlspecialchars($plan['plandisplayname']); ?></h3>
              <div class="mvv-price">₹<?php echo number_format((float)$plan['planamount']); ?></div>
              <p><i class="bi bi-calendar3"></i> <?php echo htmlspecialchars($plan['planduration']); ?> दिवस validity</p>
              <ul class="mvv-feature-list">
                <?php for ($i = 1; $i <= 7; $i++) {
                  if (!empty($plan["description$i"])) { ?>
                    <li><i class="bi bi-check-circle-fill"></i><?php echo htmlspecialchars($plan["description$i"]); ?></li>
                <?php } } ?>
              <li><i class="bi bi-check-circle-fill"></i>Allowed contacts: <?php echo htmlspecialchars($plan['plannoofcontacts']); ?></li>
              </ul>

              <?php if (!empty($strid)) { ?>
                <form method="post" action="membership_choose">
              <?php } else { ?>
                <form method="post" action="login">
              <?php } ?>
                <input type="hidden" name="choose" value="<?php echo htmlspecialchars($plan['planid']); ?>">
                <input type="hidden" name="txtplan" value="<?php echo htmlspecialchars($plan['planname']); ?>">
                <input type="hidden" name="txtplanname" value="<?php echo htmlspecialchars($plan['plandisplayname']); ?>">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($plan['planid']); ?>">
                <input type="hidden" name="pm" value="op4">
                <button type="submit" class="mvv-btn maroon w-100">
                  <i class="bi bi-credit-card-fill"></i>
                  <?php echo !empty($strid) ? 'आता Buy करा' : 'Buy करण्यासाठी Login करा'; ?>
                </button>
              </form>
            </div>
          </article>
        <?php
          }
        } else {
          foreach (['Free', 'Silver', 'Gold', 'Premium'] as $index => $fallbackPlan) {
        ?>
          <article class="mvv-plan <?php echo $index === 2 ? 'featured' : ''; ?>">
            <?php if ($index === 2) { ?><span class="mvv-plan-ribbon">Best Value</span><?php } ?>
            <div class="mvv-plan-body">
              <span class="mvv-icon"><i class="bi bi-gem"></i></span>
              <h3><?php echo $fallbackPlan; ?></h3>
              <div class="mvv-price"><?php echo $index === 0 ? '₹0' : '₹'.number_format(($index + 1) * 999); ?></div>
              <p>Profile discovery आणि meaningful connections साठी premium member benefits.</p>
              <ul class="mvv-feature-list">
                <li><i class="bi bi-check-circle-fill"></i>Verified profile access</li>
                <li><i class="bi bi-check-circle-fill"></i>Privacy controls</li>
                <li><i class="bi bi-check-circle-fill"></i>Member support</li>
              </ul>
              <a class="mvv-btn maroon w-100" href="<?php echo !empty($strid) ? 'membership_choose' : 'login'; ?>">पुढे जा</a>
            </div>
          </article>
        <?php } } ?>
      </div>
    </div>
  </section>

  <section class="mvv-section alt">
    <div class="mvv-container">
      <div class="text-center mb-5">
        <div class="mvv-eyebrow">Plan Comparison</div>
        <h2 class="mvv-title">Benefits एका दृष्टित compare करा</h2>
      </div>
      <div style="overflow-x:auto;">
        <table class="mvv-comparison">
          <thead>
            <tr>
              <th>सुविधा</th>
              <th>Free</th>
              <th>Silver</th>
              <th>Gold</th>
              <th>Premium</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Profile visibility</td><td>Basic</td><td>Better</td><td>High</td><td>Highest</td></tr>
            <tr><td>Contact access</td><td>Limited</td><td>Included</td><td>अधिक contacts</td><td>Maximum contacts</td></tr>
            <tr><td>Priority support</td><td>-</td><td>-</td><td>Included</td><td>Included</td></tr>
            <tr><td>कोणासाठी योग्य</td><td>New users</td><td>Active search</td><td>Serious families</td><td>Priority matchmaking</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="text-center mb-5">
        <div class="mvv-eyebrow">प्रश्न</div>
        <h2 class="mvv-title">Membership FAQ</h2>
      </div>
      <div class="mvv-faq">
        <details open><summary>मी नंतर plan upgrade करू शकतो का?</summary><p class="mt-3">हो, तुमचा search अधिक active झाल्यावर तुम्ही higher plan निवडू शकता.</p></details>
        <details><summary>Contact details private असतात का?</summary><p class="mt-3">हो, privacy आमच्या member experience चा महत्त्वाचा भाग आहे आणि profile access controlled ठेवला जातो.</p></details>
        <details><summary>Paid plans मुळे profile visibility improve होते का?</summary><p class="mt-3">हो, premium plans serious profiles पर्यंत better access आणि stronger visibility देण्यासाठी तयार केले आहेत.</p></details>
        <details><summary>Buy करण्यापूर्वी login गरजेचे आहे का?</summary><p class="mt-3">हो, membership purchase तुमच्या registered matrimony profile शी जोडलेली असते.</p></details>
      </div>
    </div>
  </section>

  <section class="mvv-section mvv-band">
    <div class="mvv-container text-center">
      <div class="mvv-eyebrow">Premium Access</div>
      <h2 class="mvv-title">Confidence ने serious matches शोधा</h2>
      <p class="mvv-subtitle mb-4">Premium membership तुमच्या family ला stronger visibility आणि अधिक seamless search experience देते.</p>
      <a class="mvv-btn primary" href="signup">Profile तयार करा</a>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

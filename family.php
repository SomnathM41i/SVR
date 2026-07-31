<?php 
ob_start();
require_once('includes/bootstrap.php');
include('memprotect1.php');
?>
<?php
$login = $_SESSION['MatriID'] ?? '';
if($login) {
  $myq = mysqli_query($con,"SELECT * from register where MatriID='$login'");
  $me = mysqli_fetch_array($myq) ?? [];
}
$regvar = $me['reg_step'] ?? '';
$row = $me;
$page_title = 'Family Details - Manpasand Jodidar';
include('header3.php'); ?>
<script>
function ValidateAlpha(evt) {
  var keyCode = evt.which || evt.keyCode;
  if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32) return false;
  return true;
}
function blockSpecialChar(e) {
  var k = e.which || e.keyCode;
  return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
}
function isNumber(evt) {
  var charCode = evt.which || evt.keyCode;
  return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
function gf(id) { document.getElementById(id)?.classList.remove('mvv-hide'); }
function hf(id) { document.getElementById(id)?.classList.add('mvv-hide'); }
document.addEventListener('DOMContentLoaded', function() {
  ['noofbro5','noofbro4','noofbro3','noofbro2','noofbro1','noofbrono',
   'noofsis5','noofsis4','noofsis3','noofsis2','noofsis1','noofsisno'].forEach(hf);
  var bro = document.getElementById('noofbrom');
  var sis = document.getElementById('noofsism');
  if (bro) bro.addEventListener('change', function() {
    ['noofbro6','noofbro5','noofbro4','noofbro3','noofbro2','noofbro1','noofbrono'].forEach(hf);
    var map = {'No':'noofbrono','1':'noofbro1','2':'noofbro2','3':'noofbro3','4':'noofbro4','5':'noofbro5','5+':'noofbro6'};
    if (map[this.value]) gf(map[this.value]);
  });
  if (sis) sis.addEventListener('change', function() {
    ['noofsis6','noofsis5','noofsis4','noofsis3','noofsis2','noofsis1','noofsisno'].forEach(hf);
    var map = {'No':'noofsisno','1':'noofsis1','2':'noofsis2','3':'noofsis3','4':'noofsis4','5':'noofsis5','5+':'noofsis6'};
    if (map[this.value]) gf(map[this.value]);
  });
});
</script>
<style>
.mvv-radio-group {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.mvv-radio-label {
  position: relative;
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  font-size: 0.95rem;
  color: var(--text-main);
  padding: 12px 16px;
  border: 2px solid var(--border-warm);
  border-radius: 10px;
  background: var(--cream);
  transition: all 0.2s;
  user-select: none;
}
.mvv-radio-label:hover {
  border-color: var(--saffron);
  background: #FFF0E0;
}
.mvv-radio-label input[type="radio"] {
  position: absolute;
  opacity: 0;
  width: 1px;
  height: 1px;
  pointer-events: none;
  cursor: pointer;
  margin: 0;
}
.mvv-radio-label .radio-dot {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  border: 2px solid var(--border-warm);
  border-radius: 50%;
  background: #fff;
  font-size: 0.7rem;
  color: transparent;
  transition: all 0.2s;
  flex-shrink: 0;
}
.mvv-radio-label input[type="radio"]:focus + .radio-dot {
  box-shadow: 0 0 0 4px rgba(232,117,26,0.16);
}
.mvv-radio-label input[type="radio"]:checked + .radio-dot {
  background: var(--saffron);
  color: #fff;
  border-color: var(--saffron);
}
.mvv-radio-label input[type="radio"]:checked ~ span:last-child {
  color: var(--saffron);
  font-weight: 600;
}
.mvv-property-section {
  grid-column: 1/-1;
  padding: 22px;
  border: 1px solid var(--border-warm);
  border-radius: 12px;
  background: var(--cream, #fffaf5);
}
.mvv-property-section h3 {
  margin: 0 0 6px;
  color: var(--mvv-maroon);
  font-size: 1.2rem;
}
.mvv-property-section > p {
  margin: 0 0 20px;
  color: var(--mvv-muted);
  font-size: .9rem;
}
.mvv-property-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
}
.mvv-property-options {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 9px;
}
.mvv-property-option {
  display: flex !important;
  align-items: center;
  gap: 8px;
  margin: 0 !important;
  padding: 10px;
  border: 1px solid var(--border-warm);
  border-radius: 8px;
  background: #fff;
  color: var(--mvv-text) !important;
  font-size: .82rem !important;
  font-weight: 600 !important;
  letter-spacing: 0 !important;
  text-transform: none !important;
  cursor: pointer;
}
.mvv-property-option:has(input:checked) {
  border-color: var(--saffron);
  background: #fff0e0;
}
.mvv-property-option input {
  width: 17px !important;
  min-height: 17px !important;
  height: 17px;
  margin: 0;
  accent-color: var(--saffron);
}
@media (max-width: 700px) {
  .mvv-property-grid { grid-template-columns: 1fr; }
  .mvv-property-options { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
</style>
<?php
$ID=$_GET['id'];

	$hiddenregstep=mysqli_query($con,"select * from register where MatriID='$ID'");
	$hiddenfetch=mysqli_fetch_array($hiddenregstep);
	if($hiddenfetch['reg_step']=="4")
	{
	mysqli_query($con,"update register set reg_step='5' where MatriID='$ID'");
	}
if(isset($_POST['submit']))
{
   
$fvalues = $db->setfilter($_POST['fvalues']);   
$ftype = $db->setfilter($_POST['ftype']);
$fstatus = $db->setfilter($_POST['fstatus']);

$relative = $db->setfilter($_POST['relative']);
$mother_tongue = $db->setfilter($_POST['mother_tounge']);
$brothers = $db->setfilter($_POST['brothers']);
$sisters = $db->setfilter($_POST['sisters']);
$bmarried = $db->setfilter($_POST['bmarried']);
$smarried = $db->setfilter($_POST['smarried']);
$father = $db->setfilter($_POST['father']);
$fatherOccupation = $db->setfilter($_POST['fatherOccupation']);
$mother = $db->setfilter($_POST['mother']);
$motheroccupation = $db->setfilter($_POST['motheroccupation']);
$living_status = $db->setfilter($_POST['living_status']);
$aboufamily = $db->setfilter($_POST['aboufamily']);
$property_types = implode(', ', array_map([$db, 'setfilter'], $_POST['property_types'] ?? []));
$property_details = $db->setfilter($_POST['property_details'] ?? '');
$investment_types = implode(', ', array_map([$db, 'setfilter'], $_POST['investment_types'] ?? []));
$investment_details = $db->setfilter($_POST['investment_details'] ?? '');
$monthly_rental_income = $db->setfilter($_POST['monthly_rental_income'] ?? '');
$famdate=date('d-m-Y');
if($brothers=='No')
{
	$bmarried = $db->setfilter($_POST['bmarriedno']);

}
if($brothers=='1')
{
	$bmarried = $db->setfilter($_POST['bmarried1']);
	
	
}
if($brothers=='2')
{
	$bmarried = $db->setfilter($_POST['bmarried2']);
}
if($brothers=='3')
{
	$bmarried = $db->setfilter($_POST['bmarried3']);
}
if($brothers=='4')
{
	$bmarried = $db->setfilter($_POST['bmarried4']);
}
if($brothers=='5')
{
	$bmarried = $db->setfilter($_POST['bmarried5']);
}
if($brothers=='5+')
{
	$bmarried = $db->setfilter($_POST['bmarried6']);
}

if($sisters=='No')
{
	$smarried = $db->setfilter($_POST['smarriedno']);
}
if($sisters=='1')
{
	$smarried = $db->setfilter($_POST['smarried1']);
}
if($sisters=='2')
{
	$smarried = $db->setfilter($_POST['smarried2']);
}
if($sisters=='3')
{
	$smarried = $db->setfilter($_POST['smarried3']);
}
if($sisters=='4')
{
	$smarried = $db->setfilter($_POST['smarried4']);
}
if($sisters=='5')
{
	$smarried = $db->setfilter($_POST['smarried5']);
}
if($sisters=='5+')
{
	$smarried = $db->setfilter($_POST['smarried6']);
}

if(isset($login) && $regvar=='9')
{




  if( ( $me['Familyvalues'] == $fvalues ) && ($me['FamilyType'] == $ftype) && ($me['FamilyStatus'] == $fstatus) && ($me['noofbrothers'] == $brothers) && ($me['noofsisters']==$sisters) && ( $me['nbm'] == $bmarried ) && ($me['nsm']==$smarried) && ($me['Fathername']==$father) && ( $me['Fathersoccupation'] == $fatherOccupation ) && ($me['Mothersname']==$mother) && ($me['Mothersoccupation'] == $motheroccupation) && ($me['mother_tounge'] == $mother_tongue) && ($me['relatives'] == $relative) && ($me['parents_stay']==$living_status) && ($me['FamilyDetails'] == $aboufamily) && (($me['property_types'] ?? '') == $property_types) && (($me['property_details'] ?? '') == $property_details) && (($me['investment_types'] ?? '') == $investment_types) && (($me['investment_details'] ?? '') == $investment_details) && (($me['monthly_rental_income'] ?? '') == $monthly_rental_income))
   {
	              header('Location: index_dashboard');
	              exit;
   }
   else{
		mysqli_query($con,"update register set Familyvalues='$fvalues',FamilyType='$ftype',FamilyStatus='$fstatus',noofbrothers='$brothers',noofsisters='$sisters',nbm='$bmarried',nsm='$smarried',Fathername='$father',Fathersoccupation='$fatherOccupation',Mothersname='$mother',Mothersoccupation='$motheroccupation',mother_tounge='$mother_tongue',relatives='$relative',parents_stay='$living_status',FamilyDetails='$aboufamily',property_types='$property_types',property_details='$property_details',investment_types='$investment_types',investment_details='$investment_details',monthly_rental_income='$monthly_rental_income',FamilyDetails_approve='No',famdate='$famdate' where MatriID='$login'");
		header('Location: index_dashboard');
		exit;
		}
}
else
{
	
mysqli_query($con,"update register set Familyvalues='$fvalues',FamilyType='$ftype',FamilyStatus='$fstatus',noofbrothers='$brothers',noofsisters='$sisters',nbm='$bmarried',nsm='$smarried',Fathername='$father',Fathersoccupation='$fatherOccupation',Mothersname='$mother',Mothersoccupation='$motheroccupation',mother_tounge='$mother_tongue',relatives='$relative',parents_stay='$living_status',FamilyDetails='$aboufamily',property_types='$property_types',property_details='$property_details',investment_types='$investment_types',investment_details='$investment_details',monthly_rental_income='$monthly_rental_income',reg_step='6',FamilyDetails_approve='No',famdate='$famdate' where MatriID='$ID'");
header('Location: upload_photo?id='.$ID);
}
}
?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Family Details</div>
      <h1>कुटुंब माहिती</h1>
      <p>तुमच्या कुटुंबाची माहिती भरा</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <?php if(isset($login) && $regvar=='9') { ?>
        <a href="index_dashboard">Dashboard</a>
        <?php } else { ?>
        <a href="index">Home</a>
        <?php } ?>
        <span>Family Details</span>
      </nav>
      <?php if (($regvar ?? '') == '9') { ?>
      <div class="mvv-dashboard-return-row"><a class="mvv-dashboard-return" href="index_dashboard"><i class="fas fa-arrow-left" aria-hidden="true"></i> Return to Dashboard</a></div>
      <?php } ?>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <?php if(isset($_GET['message']) && $_GET['message']!='') { ?>
      <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
        <?php if($_GET['message']=='success') { ?>
          Your Details Updated Successfully
        <?php } if($_GET['message']=='fly') { ?>
          <b>Warning Alert:</b> Please Select Atleast One Value For Upload.
        <?php } ?>
      </div>
      <?php } else {
        if($me['FamilyDetails_approve'] == 'Rejected') { ?>
        <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
          <b>Warning Alert:</b> Your Family Description Is Rejected By Admin.
        </div>
        <?php }
        if($me['FamilyDetails_approve'] == "Yes") { ?>
        <div style="background:var(--mvv-maroon);color:#fff;border-radius:8px;padding:12px 18px;margin-bottom:20px;text-align:center;">
          <b>Success :</b> Your Family Description Is Approved By Admin.
        </div>
        <?php }
      } ?>

      <div class="row g-5 mvv-registration-row">
        <?php if(isset($login) && $regvar=='9') { ?>
        <div class="col-lg-9 col-md-12">
          <form method="post" action="#" class="mvv-form">
            <div class="mvv-eyebox">Family Details</div>
            <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.4vw,2rem);">एडिट फॅमिली डिटेल्स</h2>

            <div class="mvv-form-grid">
              <div class="mvv-field">
                <label>Family Values</label>
                <select name="fvalues" tabindex="1">
                  <?php if($me['Familyvalues']=="") { ?>
                  <option value="" selected>Select Family values</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['Familyvalues']?>" selected><?php echo $me['Familyvalues']?></option>
                  <?php } ?>
                  <?php $familysql=mysqli_query($con,"select * from family_values where family_values!='".$row['Familyvalues']."'");
                  while($familys=mysqli_fetch_array($familysql)) { ?>
                  <option value="<?php echo $familys['family_values'];?>"><?php echo $familys['family_values'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field">
                <label>Family Type</label>
                <select name="ftype" tabindex="2">
                  <?php if($me['FamilyType']=="") { ?>
                  <option value="" selected>Select Family Type</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['FamilyType']?>" selected><?php echo $me['FamilyType']?></option>
                  <?php } ?>
                  <?php $famitypsql=mysqli_query($con,"select * from family_type where family_typ!='".$row['FamilyType']."'");
                  while($familytyp=mysqli_fetch_array($famitypsql)) { ?>
                  <option value="<?php echo $familytyp['family_typ'];?>"><?php echo $familytyp['family_typ'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="emailerror">
                <label>Family Status</label>
                <select name="fstatus" tabindex="3">
                  <?php if($me['FamilyStatus']=="") { ?>
                  <option value="" selected>Select Family Status</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['FamilyStatus']?>" selected><?php echo $me['FamilyStatus']?></option>
                  <?php } ?>
                  <?php $famisql=mysqli_query($con,"select * from family_status where family_status!='".$row['FamilyStatus']."'");
                  while($familyst=mysqli_fetch_array($famisql)) { ?>
                  <option value="<?php echo $familyst['family_status'];?>"><?php echo $familyst['family_status'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field">
                <label>Mother Tongue</label>
                <select name="mother_tounge" id="mother_tounge" tabindex="4">
                  <?php if($me['mother_tounge']=="") { ?>
                  <option value="" selected>Select Mother Tongue</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['mother_tounge']?>" selected><?php echo $me['mother_tounge']?></option>
                  <?php } ?>
                  <option value="Assamese">Assamese</option>
                  <option value="Bengali">Bengali</option>
                  <option value="Bodo">Bodo</option>
                  <option value="Dogri">Dogri</option>
                  <option value="Gujarati">Gujarati</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Kannada">Kannada</option>
                  <option value="Kashmiri">Kashmiri</option>
                  <option value="Konkani">Konkani</option>
                  <option value="Maithili">Maithili</option>
                  <option value="Malayalam">Malayalam</option>
                  <option value="Manipuri">Manipuri</option>
                  <option value="Marathi">Marathi</option>
                  <option value="Nepali">Nepali</option>
                  <option value="Odia">Odia</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Sanskrit">Sanskrit</option>
                  <option value="Santali">Santali</option>
                  <option value="Sindhi">Sindhi</option>
                  <option value="Tamil">Tamil</option>
                  <option value="Telugu">Telugu</option>
                  <option value="Urdu">Urdu</option>
                </select>
              </div>

              <div class="mvv-field">
                <label>No. of Brothers</label>
                <select name="brothers" id="noofbrom" tabindex="5">
                  <?php if($me['noofbrothers']=="") { ?>
                  <option value="" selected>Select No.of Brothers</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['noofbrothers']?>" selected><?php echo $me['noofbrothers']?></option>
                  <option value="">Select No.of Brothers</option>
                  <?php } ?>
                  <?php $nobro=mysqli_query($con,"select * from no_of_brother");
                  while($nobros=mysqli_fetch_array($nobro)) { ?>
                  <option value="<?php echo $nobros['number'];?>"><?php echo $nobros['number'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="noofbro6">
                <label>No. of Brothers Married</label>
                <select name="bmarried6" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No.of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="5+">5+</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro5">
                <label>No. of Brothers Married</label>
                <select name="bmarried5" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No.of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro4">
                <label>No. of Brothers Married</label>
                <select name="bmarried4" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro3">
                <label>No. of Brothers Married</label>
                <select name="bmarried3" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No.of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro2">
                <label>No. of Brothers Married</label>
                <select name="bmarried2" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No.of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro1">
                <label>No. of Brothers Married</label>
                <select name="bmarried1" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No.of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbrono">
                <label>No. of Brothers Married</label>
                <select name="bmarriedno" tabindex="6">
                  <?php if($me['nbm']!=""){ ?>
                  <option value="<?php echo $me['nbm']; ?>" selected><?php echo $me['nbm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                </select>
              </div>

              <div class="mvv-field">
                <label>No. of Sisters</label>
                <select name="sisters" id="noofsism" tabindex="7">
                  <?php if($me['noofsisters']=="") { ?>
                  <option value="" selected>Select No. of Sisters</option>
                  <?php } else { ?>
                  <option value="<?php echo $me['noofsisters']?>" selected><?php echo $me['noofsisters']?></option>
                  <option value="">Select No. of Sisters</option>
                  <?php } ?>
                  <?php $nosis=mysqli_query($con,"select * from no_of_sister");
                  while($nosistr=mysqli_fetch_array($nosis)) { ?>
                  <option value="<?php echo $nosistr['number'];?>"><?php echo $nosistr['number'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="noofsis6">
                <label>No. of Sisters Married</label>
                <select name="smarried6" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="5+">5+</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis5">
                <label>No. of Sisters Married</label>
                <select name="smarried5" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis4">
                <label>No. of Sisters Married</label>
                <select name="smarried4" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis3">
                <label>No. of Sisters Married</label>
                <select name="smarried3" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis2">
                <label>No. of Sisters Married</label>
                <select name="smarried2" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis1">
                <label>No. of Sisters Married</label>
                <select name="smarried1" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsisno">
                <label>No. of Sisters Married</label>
                <select name="smarriedno" tabindex="8">
                  <?php if($me['nsm']!="") { ?>
                  <option value="<?php echo $me['nsm']; ?>" selected><?php echo $me['nsm']; ?></option>
                  <?php } ?>
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                </select>
              </div>

              <div class="mvv-field">
                <label>Father Name</label>
                <input type="text" placeholder="Your Father Name" maxlength="35" name="father" value="<?php echo $me['Fathername']?>" required onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" tabindex="9">
              </div>

              <div class="mvv-field">
                <label>Father Occupation</label>
                <input type="text" placeholder="Father's Occuption" maxlength="40" name="fatherOccupation" value="<?php echo $me['Fathersoccupation']?>" onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" tabindex="10">
              </div>

              <div class="mvv-field">
                <label>Mother Name</label>
                <input type="text" placeholder="Your Mother Name" onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" required value="<?php echo $me['Mothersname']?>" maxlength="35" name="mother" tabindex="11">
              </div>

              <div class="mvv-field">
                <label>Mother Occupation</label>
                <input type="text" placeholder="Mother's Occuption" maxlength="40" name="motheroccupation" onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" value="<?php echo $me['Mothersoccupation']?>" tabindex="12">
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>Living Status</label>
                <div class="mvv-radio-group">
                  <label class="mvv-radio-label">
                    <input type="radio" name="living_status" <?=$me['parents_stay']=="My parents will stay with me after marriage" ? "checked" : ""?> value="My parents will stay with me after marriage" tabindex="13">
                    <span class="radio-dot">&#10003;</span>
                    <span>My parents will stay with me after marriage</span>
                  </label>
                  <label class="mvv-radio-label">
                    <input type="radio" name="living_status" <?=$me['parents_stay']=="My parents will not stay with me after marriage" ? "checked" : ""?> value="My parents will not stay with me after marriage" tabindex="14">
                    <span class="radio-dot">&#10003;</span>
                    <span>My parents will not stay with me after marriage</span>
                  </label>
                  <label class="mvv-radio-label">
                    <input type="radio" name="living_status" <?=$me['parents_stay']=="Dont wish to specify" ? "checked" : ""?> value="Dont wish to specify" tabindex="15">
                    <span class="radio-dot">&#10003;</span>
                    <span>Don't wish to specify</span>
                  </label>
                </div>
              </div>

              <?php
              $savedPropertyTypes = array_map('trim', explode(',', $me['property_types'] ?? ''));
              $savedInvestmentTypes = array_map('trim', explode(',', $me['investment_types'] ?? ''));
              ?>
              <div class="mvv-property-section">
                <h3>Property Details</h3>
                <p>Add property, vehicle, investment and rental-income information.</p>
                <div class="mvv-property-grid">
                  <div class="mvv-field" style="grid-column:1/-1;">
                    <label>Properties Owned</label>
                    <div class="mvv-property-options">
                      <?php foreach(['Flat', 'Bungalow', 'Car', 'Plot', 'Land', 'Farm', 'Commercial Property', 'Other'] as $propertyType) { ?>
                      <label class="mvv-property-option">
                        <input type="checkbox" name="property_types[]" value="<?php echo $propertyType; ?>" <?php echo in_array($propertyType, $savedPropertyTypes, true) ? 'checked' : ''; ?>>
                        <span><?php echo $propertyType; ?></span>
                      </label>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="mvv-field" style="grid-column:1/-1;">
                    <label>Property Description</label>
                    <textarea name="property_details" rows="4" maxlength="1000" placeholder="Example: 2 BHK flat in Pune, agricultural land, two cars, commercial shop..."><?php echo htmlspecialchars($me['property_details'] ?? ''); ?></textarea>
                  </div>
                  <div class="mvv-field">
                    <label>Investments</label>
                    <div class="mvv-property-options" style="grid-template-columns:1fr 1fr;">
                      <?php foreach(['Stocks', 'Mutual Funds'] as $investmentType) { ?>
                      <label class="mvv-property-option">
                        <input type="checkbox" name="investment_types[]" value="<?php echo $investmentType; ?>" <?php echo in_array($investmentType, $savedInvestmentTypes, true) ? 'checked' : ''; ?>>
                        <span><?php echo $investmentType; ?></span>
                      </label>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="mvv-field">
                    <label>Monthly Rental Income</label>
                    <input type="text" name="monthly_rental_income" value="<?php echo htmlspecialchars($me['monthly_rental_income'] ?? ''); ?>" maxlength="10" inputmode="numeric" onKeyPress="return isNumber(event);" placeholder="Enter monthly rental income">
                  </div>
                  <div class="mvv-field" style="grid-column:1/-1;">
                    <label>Investment Details</label>
                    <textarea name="investment_details" rows="3" maxlength="1000" placeholder="Enter stock or mutual-fund investment details (optional)"><?php echo htmlspecialchars($me['investment_details'] ?? ''); ?></textarea>
                  </div>
                </div>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>Relatives Information</label>
                <textarea name="relative" placeholder="Enter Relatives Information" rows="4" MaxLength="250" tabindex="17"><?php echo $me['relatives']?></textarea>
                <small style="color:var(--mvv-muted);">Enter Relatives Information Surname With City Name</small>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>About Your Family</label>
                <textarea name="aboufamily" rows="4" placeholder="Enter Few Lines About Your Family" MaxLength="500" tabindex="18"><?php echo $me['FamilyDetails']?></textarea>
                <small style="color:var(--mvv-muted);">Enter few lines about your Family <a href="#" data-bs-toggle="modal" data-bs-target="#myModal4">Examples</a></small>
              </div>
            </div>

            <div class="mvv-field" style="grid-column:1/-1;margin-top:12px;">
              <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" tabindex="19">Update</button>
            </div>
          </form>
        </div>
        <?php } else { ?>
        <div class="col-lg-9 col-md-12">
          <form method="post" action="#" class="mvv-form">
            <div class="mvv-eyebox">Family Details</div>
            <h2 class="mvv-title" style="font-size:clamp(1.4rem,2.4vw,2rem);">फॅमिली डिटेल्स भरा</h2>

            <div class="mvv-form-grid">
              <div class="mvv-field">
                <label>Family Values</label>
                <select name="fvalues" autofocus tabindex="1">
                  <option value="" selected>Select Family values</option>
                  <?php $familysql=mysqli_query($con,"select * from family_values where family_values!='".$row['Familyvalues']."'");
                  while($familys=mysqli_fetch_array($familysql)) { ?>
                  <option value="<?php echo $familys['family_values'];?>"><?php echo $familys['family_values'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field">
                <label>Family Type</label>
                <select name="ftype" tabindex="2">
                  <option value="" selected>Select Family Type</option>
                  <?php $famitypsql=mysqli_query($con,"select * from family_type where family_typ!='".$row['FamilyType']."'");
                  while($familytyp=mysqli_fetch_array($famitypsql)) { ?>
                  <option value="<?php echo $familytyp['family_typ'];?>"><?php echo $familytyp['family_typ'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="emailerror">
                <label>Family Status</label>
                <select name="fstatus" tabindex="3">
                  <option value="" selected>Select Family Status</option>
                  <?php $famisql=mysqli_query($con,"select * from family_status where family_status!='".$row['FamilyStatus']."'");
                  while($familyst=mysqli_fetch_array($famisql)) { ?>
                  <option value="<?php echo $familyst['family_status'];?>"><?php echo $familyst['family_status'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field">
                <label>Mother Tongue</label>
                <select name="mother_tounge" id="mother_tounge" tabindex="4">
                  <option value="" selected>Select Mother Tongue</option>
                  <option value="Assamese">Assamese</option>
                  <option value="Bengali">Bengali</option>
                  <option value="Bodo">Bodo</option>
                  <option value="Dogri">Dogri</option>
                  <option value="Gujarati">Gujarati</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Kannada">Kannada</option>
                  <option value="Kashmiri">Kashmiri</option>
                  <option value="Konkani">Konkani</option>
                  <option value="Maithili">Maithili</option>
                  <option value="Malayalam">Malayalam</option>
                  <option value="Manipuri">Manipuri</option>
                  <option value="Marathi">Marathi</option>
                  <option value="Nepali">Nepali</option>
                  <option value="Odia">Odia</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Sanskrit">Sanskrit</option>
                  <option value="Santali">Santali</option>
                  <option value="Sindhi">Sindhi</option>
                  <option value="Tamil">Tamil</option>
                  <option value="Telugu">Telugu</option>
                  <option value="Urdu">Urdu</option>
                </select>
              </div>

              <div class="mvv-field">
                <label>No. of Brothers</label>
                <select name="brothers" id="noofbrom" tabindex="5">
                  <option value="" selected>Select No.of Brothers</option>
                  <?php $nobro=mysqli_query($con,"select * from no_of_brother");
                  while($nobros=mysqli_fetch_array($nobro)) { ?>
                  <option value="<?php echo $nobros['number'];?>"><?php echo $nobros['number'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="noofbro6">
                <label>No. of Brothers Married</label>
                <select name="bmarried6" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="5+">5+</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro5">
                <label>No. of Brothers Married</label>
                <select name="bmarried5" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro4">
                <label>No. of Brothers Married</label>
                <select name="bmarried4" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro3">
                <label>No. of Brothers Married</label>
                <select name="bmarried3" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro2">
                <label>No. of Brothers Married</label>
                <select name="bmarried2" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbro1">
                <label>No. of Brothers Married</label>
                <select name="bmarried1" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                </select>
              </div>

              <div class="mvv-field" id="noofbrono">
                <label>No. of Brothers Married</label>
                <select name="bmarriedno" tabindex="6">
                  <option value="">Select No. of Brothers Married</option>
                  <option value="No">No</option>
                </select>
              </div>

              <div class="mvv-field">
                <label>No. of Sisters</label>
                <select name="sisters" id="noofsism" tabindex="7">
                  <option value="" selected>Select No. of Sisters</option>
                  <?php $nosis=mysqli_query($con,"select * from no_of_sister");
                  while($nosistr=mysqli_fetch_array($nosis)) { ?>
                  <option value="<?php echo $nosistr['number'];?>"><?php echo $nosistr['number'];?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="mvv-field" id="noofsis6">
                <label>No. of Sisters Married</label>
                <select name="smarried6" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="5+">5+</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis5">
                <label>No. of Sisters Married</label>
                <select name="smarried5" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis4">
                <label>No. of Sisters Married</label>
                <select name="smarried4" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis3">
                <label>No. of Sisters Married</label>
                <select name="smarried3" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis2">
                <label>No. of Sisters Married</label>
                <select name="smarried2" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsis1">
                <label>No. of Sisters Married</label>
                <select name="smarried1" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                  <option value="1">1</option>
                </select>
              </div>

              <div class="mvv-field" id="noofsisno">
                <label>No. of Sisters Married</label>
                <select name="smarriedno" tabindex="8">
                  <option value="">Select No. of Sisters Married</option>
                  <option value="No">No</option>
                </select>
              </div>

              <div class="mvv-field">
                <label>Father Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter Father Name" maxlength="35" name="father" required onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" tabindex="9">
              </div>

              <div class="mvv-field">
                <label>Father Occupation</label>
                <input type="text" placeholder="Enter Father Occupation" maxlength="40" name="fatherOccupation" onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" tabindex="10">
              </div>

              <div class="mvv-field">
                <label>Mother Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter Mother Name" required onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" maxlength="35" name="mother" tabindex="11">
              </div>

              <div class="mvv-field">
                <label>Mother Occupation</label>
                <input type="text" placeholder="Enter Mother Occupation" maxlength="40" name="motheroccupation" onKeyPress="return ValidateAlpha(event);return blockSpecialChar(event);" tabindex="12">
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>Living Status</label>
                <div class="mvv-radio-group">
                  <label class="mvv-radio-label">
                    <input type="radio" name="living_status" <?=$me['parents_stay']=="My parents will stay with me after marriage" ? "checked" : ""?> value="My parents will stay with me after marriage" tabindex="13">
                    <span class="radio-dot">&#10003;</span>
                    <span>My parents will stay with me after marriage</span>
                  </label>
                  <label class="mvv-radio-label">
                    <input type="radio" name="living_status" <?=$me['parents_stay']=="My parents will not stay with me after marriage" ? "checked" : ""?> value="My parents will not stay with me after marriage" tabindex="14">
                    <span class="radio-dot">&#10003;</span>
                    <span>My parents will not stay with me after marriage</span>
                  </label>
                  <label class="mvv-radio-label">
                    <input type="radio" name="living_status" <?=$me['parents_stay']=="Dont wish to specify" ? "checked" : ""?> value="Dont wish to specify" tabindex="15">
                    <span class="radio-dot">&#10003;</span>
                    <span>Don't wish to specify</span>
                  </label>
                </div>
              </div>

              <div class="mvv-property-section">
                <h3>Property Details</h3>
                <p>Add property, vehicle, investment and rental-income information.</p>
                <div class="mvv-property-grid">
                  <div class="mvv-field" style="grid-column:1/-1;">
                    <label>Properties Owned</label>
                    <div class="mvv-property-options">
                      <?php foreach(['Flat', 'Bungalow', 'Car', 'Plot', 'Land', 'Farm', 'Commercial Property', 'Other'] as $propertyType) { ?>
                      <label class="mvv-property-option">
                        <input type="checkbox" name="property_types[]" value="<?php echo $propertyType; ?>">
                        <span><?php echo $propertyType; ?></span>
                      </label>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="mvv-field" style="grid-column:1/-1;">
                    <label>Property Description</label>
                    <textarea name="property_details" rows="4" maxlength="1000" placeholder="Example: 2 BHK flat in Pune, agricultural land, two cars, commercial shop..."></textarea>
                  </div>
                  <div class="mvv-field">
                    <label>Investments</label>
                    <div class="mvv-property-options" style="grid-template-columns:1fr 1fr;">
                      <label class="mvv-property-option"><input type="checkbox" name="investment_types[]" value="Stocks"><span>Stocks</span></label>
                      <label class="mvv-property-option"><input type="checkbox" name="investment_types[]" value="Mutual Funds"><span>Mutual Funds</span></label>
                    </div>
                  </div>
                  <div class="mvv-field">
                    <label>Monthly Rental Income</label>
                    <input type="text" name="monthly_rental_income" maxlength="10" inputmode="numeric" onKeyPress="return isNumber(event);" placeholder="Enter monthly rental income">
                  </div>
                  <div class="mvv-field" style="grid-column:1/-1;">
                    <label>Investment Details</label>
                    <textarea name="investment_details" rows="3" maxlength="1000" placeholder="Enter stock or mutual-fund investment details (optional)"></textarea>
                  </div>
                </div>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>Relatives Information</label>
                <textarea name="relative" placeholder="Enter Relatives Information" rows="4" MaxLength="250" tabindex="17"></textarea>
                <small style="color:var(--mvv-muted);">Enter Relatives Information Surname With City Name</small>
              </div>

              <div class="mvv-field" style="grid-column:1/-1;">
                <label>About Your Family</label>
                <textarea name="aboufamily" rows="4" placeholder="Enter Few Lines About Your Family" MaxLength="500" tabindex="18"></textarea>
                <small style="color:var(--mvv-muted);">Enter few lines about your Family <a href="#" data-bs-toggle="modal" data-bs-target="#myModal4">Examples</a></small>
              </div>
            </div>

            <div class="mvv-field" style="grid-column:1/-1;margin-top:12px;">
              <button class="mvv-btn mvv-btn-primary" type="submit" name="submit" tabindex="19">Submit Now</button>
            </div>
          </form>
        </div>
        <?php } ?>

        <div class="col-lg-3 col-md-12">
          <?php
          $check=$_GET['flag'];
          if($check==1) {
            include('contactinfo.php');
          } else {
            include('congratulations.php');
          }
          ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

<div class="modal fade" id="myModal4" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Example Of About Us</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo "I hail from a family of four members and we are from Dharasuram, a small town near Kumbakonam, but currently, reside in Chennai.My father is a school principal (SBOA Matriculation School) and my mother is a bank teller (Canara Bank). They are both retired now and I currently live with them.I have an elder brother who is doing his master's degree in Computer Science in the United States.We are not an orthodox family but believes in respect for all religions and sects. My father is an Iyer and my mother is an Iyengar. We do not follow elaborate rituals but do celebrate most festivals and visit temples. We have a tradition of visiting a new place once every year as we believe it helps us learn new things and gives us a chance to meet new people.";?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>
.mvv-hide { display: none !important; }
.mvv-multi-wrap { position: relative; }
.mvv-multi-btn {
  width:100%; min-height:46px;
  border:1px solid var(--mvv-border,#d4c5b0); border-radius:6px;
  background:#fff; color:var(--mvv-text,#5a4a3a);
  padding:11px 13px; text-align:left;
  display:flex; align-items:center; justify-content:space-between;
  cursor:pointer;
}
.mvv-multi-drop {
  display:none; position:absolute; top:100%; left:0; right:0; z-index:100;
  background:#fff; border:1px solid var(--mvv-border,#d4c5b0);
  border-radius:6px; max-height:220px; overflow-y:auto;
  box-shadow:0 8px 24px rgba(0,0,0,0.12);
}
.mvv-multi-drop.open { display:block; }
.mvv-field .mvv-multi-opt {
  display:flex; align-items:center; gap:10px;
  padding:10px 14px; margin:0; cursor:pointer;
  font-size:0.9rem; color:var(--mvv-text,#5a4a3a);
  font-weight:400; letter-spacing:normal; text-transform:none;
  transition:background 0.15s;
}
.mvv-multi-opt:hover { background:var(--mvv-cream,#FFFDFB); }
.mvv-field .mvv-multi-opt input[type="checkbox"] { width:18px; min-width:18px; min-height:18px; height:18px; padding:0; margin:0; accent-color:var(--mvv-gold,#BA9350); }
</style>

<script>
document.querySelector('.modal-body')?.addEventListener('copy paste cut', function(e) { e.preventDefault(); });
</script>

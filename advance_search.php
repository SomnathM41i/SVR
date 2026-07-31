<?php
require_once('includes/bootstrap.php');
include('memprotect.php');
$strid = $_SESSION['matriid'];
$check=mysqli_query($con,"select * from register where MatriID='$strid'");
$fetch=mysqli_fetch_array($check);
//error_reporting(0);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Advance Search</title>
  <link rel="icon" type="image/png" sizes="32x32" href="branding/favicons/icon-32.png">
  <link rel="stylesheet" href="css3/Style.css" />
  <link rel="stylesheet" href="css3/mvv-premium.css" />
  <style>
  .mvv-page-hero h1 { text-transform:none; }
  .contact-form .form-group { margin-left:0; }
  .advance-search-form .mvv-multiselect {
    position: relative;
    width: 100%;
  }
  .advance-search-form .mvv-multiselect-toggle {
    width: 100%;
    min-height: 38px;
    padding: 10px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    color: var(--text-dark);
    font-family: var(--font-body);
    font-size: 0.95rem;
    line-height: 1.25;
    text-align: left;
    background: var(--cream) !important;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    box-shadow: none;
    cursor: pointer;
  }
  .advance-search-form .mvv-multiselect-toggle::after {
    content: "";
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 6px solid var(--text-muted);
    flex-shrink: 0;
  }
  .advance-search-form .mvv-multiselect.open .mvv-multiselect-toggle {
    border-color: var(--gold);
    background: var(--white) !important;
    box-shadow: 0 0 0 3px rgba(201,151,58,0.15);
  }
  .advance-search-form .mvv-multiselect-text {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .advance-search-form .mvv-multiselect-menu {
    display: none;
    position: absolute;
    z-index: 50;
    top: calc(100% + 5px);
    left: 0;
    right: 0;
    max-height: 260px;
    overflow: auto;
    padding: 6px 0;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    box-shadow: 0 16px 35px rgba(44,24,16,0.14);
  }
  .advance-search-form .mvv-multiselect.open .mvv-multiselect-menu {
    display: block;
  }
  .advance-search-form .mvv-multiselect-option {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    margin: 0;
    padding: 8px 14px;
    color: var(--text-dark);
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
  }
  .advance-search-form .mvv-multiselect-option:hover,
  .advance-search-form .mvv-multiselect-option.is-selected {
    background: rgba(201,151,58,0.14);
  }
  .advance-search-form .mvv-multiselect-option input {
    width: auto;
    height: auto !important;
    margin: 0;
    padding: 0;
    accent-color: var(--gold);
  }
  .advance-search-form .mvv-multiselect-empty {
    padding: 9px 14px;
    color: var(--text-muted);
    font-size: 0.9rem;
  }
  .advance-search-form .mvv-multiselect-search-wrap {
    position: sticky;
    top: 0;
    z-index: 2;
    padding: 7px;
    background: #fff;
    border-bottom: 1px solid var(--border);
  }
  .advance-search-form .mvv-multiselect-search {
    width: 100%;
    min-height: 38px;
    padding: 7px 10px;
    border: 1px solid var(--border);
    border-radius: 7px;
    background: #fff;
    color: var(--text-dark);
    font: inherit;
  }
  .advance-search-form .mvv-multiselect-search:focus {
    outline: none;
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(201,151,58,0.15);
  }
  .advance-search-form select[multiple].mvv-multiselect-source {
    display: none !important;
  }
</style>
</head>

<body>
<?php include('header.php'); ?>

<main class="mvv-page">
  <section class="mvv-page-hero">
    <div class="mvv-container">
      <div class="mvv-eyebrow">Search</div>
      <h1>Advance Search</h1>
      <p>प्रगत शोध</p>
      <nav class="mvv-breadcrumb" aria-label="breadcrumb">
        <a href="index_dashboard.php">Home</a>
        <span>Advance Search</span>
      </nav>
    </div>
  </section>

  <section class="mvv-section">
    <div class="mvv-container">
      <div class="contact-form advance-search-form">
        <div class="text">Find Your Special Someone Here </div>
        <div class="col-lg-12">
          <form class="form-horizontal" action="#" method="post"  name="form1">
            <div class="row">		
              <div class="col-lg-9 col-md-9 col-sm-12 form-group">								 
                <select   name="ms[]" id="ms" multiple >
                  <option value="Unmarried">Unmarried</option>
                  <option value="Separated">Separated</option>
                  <option value="Widowed">Widowed</option>
                  <option value="Divorced">Divorced</option>
                  <option value="Any">Any</option>
                </select> 
              </div>  								
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">			                                                     
                <select class="custom-select-box"  id="fromage"  name="txtSAge"  onChange="fillage(this.value)"  required tabindex="2">
                  <option value="" selected> Select From Age</option>				
                  <?php 
                    $rrsfromage=mysqli_query($con,"SELECT * FROM fromage");
                    while($rrowfromage=mysqli_fetch_assoc($rrsfromage))
                    {
                    ?>
                  <option value="<?php echo $rrowfromage['fromage'];?>"><?php echo $rrowfromage['fromage'];?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 form-group">			
                <select class="custom-select-box"  name="txtEAge" id="toage" name="txtEAge" required>
                  <option value> Select To Age</option>
                  <option value="" selected> To Age</option>				
                  <?php 
                    $rrstoage=mysqli_query($con,"SELECT * FROM toage");
                    while($rrowtoage=mysqli_fetch_assoc($rrstoage))
                    {
                    ?>
                  <option value="<?php echo $rrowtoage['toage'];?>"><?php echo $rrowtoage['toage'];?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">			
                <select class="custom-select-box"  name="height1"  title='From Height ' required >   
                  <option value=""> select From Height</option>			
                  <option value="1" >4Ft </option>
                  <option value="2" >4Ft 1 inch </option>
                  <option value="3" >4Ft 2 inch </option>
                  <option value="4" >4Ft 3 inch </option>
                  <option value="5" >4Ft 4 inch </option>
                  <option value="6" >4Ft 5 inch </option>
                  <option value="7" >4Ft 6 inch </option>
                  <option value="8" >4Ft 7 inch </option>
                  <option value="9" >4Ft 8 inch </option>
                  <option value="10" >4Ft 9 inch </option>
                  <option value="11" >4Ft 10 inch </option>
                  <option value="12" >4Ft 11 inch </option>
                  <option value="13" >5Ft </option>
                  <option value="14" >5Ft 1 inch </option>
                  <option value="15" >5Ft 2 inch </option>
                  <option value="16" >5Ft 3 inch </option>
                  <option value="17" >5Ft 4 inch </option>
                  <option value="18" >5Ft 5 inch </option>
                  <option value="19" >5Ft 6 inch </option>
                  <option value="20" >5Ft 7 inch </option>
                  <option value="21" >5Ft 8 inch </option>
                  <option value="22" >5Ft 9 inch </option>
                  <option value="23" >5Ft 10 inch </option>
                  <option value="24" >5Ft 11 inch </option>
                  <option value="25" >6Ft </option>
                  <option value="26" >6Ft 1 inch </option>
                  <option value="27" >6Ft 2 inch </option>
                  <option value="28" >6Ft 3 inch </option>
                  <option value="29" >6Ft 4 inch </option>
                  <option value="30" >6Ft 5 inch </option>
                  <option value="31" >6Ft 6 inch </option>
                  <option value="32" >6Ft 7 inch </option>
                  <option value="33" >6Ft 8 inch </option>
                  <option value="34" >6Ft 9 inch </option>
                  <option value="35" >6Ft 10 inch </option>
                  <option value="36" >6Ft 11 inch </option>
                  <option value="37" >7Ft </option>
                </select>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 form-group">			
                <select class="custom-select-box"  name="height2"  title='To Height' required >									
                  <option value="" >Select To Height </option>
                  <option value="1" >4Ft </option>
                  <option value="2" >4Ft 1 inch </option>
                  <option value="3" >4Ft 2 inch </option>
                  <option value="4" >4Ft 3 inch </option>
                  <option value="5" >4Ft 4 inch </option>
                  <option value="6" >4Ft 5 inch </option>
                  <option value="7" >4Ft 6 inch </option>
                  <option value="8" >4Ft 7 inch </option>
                  <option value="9" >4Ft 8 inch </option>
                  <option value="10" >4Ft 9 inch </option>
                  <option value="11" >4Ft 10 inch </option>
                  <option value="12" >4Ft 11 inch </option>
                  <option value="13" >5Ft </option>
                  <option value="14" >5Ft 1 inch </option>
                  <option value="15" >5Ft 2 inch </option>
                  <option value="16" >5Ft 3 inch </option>
                  <option value="17" >5Ft 4 inch </option>
                  <option value="18" >5Ft 5 inch </option>
                  <option value="19" >5Ft 6 inch </option>
                  <option value="20" >5Ft 7 inch </option>
                  <option value="21" >5Ft 8 inch </option>
                  <option value="22" >5Ft 9 inch </option>
                  <option value="23" >5Ft 10 inch </option>
                  <option value="24" >5Ft 11 inch </option>
                  <option value="25" >6Ft </option>
                  <option value="26" >6Ft 1 inch </option>
                  <option value="27" >6Ft 2 inch </option>
                  <option value="28" >6Ft 3 inch </option>
                  <option value="29" >6Ft 4 inch </option>
                  <option value="30" >6Ft 5 inch </option>
                  <option value="31" >6Ft 6 inch </option>
                  <option value="32" >6Ft 7 inch </option>
                  <option value="33" >6Ft 8 inch </option>
                  <option value="34" >6Ft 9 inch </option>
                  <option value="35" >6Ft 10 inch </option>
                  <option value="36" >6Ft 11 inch </option>
                  <option value="37">7Ft </option>
                </select>
              </div>
              
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">			
                <select   title='Select Religion' name="religion[]" id="religion" multiple>
                  <?php 
                    $rrs=mysqli_query($con,"SELECT * FROM religion WHERE status='enable' ORDER BY Religion ASC");
                    while($rrow=mysqli_fetch_assoc($rrs))
                    {
                    ?>
                    <option value="<?php echo $rrow['Religion'];?>"><?php echo $rrow['Religion'];?></option>
                    <?php }
                    ?>
                </select>
              </div>  	
              <div class="col-lg-5 col-md-5 col-sm-12 form-group">			
                <select class="custom-select-box"  id="caste" name="caste[]" multiple>
                </select>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">							 
                <select  name="education[]" title='Select Education'  id="education" size="5" multiple >
                  <option value="Any" >Any</option>
                  <?php  $edusql=mysqli_query($con,"select * from education where status='enable'");
                    while($edurow=mysqli_fetch_assoc($edusql))
                    { ?>
                    <option value="<?php echo $edurow['edu']; ?>"><?php echo $edurow['edu']; ?></option>
                    <?php } ?>
                </select>
              </div>  
              <div class="col-lg-5 col-md-5 col-sm-12 form-group">			
                <select   title='Select Occupation'  name="occupation[]" id="occupation" multiple>
                  <option value="Any" >Any</option>
                  <?php 
                    $query14 = mysqli_query($con,"SELECT * FROM occupation where status='enable'");
                    while($row16 = mysqli_fetch_assoc($query14)) {
                      echo '<option value="'.$row16['occu'].'">'.$row16['occu'].'</option>';
                    }
                    ?>
                </select>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">										
                <select    title='Select Country' name="Country1[]" id="country" multiple size="5" >
                  <?php $query15 =mysqli_query($con,"SELECT * FROM e_country where status='enable'");
                    while($rowc12 = mysqli_fetch_assoc($query15)) {
                      echo '<option value="'.$rowc12['country'].'">'.$rowc12['country'].'</option>';
                    } 
                  ?>
                </select>
              </div>
              
              <div class="col-lg-5 col-md-5 col-sm-12 form-group">							
                <select   id="cbostate" title='select State'   name="cbostate[]"  id="cbostate" multiple size="5">
                  <?php 
                  ?>
                </select>
              </div>
              
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">								
                <select    title='Select District'   id="dist" multiple name="dist[]">
                  <?php ?>
                </select>
              </div> 
              
              <div class="col-lg-5 col-md-5 col-sm-12 form-group mr-4">								
                <select title='Select Taluka' id="taluka" multiple name="taluka[]">
                </select>
              </div>

              <div class="col-lg-5 col-md-5 col-sm-12 form-group">					
                <select    title='Select City' id="city"  multiple  name="city[]" >
                </select>
              </div>
              
              <div class="col-lg-11 col-md-11 col-sm-12   form-group" >			
                <select class="custom-select-box divcs" name="with_photo" id="with_photo" >
                  <option value="withphoto" selected > With Photo</option>	
                  <option value="withoutphoto">Without Photo</option>	
                </select>
              </div>  
            </div>
          </div>	
          
          <?php $ty=mysqli_query($con,"select * from advance_saveandsearch where MatriID='".$_SESSION['matri_login']."'");
          if(mysqli_num_rows($ty)>=5) { ?>
          <a href="#dialog_send_message" data-toggle="modal">
          <button class="mvv-btn mvv-btn-primary mt-3 mb-2" type="Submit" name=""  ><span class="btn-title">Save Search</span></button></a>
          <?php } else { ?>
          <button class="mvv-btn mvv-btn-primary mt-3 mb-2" type="Submit" name="basic"  onClick="getsearch2();"><span class="btn-title">Save Search</span></button>
          <?php }?>			
          <button class="mvv-btn mvv-btn-primary mt-3 mb-2" type="submit" name="Search"  onClick="getsearch1();selectAll()"><span class="btn-title">Let's Begin</span></button>
        </div>
        </div>
      </form>		
    </div>
  </section>
  
  <div class="modal fade" id="dialog_send_message" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="dialog_content">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
        <div class="modal-body" align="center">
          <h4> Already You Have Done 6 Save & Search.  <br><br> 
          Please Delete Old and then try again</h4>
        </div>
      </div>
    </div>
  </div>
  
</main>

<?php include('footer3.php')?>

<script>
 function getsearch1()
 {
	 document.form1.action="advance_search_result.php?page=1";
 }
 function getsearch2()
 {
	 document.form1.action="step_advance.php";
 }
 </script>
<?php include('popup.php')?>

<script src="js/jquery.js"></script>
<script>
function selectAll()
{
 ensureAdvanceSearchDefaults();
 return true;
}

function fillage(str)
{
 if (str === '') {
  document.getElementById('toage').innerHTML = '<option value="" selected> To Age</option>';
  return;
 }

 $.ajax({
  url: 'filltoage.php',
  method: 'GET',
  data: { q: str },
  success: function(data) {
   $('#toage').html(data);
  }
 });
}

function ensureAdvanceSearchDefaults()
{
 var ms = document.getElementById('ms');

 if (ms && !Array.prototype.some.call(ms.options, function(option) { return option.selected; })) {
  Array.prototype.forEach.call(ms.options, function(option) {
   option.selected = true;
  });
  $('#ms').multiselect('refresh');
 }
}

(function($) {
 function buildMultiselect($select, options) {
  var state = $select.data('mvvMultiselect');

  if (!state) {
   $select.addClass('mvv-multiselect-source');
   var $wrap = $('<div class="mvv-multiselect"></div>');
   var $button = $('<button type="button" class="mvv-multiselect-toggle" aria-expanded="false"></button>');
   var $text = $('<span class="mvv-multiselect-text"></span>');
   var $menu = $('<div class="mvv-multiselect-menu"></div>');

   $button.append($text);
   $wrap.append($button, $menu);
   $select.after($wrap);

   state = {
    options: options,
    $select: $select,
    $wrap: $wrap,
    $button: $button,
    $text: $text,
    $menu: $menu
   };

   $button.on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('.advance-search-form .mvv-multiselect').not($wrap).removeClass('open').find('.mvv-multiselect-toggle').attr('aria-expanded', 'false');
   $wrap.toggleClass('open');
   $button.attr('aria-expanded', $wrap.hasClass('open') ? 'true' : 'false');
   if ($wrap.hasClass('open')) {
    window.setTimeout(function() {
     $menu.find('.mvv-multiselect-search').trigger('focus');
    }, 0);
   }
  });

   $menu.on('click', function(e) {
    e.stopPropagation();
   });

   $select.data('mvvMultiselect', state);
  } else {
   state.options = $.extend({}, state.options, options);
  }

  renderMultiselect(state);
  updateMultiselectText(state);
 }

 function renderMultiselect(state) {
  state.$menu.empty();

  if (!state.$select.find('option').length) {
   state.$menu.append('<div class="mvv-multiselect-empty">No options available</div>');
   return;
  }

  var searchLabel = (state.options.nonSelectedText || 'options').replace(/^Select\s+/i, '');
  var $searchWrap = $('<div class="mvv-multiselect-search-wrap"></div>');
  var $search = $('<input type="search" class="mvv-multiselect-search">')
   .attr('placeholder', 'Search ' + searchLabel + '...')
   .attr('aria-label', 'Search ' + searchLabel + ' options');
  var $empty = $('<div class="mvv-multiselect-empty" style="display:none">No matching options</div>');
  $searchWrap.append($search);
  state.$menu.append($searchWrap);

  $search.on('click', function(e) {
   e.stopPropagation();
  }).on('input', function() {
   var query = this.value.trim().toLocaleLowerCase();
   var visible = 0;
   state.$menu.find('.mvv-multiselect-option').each(function() {
    var matches = !query || $(this).text().toLocaleLowerCase().indexOf(query) !== -1;
    $(this).toggle(matches);
    if (matches) visible++;
   });
   $empty.toggle(visible === 0);
  }).on('keydown', function(e) {
   if (e.key === 'Escape') {
    state.$wrap.removeClass('open');
    state.$button.attr('aria-expanded', 'false').trigger('focus');
   }
  });

  state.$select.find('option').each(function(index) {
   var option = this;
   var $option = $(option);
   var id = state.$select.attr('id') + '_mvv_' + index;
   var $label = $('<label class="mvv-multiselect-option"></label>');
   var $checkbox = $('<input type="checkbox">').attr('id', id).val($option.val()).prop('checked', option.selected);
   var $name = $('<span></span>').text($option.text());

   if (option.selected) {
    $label.addClass('is-selected');
   }

   $label.append($checkbox, $name);
   state.$menu.append($label);

   $checkbox.on('change', function() {
    var checked = $(this).prop('checked');
    option.selected = checked;
    $label.toggleClass('is-selected', checked);
    updateMultiselectText(state);
    state.$select.trigger('change');

    if (typeof state.options.onChange === 'function') {
     state.options.onChange.call({ $select: state.$select }, $option, checked);
    }
   });
  });
  state.$menu.append($empty);
 }

 function updateMultiselectText(state) {
  var selectedText = [];
  state.$select.find('option:selected').each(function() {
   selectedText.push($(this).text());
  });

  if (!selectedText.length) {
   state.$text.text(state.options.nonSelectedText || 'Select');
  } else if (selectedText.length > (state.options.numberDisplayed || 1)) {
   state.$text.text(selectedText.length + ' selected');
  } else {
   state.$text.text(selectedText.join(', '));
  }
 }

 $.fn.multiselect = function(option) {
  if (typeof option === 'string') {
   return this.each(function() {
    var state = $(this).data('mvvMultiselect');
    if (!state) {
     return;
    }
    if (option === 'rebuild' || option === 'refresh') {
     renderMultiselect(state);
     updateMultiselectText(state);
    }
    if (option === 'destroy') {
     state.$wrap.remove();
     state.$select.removeClass('mvv-multiselect-source').removeData('mvvMultiselect');
    }
   });
  }

  return this.each(function() {
   buildMultiselect($(this), $.extend({ numberDisplayed: 1 }, option || {}));
  });
 };

 $(document).on('click', function() {
  $('.advance-search-form .mvv-multiselect').removeClass('open').find('.mvv-multiselect-toggle').attr('aria-expanded', 'false');
 });
})(jQuery);

$(document).ready(function(){
 var commonMultiselectOptions = {
  numberDisplayed: 1
 };

 $('#ms').multiselect({
  nonSelectedText:'Select Marital Status',
  numberDisplayed: commonMultiselectOptions.numberDisplayed
 });

 $('#religion').multiselect({
  nonSelectedText:'Select Religion',
  numberDisplayed: commonMultiselectOptions.numberDisplayed,
  onChange:function(option, checked){
   $('#caste').html('');
   $('#caste').multiselect('rebuild');
   $('#caste').html('');
   $('#caste').multiselect('rebuild');
   var selected = this.$select.val() || [];
   if(selected.length > 0)
   {
    $.ajax({
     url:"castonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#caste').html(data);
      $('#caste').multiselect('rebuild');
     }
    })
   }
  }
 });
 $('#caste').multiselect({
  nonSelectedText: 'Select Caste',
  numberDisplayed: commonMultiselectOptions.numberDisplayed
 });

 $('#education').multiselect({
  nonSelectedText:'Select education',
  numberDisplayed: commonMultiselectOptions.numberDisplayed
 });

 $('#occupation').multiselect({
  nonSelectedText:'Select Occupation',
  numberDisplayed: commonMultiselectOptions.numberDisplayed
 });

 $('#country').multiselect({
  nonSelectedText:'Select Country',
  numberDisplayed: commonMultiselectOptions.numberDisplayed,
  onChange:function(option, checked){
   $('#cbostate').html('');
   $('#cbostate').multiselect('rebuild');
   $('#cbostate').html('');
   $('#cbostate').multiselect('rebuild');
   var selected = this.$select.val() || [];
   if(selected.length > 0)
   {
    $.ajax({
     url:"stateonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#cbostate').html(data);
      $('#cbostate').multiselect('rebuild');
     }
    })
   }
  }
 });
 $('#cbostate').multiselect({
  nonSelectedText: 'Select State',
  numberDisplayed: commonMultiselectOptions.numberDisplayed,
  onChange:function(option, checked){
   $('#dist').html('');
   $('#dist').multiselect('rebuild');
   $('#dist').html('');
   $('#dist').multiselect('rebuild');
   var selected = this.$select.val() || [];
   if(selected.length > 0)
   {
    $.ajax({
     url:"distonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#dist').html(data);
      $('#dist').multiselect('rebuild');
     }
    })
   }
  }
 });

$('#dist').multiselect({
  nonSelectedText: 'Select District',
  numberDisplayed: commonMultiselectOptions.numberDisplayed,
  onChange:function(option, checked){
    $('#taluka').html('');
    $('#taluka').multiselect('rebuild');
    $('#city').html('');
    $('#city').multiselect('rebuild');
    var selected = this.$select.val() || [];
    if(selected.length > 0)
    {
     $.ajax({
      url:"talukaonchange.php",
      method:"POST",
      data:{selected:selected},
      success:function(data)
      {
       $('#taluka').html(data);
       $('#taluka').multiselect('rebuild');
      }
     })
    }
   }
  });

 $('#taluka').multiselect({
  nonSelectedText: 'Select Taluka',
  numberDisplayed: commonMultiselectOptions.numberDisplayed,
  onChange:function(option, checked){
   $('#city').html('');
   $('#city').multiselect('rebuild');
   var selected = this.$select.val() || [];
   if(selected.length > 0)
   {
    $.ajax({
     url:"citybytalukaonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#city').html(data);
      $('#city').multiselect('rebuild');
     }
    })
   }
  }
 });

 $('#city').multiselect({
  nonSelectedText: 'Select City',
  numberDisplayed: commonMultiselectOptions.numberDisplayed
 });

 $('form[name="form1"]').on('submit', function() {
  ensureAdvanceSearchDefaults();
 });
});
</script>
<script>
$(document).ready(function() {
  $('.btn').on('click', function() {
    var $this = $(this);
    var loadingText = '<i class="fa fa-spinner fa-spin faio"></i><span class="btn-title">Loading</span> ';
    if ($(this).html() !== loadingText) {
      $this.data('original-text', $(this).html());
      $this.html(loadingText);
    }
    setTimeout(function() {
      $this.html($this.data('original-text'));
    }, 500);
  });
})
</script>
</body>
</html>

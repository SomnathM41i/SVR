<?php require_once(dirname(__FILE__).'/protect.php'); ?>
<link rel="stylesheet" href="assets/css/partner.css" id="main-style-link">
<link rel="stylesheet" href="assets/css/plugins/select2.min.css">
	<div class="row">
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Looking For</label><br>

                                            <input type="hidden" name="ID" value="<?php  echo $_GET['ID'];?>">
                                            <select  name="txtLooking[]" id="looking" multiple="multiple">
											<?php if($row['Looking']!='') { ?>
											   <option value="<?php echo $row['Looking']; ?>" selected><?php echo $row['Looking']; ?></option>
											<?php } else { ?>
											   <!--<option value="" selected>Select Looking</option>-->
											<?php } ?>
											
											<option value="Unmarried">Unmarried</option>
											<option value="Widowed">Widowed</option>
											<option value="Widower">Widower</option>
											<option value="Divorced">Divorced</option>
											<!--<option value="Seperated">Separated</option>
											<option value="Awaiting Divorce">Awaiting Divorce</option>-->
                                            </select>
                                        </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Complexion</label><br>
                                            <select  name="txtPComplexion[]" id="complexion1"  multiple="multiple">
											<?php  if($row['PE_Complexion']=="") { ?>
										   <!--<option value="Any" selected>Select Complexion</option>-->
										  <?php  } else {?>
										 <!-- <option value="Any">Any</option>-->
											  <option value="<?php  echo $row['PE_Complexion'];?>"selected><?php  echo $row['PE_Complexion']; ?></option>
											  <?php  }?>
											   <option value="Any">Any</option>
											   <?php  
												$complexion=$con->query("select * from complexion where complexion!='".$row['PE_Complexion']."'");
												while($edurow=$complexion->fetch_array())
												{?>
											<option value="<?php  echo $edurow['complexion'] ?>"><?php  echo $edurow['complexion'] ?></option>
											<?php  } ?>
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">From Age</label><br>
                                            <select class="custom-select-box form-control"  name="fromage" >
											 <?php  if($row['PE_FromAge']==""){ ?>
											<option value="22"  selected>22</option>
											<?php  } else  {?>
											<option value="<?php  echo $row['PE_FromAge']; ?>" selected><?php  echo $row['PE_FromAge']; ?></option>
											<?php  } ?>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
											<option value="32">32</option>
											<option value="33">33</option>
											<option value="34">34</option>
											<option value="35">35</option>
											<option value="36">36</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="39">39</option>
											<option value="40">40</option>
											<option value="41">41</option>
											<option value="42">42</option>
											<option value="43">43</option>
											<option value="44">44</option>
											<option value="45">45</option>
											<option value="46">46</option>
											<option value="47">47</option>
											<option value="48">48</option>
											<option value="49">49</option>
											<option value="50">50</option>
											<option value="51">51</option>
											<option value="52">52</option>
											<option value="53">53</option>
											<option value="54">54</option>
											<option value="55">55</option>
											<option value="56">56</option>
											<option value="57">57</option>
											<option value="58">58</option>
											<option value="59">59</option>
											<option value="60">60</option>
											<option value="61">61</option>
											<option value="62">62</option>
											<option value="63">63</option>
											<option value="64">64</option>
											<option value="65">65</option>
                                            </select>
                                        </div>
                                    </div>
                                 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">To Age</label><br>
                                            <select class="custom-select-box form-control"  name="toage" >
											 <?php  if($row['PE_ToAge']==""){ ?>
											<option value="22"  selected>22</option>
											<?php  } else  {?>
											<option value="<?php  echo $row['PE_ToAge']; ?>" selected><?php  echo $row['PE_ToAge']; ?></option>
											<?php  } ?>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
											<option value="32">32</option>
											<option value="33">33</option>
											<option value="34">34</option>
											<option value="35">35</option>
											<option value="36">36</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="39">39</option>
											<option value="40">40</option>
											<option value="41">41</option>
											<option value="42">42</option>
											<option value="43">43</option>
											<option value="44">44</option>
											<option value="45">45</option>
											<option value="46">46</option>
											<option value="47">47</option>
											<option value="48">48</option>
											<option value="49">49</option>
											<option value="50">50</option>
											<option value="51">51</option>
											<option value="52">52</option>
											<option value="53">53</option>
											<option value="54">54</option>
											<option value="55">55</option>
											<option value="56">56</option>
											<option value="57">57</option>
											<option value="58">58</option>
											<option value="59">59</option>
											<option value="60">60</option>
											<option value="61">61</option>
											<option value="62">62</option>
											<option value="63">63</option>
											<option value="64">64</option>
											<option value="65">65</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">From Height</label><br>
								          <select class="custom-select-box form-control"  name="txtfHeight" >
										  <?php if($row['PE_from_Height']!='') { ?>
										 <option value="<?php  echo $row['PE_from_Height']; ?>" selected="selected"><?php  get_height($row['PE_from_Height']); ?></option>
										  <?php }else { ?>
										   <option value="" selected>Select Height</option>
										  <?php } ?>
                                            
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
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">To Height</label><br>
										 <select class="custom-select-box form-control"  name="txttHeight" >
                                     <?php if($row['PE_to_Height']!='') { ?>
										 <option value="<?php  echo $row['PE_to_Height']; ?>" selected="selected"><?php  get_height($row['PE_to_Height']); ?></option>
										<?php }else { ?>
										   <option value="" selected>Select Height</option>
										<?php } ?>
                                           
									  </option>
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
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Education</label><br>
                                            <select class="form-control"  name="txtPEdu[]" id="edu1" multiple>
											<?php  if($row['PE_Education']=="") { ?>
											  <!--<option value="Any" selected>Select Education</option>-->
											  <?php  } else {?>
											 
											  <option value="<?php  echo $row['PE_Education']; ?>"selected><?php  echo $row['PE_Education']; ?></option>
											  <?php  }?>
											   <option value="Any">Any</option>
											  <?php  
											 
												$edusql=$con->query("select * from education where status='enable'");
												while($edurow=mysqli_fetch_array($edusql))
												{
												if($edurow['edu']==$row['Education'] && $edurow['edu']!="")
												{
												 ?>
												<option value="<?php  echo $edurow['edu']; ?>"><?php  echo $edurow['edu']; ?></option>
												<?php  
												}else
												{
													$str="";
													if($edurow['status']=='disabled')
													{
														$str="disabled";	
													}
												?>
												<option value="<?php  echo $edurow['edu']; ?>" <?php  echo $str; ?>><?php  echo $edurow['edu']; ?></option>
												<?php  
												}
											}
											?>
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Occupation</label><br>
                                            <select class="form-control"  name="pe_occu[]" id="ocu1" multiple>
											<?php  if($row['PE_Occupation']=="") { ?>
												<!--<option value="Any" selected> Select Occupation</option>-->
												<?php  } else {?>
												
												<!--<option value="Any">Any</option>-->
												<option value="<?php  echo $row['PE_Occupation']; ?>" selected><?php  echo $row['PE_Occupation']; ?></option>
												<?php  }?>
												<option value="Any">Any</option>
												<?php  
												$edusql2=$con->query("select * from occupation where status='enable'");
												while($edurow1=mysqli_fetch_array($edusql2))
												{?>
												<option value="<?php  echo $edurow1['occu']; ?>" <?php  echo $str; ?>><?php  echo $edurow1['occu']; ?></option>
												<?php  
												}
												?>
												<option value="<?php  echo $edurow1['edu']; ?>" <?php  echo $str; ?>><?php  echo $edurow1['edu']; ?></option>
												
                                            </select>
                                        </div>
                                    </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Religion</label><br>
                                            <select class="form-control"  id="religion1" name="religion[]" multiple >
											  <?php  if($row['PE_Religion']=="") { ?>
												<!--<option value="" selected>Select Religion</option>-->
												<?php  } else { ?>
												<!--<option value="Any">Any</option>-->
												<option value="<?php  echo $row['PE_Religion']; ?>" selected><?php  echo $row['PE_Religion']; ?></option>
												<?php  }?>
												<?php  
												$rrs=$con->query("select * from religion where status='enable'");
												while($rrow=mysqli_fetch_assoc($rrs))
												{
												?>
												<option value="<?php  echo $rrow['Religion'];?>"><?php  echo $rrow['Religion'];?></option>
												<?php  
												}
												?>
                                            </select>
                                        </div>
                                  </div>
									 <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Caste</label><br>
                                            <select class="form-control"  id="caste1" name="caste[]" multiple>
											 <?php  if($row['PE_Caste']=="") { ?>
											<!--<option value="Any" selected>Select Caste</option>-->
											<?php  } else {?>
											
											<option value="<?php  echo $row['PE_Caste'];?>" selected><?php  echo $row['PE_Caste'];?></option>
											<?php  }?>
											
                                            </select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Country Living in</label><br>
											 <select class="form-control"  name="txtPcountry[]" id="country1" multiple>
											<!--<option value="Any">Any</option>-->
											<!--<option value="India" selected>India</option>
											<option value="OutOfIndia">Out Of India</option>-->
											<?php 
											$edusql=$con->query("select * from e_country where status='enable'");
											if($row['PE_Countrylivingin']=="") { ?>
										
											<?php } else  {
												echo '<option value="'.$row['PE_Countrylivingin'].'" selected>'.$row['PE_Countrylivingin'].'</option>';
											}  
											while($rowc1 = mysqli_fetch_assoc($edusql)) {
															echo '<option value="'.$rowc1['country'].'">'.$rowc1['country'].'</option>';
												} ?>
											
										</select>
                                        </div>
                                    </div>
									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">State</label><br>
                                            <select class="form-control"  name="cbostate123[]" id="state1" multiple > 
											 <?php if($row['PE_State']=="") { ?>
												<!--<option value="Any" selected>Select State</option>-->
												<?php }else{?>
												 <!--<option value="Any">Any</option>-->
												<option value="<?php echo $row['PE_State']; ?>" selected><?php echo $row['PE_State']; ?></option>
												<?php }?>
											
                                            </select>
                                        </div>
                                    </div>
										
									<div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Resident Status</label><br>
                                            <select class="form-control"  name="txtPReS[]" multiple id="cbocity123"  > 
											                                        
										 <?php  if($row['PE_Residentstatus']=="") { ?>
                                       <!--<option value="Any" selected>Any</option>-->
									  <?php  } else {?>
									   
										  <option value="<?php  echo $row['PE_Residentstatus']; ?>" selected><?php  echo $row['PE_Residentstatus']; ?></option>
										  <?php  }?>
										  <option value="Any">Any</option>
										  <?php  
									$edusql=$con->query("select * from  residency_status where residency_status!='".$row['residency_status']."' and status='enable'");
									while($edurow=$edusql->fetch_array())
									{?>
										<option value="<?php  echo $edurow['residency_status'] ?>"><?php  echo $edurow['residency_status'] ?></option>
									
									<?php   } ?>
																		
										 </select>
                                        </div>
                                    </div> 
									<div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Partner Expectations<span class="text-danger">*</span></label>											
											<textarea  name="txtPartnerExpectations" type="text" class="form-control" id="txtPartnerExpectations" value="<?php  echo $row['PartnerExpectations']; ?>" size="40" maxlength="450" onKeyPress="return ValidateAlpha(event); return blockSpecialChar(event);"placeholder="Enter Partner Expectations"><?php  echo $row['PartnerExpectations']; ?></textarea>
                                          
                                        </div>
                                    </div>
                                </div>

<script>
$(document).ready(function(){

 $('#looking').multiselect({
  nonSelectedText:'Select Looking',
  buttonWidth:'332px',
  
 });
});
$(document).ready(function(){

 $('#complexion1').multiselect({
  nonSelectedText:'Select Complexion',
  buttonWidth:'332px',
  
 });
});
$(document).ready(function(){

 $('#edu1').multiselect({
  nonSelectedText:'Select Education',
  buttonWidth:'332px',
  
 });
});
$(document).ready(function(){

 $('#ocu1').multiselect({
  nonSelectedText:'Select Occupation',
  buttonWidth:'332px',
  
 });
});
$(document).ready(function(){
 $('#cbocity123').multiselect({
  nonSelectedText:'Select Residencial Status',
  buttonWidth:'682px',
  
 });
});
</script>
<script>
$(document).ready(function(){

 $('#religion1').multiselect({
  nonSelectedText:'Select Religion',
  buttonWidth:'332px',
  
  onChange:function(option, checked){
	 
   $('#caste1').html('');
   $('#caste1').multiselect('rebuild');
   $('#caste1').html('');
   $('#caste1').multiselect('rebuild');
   var selected = this.$select.val();
   if(selected.length > 0)
   {
    $.ajax({
     url:"../castonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#caste1').html(data);
      $('#caste1').multiselect('rebuild');
     }
    })
   }
  }
 });
 $('#caste1').multiselect({
  nonSelectedText: 'Select Caste',
  buttonWidth:'332px',
 });
});
$(document).ready(function(){

 $('#country1').multiselect({
  nonSelectedText:'Select Country',
  buttonWidth:'332px',
  
  onChange:function(option, checked){
	 
   $('#state1').html('');
   $('#state1').multiselect('rebuild');
   $('#state1').html('');
   $('#state1').multiselect('rebuild');
   var selected = this.$select.val();
   if(selected.length > 0)
   {
    $.ajax({
     url:"../stateonchange.php",
     method:"POST",
     data:{selected:selected},
     success:function(data)
     {
      $('#state1').html(data);
      $('#state1').multiselect('rebuild');
     }
    })
   }
  }
 });
 $('#state1').multiselect({
  nonSelectedText: 'Select State',
  buttonWidth:'332px',
 });
});
</script>
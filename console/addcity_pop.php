<?php  require_once('../sys_dbconnection.php');
//include'../dbconnectadmin.php';
$id = $_POST['rowid'];
?>
<script language="javascript">
function fillstate(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("popupstate").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("popupstate").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_state?q="+str,true);
xmlhttp.send();

}




function filldist(str)
{
var xmlhttp;
if (str=="")
  {
  document.getElementById("popdist").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("popdist").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","fill_dist?q="+str,true);
xmlhttp.send();
}

function filltaluka(str)
{
var taluka=document.getElementById("poptaluka");
taluka.innerHTML='<option value="">Select Taluka</option>';
if(str=="") return;
var xmlhttp=window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    taluka.innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fill_taluka?q="+encodeURIComponent(str),true);
xmlhttp.send();
}

</script>	

 <div class="modal-header">
                <h5 class="modal-title">Add City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_city?ID=<?php echo $id?>&msg=success" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
							<select class="mb-3 form-control" name="country" onChange="fillstate(this.value);">
						<?php  $q2="select * from e_country";
						     $rs=mysqli_query($con,$q2); ?>
                              
									  <?php  while($data=mysqli_fetch_array($rs)){ ?>
									  <option value="<?php echo $data['country'];?>" required> <?php echo $data['country']; ?> </option>
										<?php }  ?>
                                  </select>
								  <select class="mb-3 form-control" name="state" id="popupstate" onChange="filldist(this.value);">
								
								  <?php  $q1="select * from e_state ";
								 $rs1=mysqli_query($con,$q1); ?>
								<option value="" selected>Select State</option>
									  <?php  while($data1=mysqli_fetch_array($rs1)){ ?>
									  <option value="<?php echo $data1['state'];?>" required> <?php echo $data1['state']; ?> </option>
										<?php }  ?>
                                  </select>
								  
								  <select class="mb-3 form-control" name="dist" id="popdist" onChange="filltaluka(this.value);">
								
						      <?php  $q3="select * from e_dist ";
						     $rs3=mysqli_query($con,$q3); ?>
								<option value="" selected>Select District</option>
									  <?php  while($data3=mysqli_fetch_array($rs3)){ ?>
									  <option value="<?php echo $data3['dist'];?>" required> <?php echo $data3['dist']; ?> </option>
										<?php }  ?>
                                  </select>
								  <select class="mb-3 form-control" name="taluka" id="poptaluka" required>
									<option value="">Select Taluka</option>
								  </select>
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter City" required>
								
                            </div>
					   </div>
                       
                        <div class="col-sm-12">
                            <center><button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
			
	
	
	

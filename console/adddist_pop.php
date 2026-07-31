<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');

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
  //alert('hello '+str);
xmlhttp.open("GET","fill_state?q="+str,true);
xmlhttp.send();
// alert('hello '+str);

}
</script>	
  
	
 <div class="modal-header">
                <h5 class="modal-title">Add District</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_dist?ID=<?php echo $id ?>&msg=success" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
							
							<select class="mb-3 form-control" name="country" id="country"  required onChange="fillstate(this.value);">
						           <option value=""> Select  Country</option>
								  <?php  $q2="select * from e_country";							
						           $rs=mysqli_query($con,$q2); ?>
                              
									  <?php  while($data=mysqli_fetch_array($rs)){ ?>
									  <option value="<?php echo $data['country'];?>"><?php echo $data['country'];?></option>
									  
										<?php }  ?>
                                  </select>								
								  <select class="mb-3 form-control" name="state" id="popupstate">								
						          <option value=""> Select  State</option>
                                  </select>
								  
                                <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter District" required>
				
                            </div>
					   </div>
                       
                        <div class="col-sm-12">
                            <center><button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
			
	
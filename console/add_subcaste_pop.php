<?php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');
/*include'../dbconnectadmin.php';*/
$id = $_POST['rowid'];
?>
<script language="javascript">
function fillcaste(str1)
{
	
var xmlhttp;
if (str1=="")
  {
  document.getElementById("popupcaste").innerHTML="";
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
    document.getElementById("popupcaste").innerHTML=xmlhttp.responseText;
    }
  }
  
  
xmlhttp.open("GET","fill_caste?q="+str1,true);
xmlhttp.send();

}



</script>

 <div class="modal-header">
                <h5 class="modal-title">Add Subcaste</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="add_subcaste?ID=<?php echo $id?>&msg=success" method="post" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
							<?php  $q2="select * from religion order by religion ASC";
                 $rs=mysqli_query($con,$q2); ?>
                              
              <select class="mb-3 form-control" name="religion" id="religion" onChange="fillcaste(this.value);">
            
                    <?php  while($data=mysqli_fetch_array($rs)){ ?>
                    <option value="<?php echo $data['Religion'];?>" required> <?php echo $data['Religion']; ?> </option>
                    <?php }  ?>
                                  </select>
                  <select class="mb-3 form-control" name="caste" id="popupcaste">
						<?php  $q1="select * from caste ORDER BY Caste ASC ";
						$rs1=mysqli_query($con,$q1); ?>
						<option value="" selected>Select Caste</option>
						<?php  while($data1=mysqli_fetch_array($rs1)){ ?>
						<option value="<?php echo $data1['Caste'];?>" required> <?php echo $data1['Caste']; ?> </option>
						<?php }  ?>
                    </select>
                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Caste" required>
                
                            </div>
                         </div>
                       
                        <div class="col-sm-12">
                            <center><button class="btn btn-primary btcs" type="submit" name="submit">Add</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
      
  
  
  
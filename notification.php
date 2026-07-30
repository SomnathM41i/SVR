<?php $notification=mysqli_query($con,"select * from expressinterest where eisender='$search_id' and eireceiver='$login' and status='Pending'");
      $notification_fetch=mysqli_fetch_array($notification);
      $notification_num_rows=mysqli_num_rows($notification);
      if($notification_num_rows>0)
            {?>
            <div class="alert alert-info mr-3" align="center" role="alert">
         Interest Received From <?php  echo $notification_fetch['eisender'];
       ?>

   
             <span id="accept">
            
			<a href="accept_interest?id=<?php  echo $notification_fetch['eisender'];?>">
             <button type="button"  class="btn btn-success waves-effect" role="button"> Accept </button></a>
                                       
             <a href="decline_interest?id=<?php  echo $notification_fetch['eisender'];?>">
             <button type="button"  class="btn btn-danger waves-effect" role="button"> Decline </button></a>
                                          
              </span> 
            </div>
                                        
                                <?php  }else{}?>
								
								
	<?php  	
       $request=mysqli_query($con,"SELECT * from viewcontact_details where whom='$login' and who='$search_id' and status='Pending'");
      $request_fetch=mysqli_fetch_array($request);
      $request_num_rows=mysqli_num_rows($request);
    if($request_num_rows>0)
            {?>
              <div class="alert alert-info" align="center" role="alert">
          Contact Request From <?php  echo $request_fetch['who'];
       ?>
            
          
             <a href="accept_contact.php?id=<?php  echo $request_fetch['who'];?>">
             <button type="button"  class="btn btn-success waves-effect" role="button"> Accept </button></a>
                                       
             <a href="decline_contact.php?id=<?php  echo $request_fetch['who'];?>">
             <button type="button"  class="btn btn-danger waves-effect" role="button"> Decline </button></a>
                      
            </div>
			
			
			
                                        
                                <?php  }else{}?>
								
	
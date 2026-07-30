<?php require_once('../sys_dbconnection.php');
	/*include ('../dbconnectadmin.php');*/
	
	//FOR PROFILE PHOTO APPROVAL COUNT
	$query = "SELECT COUNT(Name) FROM register where Photo1Approve='No' AND Photo1!='nophoto.jpg' "; 
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_array($result);
	$cnt = $row['COUNT(Name)'];
	
	//FOR GALLARY PHOTO APPROVAL COUNT
	$query1 = "SELECT COUNT(*)  as totalCount FROM register a,gallary b where a.matriid=b.matri_id and a.Photo1<>b.photo_name  and b.photo_approve='Pending'"; 
	$result1 = mysqli_query($con,$query1);
	$row1 = mysqli_fetch_array($result1);
	$cnt1 = $row1['totalCount'];

	//FOR DOCUMENT APPROVAL COUNT
	$query2 = "SELECT Count(Name) FROM document where docapprove='No' and  Name!=''"; 
	$result2 = mysqli_query($con,$query2);
	$row2 = mysqli_fetch_array($result2);
	$cnt2 = $row2['Count(Name)'];
	
	//FOR PROFILE DESCRIPTION APPROVAL COUNT
	$query3 = "SELECT COUNT(Name) FROM register where profile_approve='No' and aboutus!='' "; 
	$result3 = mysqli_query($con,$query3);
	$row3 = mysqli_fetch_array($result3);
	$cnt3 = $row3['COUNT(Name)'];
	
	//FOR PROFILE DESCRIPTION APPROVAL COUNT
	$query4 = "SELECT COUNT(Name) FROM register where FamilyDetails_approve='No' and FamilyDetails!='' "; 
	$result4 = mysqli_query($con,$query4);
	$row4 = mysqli_fetch_array($result4);
	$cnt4 = $row4['COUNT(Name)'];
	
	//FOR PARTNER EXPECTATIONS APPROVAL COUNT
	$query5 = "SELECT COUNT(Name) FROM register where PartnerExpectations_approve='No'  and  PartnerExpectations!=''  "; 
	$result5 = mysqli_query($con,$query5);
	$row5 = mysqli_fetch_array($result5);
	$cnt5 = $row5['COUNT(Name)'];
	
	//FOR ID PROOF APPROVAL COUNT
	$query6 = "SELECT COUNT(Name) FROM register where idproof_approve='No' and  adhar!=''order by id desc"; 
	$result6 = mysqli_query($con,$query6);
	$row6 = mysqli_fetch_array($result6);
	$cnt6 = $row6['COUNT(Name)'];

	//FOR HOROSCOPE APPROVAL COUNT
	$query7 = "SELECT COUNT(Name) FROM register where HorosApprove='No' and  horoscope!='' order by id desc"; 
	$result7 = mysqli_query($con,$query7);
	$row7 = mysqli_fetch_array($result7);
	$cnt7 = $row7['COUNT(Name)'];


	//echo $_SERVER['REMOTE_ADDR']; 
	

?>

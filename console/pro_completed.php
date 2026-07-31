<?php require_once('../includes/bootstrap.php');
require_once(dirname(__FILE__).'/protect.php');
/*include '../dbconnectadmin.php';*/
        $strid="ND101";

		    $cmp=mysqli_query($con,"SELECT COUNT(*) AS Columns FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'onlinerishte.com' AND table_name = 'register'");
         $cmp1=mysqli_query($con,"SELECT Name,DOB,ConfirmEmail,ConfirmPassword,Gender,Profilecreatedby,Maritalstatus,PE_HaveChildren,childrenlivingstatus,Religion,Caste,Subcaste,countrycode,Mobile,aboutus,Gothram,Star,Moonsign,charan,Gan,nadi,Horosmatch,shani,Manglik,POB,TOB,POC,horoscope,Address,Country,dist,State,City,Phone,Residencystatus,Mobile2,calling_time,Pincode,Mobile,Education,EducationDetails,Annualincome,income_in,Occupation,occu_details,Employedin,working_hours,workinglocation,Height,Weight,BloodGroup,Complexion,Bodytype,spe_cases,Diet,Smoke,Drink,OtherHobbies,Spectacles,Familyvalues,FamilyType,FamilyStatus,noofbrothers,noofsisters,nbm,nsm,Fathername,Fathersoccupation,Mothersname,Mothersoccupation,mother_tounge,relatives,parents_stay,FamilyDetails,family_wealth,Looking,PE_FromAge,PE_ToAge,PartnerExpectations,PE_Countrylivingin,PE_from_Height,PE_to_Height,PE_Complexion,PE_Education,PE_Religion,PE_Caste,PE_Residentstatus,PE_State,PE_income_from,PE_income_to,PE_Occupation FROM `register` where MatriID='$strid'");
		 
		  $ecmp=mysqli_fetch_assoc($cmp1);
		  
		  $tot=mysqli_num_fields($cmp1);
		 // $tot=mysqli_num_fields($cmp);		  
		  
			$COUNT=0;
           $sql="SHOW COLUMNS FROM register where Field IN ('Name','DOB','ConfirmEmail','ConfirmPassword','Gender','Profilecreatedby','Maritalstatus','PE_HaveChildren','childrenlivingstatus','Religion','Caste','Subcaste','countrycode','Mobile','aboutus','Gothrm','Star','Moonsign','charan','Gan','nadi','Horosmatch','shani','Manglik','POB','TOB','POC','horoscope','Address','Country','dist','State','City','Phone','Residencystatus','Mobile2','calling_time','Pincode','Mobile','Education','EducationDetails','Annualincome','income_in','Occupation','occu_details','Employedin','working_hours','workinglocation','Height','Weight','BloodGroup','Complexion','Bodytype','spe_cases','Diet','Smoke','Drink','OtherHobbies','Spectacles','Familyvalues','FamilyType','FamilyStatus','noofbrothers','noofsisters','nbm','nsm','Fathername','Fathersoccupation','Mothersname','Mothersoccupation','mother_tounge','relatives','parents_stay','FamilyDetails','family_wealth','Looking','PE_FromAge','PE_ToAge','PartnerExpectations','PE_Countrylivingin','PE_from_Height','PE_to_Height','PE_Complexion','PE_Education','PE_Religion','PE_Caste','PE_Residentstatus','PE_State','PE_income_from','PE_income_to','PE_Occupation')";

			
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result))
			{
				//echo "hello";
			$row1=$row['Field'];
			//echo $row1;
			$sql= " SELECT  COUNT(Name) from register WHERE $row1!='' AND MatriID='$strid' ";
			echo  "SELECT  COUNT(Name) from register WHERE $row1 !='' AND MatriID='$strid'";?>
			<pre>
			<?php $res = mysqli_query($con,$sql);
			$cnt= mysqli_fetch_array($res); 			
			$val = $cnt['COUNT(Name)']."<br>";
			$COUNT=$COUNT+$cnt['COUNT(Name)'];

			}
			$total=$tot-$COUNT;
			echo $COUNT;
			echo "----";
			echo $tot;
			echo "----";
			
			$cmpfield=number_format((($tot-$total)/$tot)*100);
			echo $cmpfield;
			$_SESSION['profile_complite']=$cmpfield;
		  ?>

















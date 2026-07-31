<?php require_once('../sys_dbconnection.php');  
require_once(dirname(__FILE__).'/protect.php');
/*include('../dbconnectadmin.php');*/
$matriid=$_POST['matid'];


                                                                  
if(isset($_POST['submit']))
{
    //echo "1 ";
    for($i=0;$i<count($_FILES["uploaded_file1"]["name"]);$i++)
    {
        //echo "2 ";
    
        if (isset($_FILES['uploaded_file1']['name']) && !empty($_FILES['uploaded_file1']['name'][$i]))
        {
           //echo "3 ";
            $target_dir = "../document/";
            $target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
            $sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
            //$target_file = $target_dir.time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"];
            $UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"][$i];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image

            if(isset($_POST["submit"]))
           {
                //echo "4 ";
                $check = getimagesize($_FILES["uploaded_file1"]["tmp_name"][$i]);
                if($check !== false) 
                {
                    //echo "5 ";
                    //print_r($_FILES["uploaded_file1"]);   
                    define("success8","File is an image - " . $check["mime"] . ".");
                    header('location:profile_view?msg1=suc1&ID='. $matriid );
                    $flag=1;
                    $uploadOk = 1;
                } 
                else 
                {
                    //echo "6 ";
                    define("success8","File is not an image.");
                    header('location:profile_view?msg1=suc2&ID='. $matriid );
                    $flag=2;
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) 
            {
                //echo "7 ";
                define("success8","Sorry, file already exists.");
                header('location:profile_view?msg1=suc3&ID='. $matriid );
                $flag=3;
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["uploaded_file1"]["size"] > 8097152) 
            {
                //echo "8 ";
                define("success8","Sorry, your file is too large.");
                header('location:profile_view?msg1=suc7&ID='. $matriid );
                $flag=4;
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "doc") 
            {
                //echo "9 ";
                define("success8","Sorry, only JPG, JPEG   files are allowed.");
                $flag=5;
                header('location:profile_view?msg1=suc4&ID='. $matriid );
                $uploadOk = 0;
            }
            else 
            {
                //echo "10 ";

                if (move_uploaded_file($_FILES["uploaded_file1"]["tmp_name"][$i], $target_file)) 
                {
                    //echo "11 ";
                    $date=date('Y-m-d');

                    mysqli_query($con,"insert into document(Name,MatriID,Date,type,docapprove) values('$sav','$matriid','$date','$i','Yes')");
                    //echo "insert into document(Name,MatriID,Date,type) values('$sav','$matriid','$date','$i')";
                    $flag=6;
                    header('location:profile_view?msg1=suc5&ID='. $matriid );
                } 
                else 
                {
                    //echo "12 ";
                    $flag=7;
                    define("success8","Sorry, there was an error uploading your file.");
                    header('location:profile_view?msg1=suc6&ID='. $matriid );
                }
            }
        }
        else
        {
            //echo "13 ";
            switch($flag)
            {
                //echo "14";
                case 1:
                    header('location:profile_view?msg1=suc1&ID='. $matriid );
                    break;
                case 2:
                    header('location:profile_view?msg1=suc2&ID='. $matriid );
                    break;
                case 3:
                    header('location:profile_view?msg1=suc3&ID='. $matriid ); 
                    break;
                case 4:
                    header('location:profile_view?msg1=suc7&ID='. $matriid );
                    break;
                case 5:
                    header('location:profile_view?msg1=suc4&ID='. $matriid );
                    break;
                case 6:
                    header('location:profile_view?msg1=suc5&ID='. $matriid );
                    break;
                case 7:
                    header('location:profile_view?msg1=suc6&ID='. $matriid );
                    break;
                default:
                    header('location:profile_view?msg1=suc8&ID='. $matriid ); 
                    break; 
            }
        }

        //echo "15 ";
         
        
    }
    //echo "16 ";
}
?>
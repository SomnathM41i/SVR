<?php 
    require_once('sys_dbconnection.php');
	/*include('dbconnectadmin.php');*/
	//session_start();
$id=$_SESSION['matriid'];

$flag=0;
$cnt=0;
    if(isset($_POST['Continue']))
    {
    
        
        for($i=0;$i<count($_FILES["uploaded_file1"]["name"]);$i++)
        {
                /*"<br>";
		        echo $i;
                echo "<br>";*/
	            
                if (isset($_FILES['uploaded_file1']['name']) && !empty($_FILES['uploaded_file1']['name'][$i]))
                {
                    //echo "2";
                    $target_dir = "document/";
                    $target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
                    $sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
                    //$target_file = $target_dir.time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"];
                    $UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"][$i];
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image

                    if(isset($_POST["Continue"]))
                    {
		            //echo "3";
                    $check = getimagesize($_FILES["uploaded_file1"]["tmp_name"][$i]);
                    if($check !== false) 
                    {   
                        //echo "4";
                        print_r($_FILES["uploaded_file1"]);	
                        define("success8","File is an image - " . $check["mime"] . ".");
                        header('location:upload_document_proof?flag=1');
                        $uploadOk = 1;
                        $flag=1;
                        
                    } 
                    else 
                    {
                        //echo "5";
	                    define("success8","File is not an image.");
                        header('location:upload_document_proof?flag=2');
                        $uploadOk = 0;
                        $flag=2;
                        //exit;
                    }
                    //echo "6";
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                        //echo "8";
                        define("success8","Sorry, file already exists.");
                        header('location:upload_document_proof?flag=3');
                        $flag=3;

                        $uploadOk = 0;
                        //exit;
                    }
                    //echo "9";
                    // Check file size
                    if ($_FILES["uploaded_file1"]["size"] > 8097152) 
                    {
                        //echo "10";
                        define("success8","Sorry, your file is too large.");
                        header('location:upload_document_proof?flag=4');
                        $flag=4;
                        $uploadOk = 0;
                        
                    }
                    
            
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "doc") 
                    {
                        //echo "11";
                        define("success8","Sorry, only JPG, JPEG, PDF and DOC/DOCX files are allowed.");
                        header('location:upload_document_proof?flag=5');
                        $uploadOk = 0;
                        $flag=5;
                        //exit;
                    }
                    else 
                    {
                        //echo "12";
                        if (move_uploaded_file($_FILES["uploaded_file1"]["tmp_name"][$i], $target_file)) 
                        {
                            //echo "13";
                            $date=date('Y-m-d');
                            
                            mysqli_query($con,"UPDATE register set docapprove='' ");
                            mysqli_query($con,"insert into document(Name,MatriID,Date,type,docapprove) values('$sav','$id','$date','$i','No')");
                            mysqli_query($con,"UPDATE register SET docapprove='No' WHERE MatriID='$id' ");
                            define("success8","Success");
                            $cnt++;
                            //echo "insert into document(Name,MatriID,Date,type,docapprove) values('$sav','$id','$date','$i','No')";
                            header('location:upload_document_proof?flag=6');
                            $flag=6;
                            $cnt++;
                            //exit;
                        } 
                        else 
                        {
                            //echo "14";
                            define("success8","Sorry, there was an error uploading your file.");
                            //header('location:upload_document_proof.php');
                            header('location:upload_document_proof?flag=7');
                            $flag=7;
                            //exit;
                        }
                        
                        //echo "15";
                    }
                }
                else
                {
                    switch($flag)
                    {
                        case 1:
                                header('location:upload_document_proof?flag=1'); 
                                break;
                        case 2:
                                header('location:upload_document_proof?flag=2'); 
                                break;
                        case 3:
                                header('location:upload_document_proof?flag=3'); 
                                break;
                        case 4:
                                header('location:upload_document_proof?flag=4'); 
                                break;
                        case 5:
                                header('location:upload_document_proof?flag=5'); 
                                break;
                        case 6:
                                header('location:upload_document_proof?flag=6'); 
                                break;
                        case 7:
                                header('location:upload_document_proof?flag=7'); 
                                break;
                        default:
                               header('location:upload_document_proof?flag=8'); 
                                break; 
                    }
                            
                }
                
        }
        //header('location:upload_document_proof.php');
    
    }

?>
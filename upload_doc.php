<?php 
    require_once('includes/bootstrap.php');
	
	
$id=$_SESSION['matriid'];

$flag=0;
$cnt=0;
    if(isset($_POST['Continue']))
    {
    
        
        for($i=0;$i<count($_FILES["uploaded_file1"]["name"]);$i++)
        {
                
	            
                if (isset($_FILES['uploaded_file1']['name']) && !empty($_FILES['uploaded_file1']['name'][$i]))
                {
                    
                    $target_dir = "document/";
                    $target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
                    $sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"][$i]));
                    
                    $UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"][$i];
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image

                    if(isset($_POST["Continue"]))
                    {
		            
                    $check = getimagesize($_FILES["uploaded_file1"]["tmp_name"][$i]);
                    if($check !== false) 
                    {   
                        
                        print_r($_FILES["uploaded_file1"]);	
                        define("success8","File is an image - " . $check["mime"] . ".");
                        header('location:upload_document_proof?flag=1');
                        $uploadOk = 1;
                        $flag=1;
                        
                    } 
                    else 
                    {
                        
	                    define("success8","File is not an image.");
                        header('location:upload_document_proof?flag=2');
                        $uploadOk = 0;
                        $flag=2;
                        
                    }
                    
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                        
                        define("success8","Sorry, file already exists.");
                        header('location:upload_document_proof?flag=3');
                        $flag=3;

                        $uploadOk = 0;
                        
                    }
                    
                    // Check file size
                    if ($_FILES["uploaded_file1"]["size"] > 8097152) 
                    {
                        
                        define("success8","Sorry, your file is too large.");
                        header('location:upload_document_proof?flag=4');
                        $flag=4;
                        $uploadOk = 0;
                        
                    }
                    
            
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "doc") 
                    {
                        
                        define("success8","Sorry, only JPG, JPEG, PDF and DOC/DOCX files are allowed.");
                        header('location:upload_document_proof?flag=5');
                        $uploadOk = 0;
                        $flag=5;
                        
                    }
                    else 
                    {
                        
                        if (move_uploaded_file($_FILES["uploaded_file1"]["tmp_name"][$i], $target_file)) 
                        {
                            
                            $date=date('Y-m-d');
                            
                            mysqli_query($con,"UPDATE register set docapprove='' ");
                            mysqli_query($con,"insert into document(Name,MatriID,Date,type,docapprove) values('$sav','$id','$date','$i','No')");
                            mysqli_query($con,"UPDATE register SET docapprove='No' WHERE MatriID='$id' ");
                            define("success8","Success");
                            $cnt++;
                            
                            header('location:upload_document_proof?flag=6');
                            $flag=6;
                            $cnt++;
                            
                        } 
                        else 
                        {
                            
                            define("success8","Sorry, there was an error uploading your file.");
                            
                            header('location:upload_document_proof?flag=7');
                            $flag=7;
                            
                        }
                        
                        
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
        
    
    }

?>
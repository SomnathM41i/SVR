<?php  ob_start();
require_once('includes/bootstrap.php');

$matriid=$_POST['matid'];
$flag="";




//{                                                                  
    if(isset($_POST['Continue']))
    {
    
        if($matriid=='')
        {
        
        header('location:upload_document'); 
        }
        else
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

                    
                    //{
		            
                    $check = getimagesize($_FILES["uploaded_file1"]["tmp_name"][$i]);
                    if($check !== false) 
                    {   
                        
                        
                        define("success8","File is an image - " . $check["mime"] . ".");
                        header('location:upload_document?flag=1&id='. $matriid);
                        $flag=1;
                        $uploadOk = 1;
                    } 
                    else 
                    {
                       
	                    define("success8","File is not an image.");
                        header('location:upload_document?flag=2&id='. $matriid);
                        $uploadOk = 0;
                        $flag=2;
                    }
                    
                    //}
                    // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                        
                        define("success8","Sorry, file already exists.");
                       header('location:upload_document?flag=3&id='. $matriid);
                        $flag=3;
                        $uploadOk = 0;
                    }
                   
                    // Check file size
                    if ($_FILES["uploaded_file1"]["size"] > 8097152) 
                    {
                       
                        define("success8","Sorry, your file is too large.");
                        header('location:upload_document?flag=4&id='. $matriid);
                        $flag=4;
                        $uploadOk = 0;
                    }
            
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "doc") 
                    {
                       
                        define("success8","Sorry, only JPG, JPEG, PDF and DOC/DOCX files are allowed.");
                        header('location:upload_document?flag=5&id='. $matriid);
                        $flag=5;
                        $uploadOk = 0;
                    }
                    else 
                    {
                        
                        if (move_uploaded_file($_FILES["uploaded_file1"]["tmp_name"][$i], $target_file)) 
                        {
                           
                            $date=date('Y-m-d');
                            mysqli_query($con,"insert into document(Name,MatriID,Date,type,docapprove) values('$sav','$matriid','$date','$i','No')");
                          
                            $flag=6;
                           header('location:horoscope?id='. $matriid );
                        } 
                        else 
                        {
                           
                            define("success8","Sorry, there was an error uploading your file.");
                            $flag=7;
                            header('location:upload_document?flag=7&id='. $matriid);
                        }
                        
                    }
                }
                else
                {
                    switch($flag)
                    {
                        case 1:
                                header('location:upload_document?flag=1&id='. $matriid); 
                                break;
                        case 2:
                                header('location:upload_document?flag=2&id='. $matriid); 
                                break;
                        case 3:
                                header('location:upload_document?flag=3&id='. $matriid); 
                                break;
                        case 4:
                                header('location:upload_document?flag=4&id='. $matriid); 
                                break;
                        case 5:
                                header('location:upload_document?flag=5&id='. $matriid); 
                                break;
                        case 6:
                               header('location:horoscope?id='. $matriid ); 
                                break;
                        case 7:
                                header('location:upload_document?flag=7&id='. $matriid); 
                                break;
                        default:
                               header('location:upload_document?flag=8&id='. $matriid); 
                                break; 
                    }
                }
			}
        }
    
    }
//}

?>  
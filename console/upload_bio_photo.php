<?Php require_once('../sys_dbconnection.php');
require_once(dirname(__FILE__).'/protect.php');

/*echo $_POST['uploaded_file1'];
*/
$check_upload = 0;
$flag=0;
$cnt=0;
$Biodata = ' ';
$photo = ' ';
    if(isset($_POST['submit']))
    {


        $desc = addslashes($_POST['data']);
        $MatriID = $_POST['matid'];
        $date = date('Y-m-d'); 
        if( ( $desc == '' ) && ( $_FILES['uploaded_file1']['name'] == '' ) &&  ( $_FILES['uploaded_photo']['name'] == '' ) )
        {
            header("location:add_recommendation?flag=none&id=".$MatriID);
            exit;
        }
        //echo '<pre>';
        //print_r($_FILES);
        if( $_FILES['uploaded_file1']['name'] == '' && $_FILES['uploaded_photo']['name'] == '' )
        {

            $check_upload = 0;
        }
        elseif( $_FILES['uploaded_file1']['name'] == '' )
        {

            $check_upload = 1;
        }
        elseif( $_FILES['uploaded_photo']['name'] == '')  {

            $check_upload = 2;   
        }
        else{
            
            $check_upload = 3;   
        }
        
        echo $check_upload.'<br>'; 
        
        /*exit;*/
      /*  echo '<br>'.$date.'<br>';*/
        if( $check_upload != 0 )
        {
            echo "1".'<br>';
            if( $check_upload != 1 )
            {
                if (isset($_FILES['uploaded_file1']['name']) && !empty($_FILES['uploaded_file1']['name']))
                {
                    //$old='../'.$_POST['old'];
                    $filename =date('Y_m_d_h_i_s').basename($_FILES['uploaded_file1']['name']);
                    $ext= substr($filename, strrpos($filename, '.') + 1);
                    if (($ext == "jpg"||"jpeg") && ($_FILES["uploaded_file1"]["name"] == "image/jpeg") && ($_FILES["uploaded_file1"]["size"] <  450000)) 
                    {
                        //Determine the path to which we want to save this file
                        $targetPath = "../recommendation/".$filename3;
                        /*if(file_exists($targetPath))
                        {
                            unlink($targetPath);
                        }else if(file_exists($old))
                        {
                            unlink($old);
                        } */
                    }
                    $target_dir = "../recommendation/";
                    $watermarkImagePath = '../images/watermark.png';
                    $target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"]));
                    $sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_file1']["name"]));
                    $UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["uploaded_file1"]["name"];
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"]))
                    {
                        $check = getimagesize($_FILES["uploaded_file1"]["tmp_name"]);
                        if($check !== false) 
                        {
                            define("success3","Photo File is an image - " . $check["mime"] . ".");
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            define("success3","Your Photo is not an image.");
                            $uploadOk = 0;
                            header("location:add_recommendation?flag=1&id=".$MatriID);
                            exit;
                        }
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                        define("success3","Sorry, This Photo already exists.");
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["uploaded_file1"]["size"] > 8097152) 
                    {
                        define("success3","Sorry, Your photo size is too large.");
                        $uploadOk = 0;
                    }
                    else
                    {
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "jpeg" ) 
                        {
                            define("success3","Sorry, Photos  are  allow only JPG, JPEG Format.");
                            $uploadOk = 0;
                            header("location:add_recommendation?flag=2&id=".$MatriID);
                            exit;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) 
                        {
                            define("success3","Sorry, your photo was not uploaded.");
                            header("location:add_recommendation?flag=3&id=".$MatriID);
                            exit;
                            // if everything is ok, try to upload file
                        } 
                        else 
                        {
                            if (move_uploaded_file($_FILES["uploaded_file1"]["tmp_name"], $target_file)) 
                            {
                                $Biodata = $sav;
                                echo $Biodata.'<br>';
                                if( $check_upload == 2 )
                                {

                                    echo "insert into recommendation(MatriID,description,biodata1,date) values('$MatriID','$desc','$sav','$date')";
                                    mysqli_query($con,"insert into recommendation(MatriID,description,biodata1,date) values('$MatriID','$desc','$sav','$date')")or svr_db_fail($con);
                                     header("location: view_recommendation?id=".$MatriID);
                                    /*mysqli_query($con,"insert into recommendation(  MatriID,description,biodata1,date) values('$MatriID','$desc','$sav','$date')")or svr_db_fail($con);
                                    define("success3","Your Photo Uploaded Successfully.");
                                    header("location: view_recommendation?id=".$MatriID);*/
                                }
                                
                            } 
                            else 
                            {
                                define("success3","Sorry, there was an error uploading your photo.");
                                header("location:add_recommendation?flag=4&id=".$MatriID);
                                exit;
                            }
                        }
                    }
                }
                echo $check_upload.'<br>';
            }
            if( $check_upload != 2 )
            {
                echo "2".'<br>';
                if ( isset($_FILES['uploaded_photo']['name']) && !empty($_FILES['uploaded_photo']['name']) ) 
                {
                    //$old='../'.$_POST['old'];
                    $filename =date('Y_m_d_h_i_s').basename($_FILES['uploaded_photo']['name']);
                    $ext= substr($filename, strrpos($filename, '.') + 1);
                    if (($ext == "jpg"||"jpeg") && ($_FILES["uploaded_photo"]["name"] == "image/jpeg") && ($_FILES["uploaded_photo"]["size"] <  450000)) 
                    {
                        //Determine the path to which we want to save this file
                        $targetPath = "../recommendation/".$filename3;
                        /*if(file_exists($targetPath))
                        {
                            unlink($targetPath);
                        }else if(file_exists($old))
                        {
                            unlink($old);
                        } */
                    }
                    $target_dir = "../recommendation/";
                    $watermarkImagePath = '../images/watermark.png';
                    $target_file = $target_dir .date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_photo']["name"]));
                    $sav=date('Y_m_d_h_i_s'). preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($_FILES['uploaded_photo']["name"]));
                    $UploadedImageName = time()."-".rand(1000, 9999)."-".$_FILES["uploaded_photo"]["name"];
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["submit"]))
                    {
                        $check = getimagesize($_FILES["uploaded_photo"]["tmp_name"]);
                        if($check !== false) 
                        {
                            define("success3","Photo File is an image - " . $check["mime"] . ".");
                            $uploadOk = 1;
                        } 
                        else 
                        {
                            define("success3","Your Photo is not an image.");
                            $uploadOk = 0;
                            header("location:add_recommendation?flag=1&id=".$MatriID);
                            exit;
                        }
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) 
                    {
                        define("success3","Sorry, This Photo already exists.");
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["uploaded_photo"]["size"] > 8097152) 
                    {
                        define("success3","Sorry, Your photo size is too large.");
                        $uploadOk = 0;
                    }
                    else
                    {
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "jpeg" ) 
                        {
                            define("success3","Sorry, Photos  are  allow only JPG, JPEG Format.");
                            $uploadOk = 0;
                            header("location:add_recommendation?flag=2&id=".$MatriID);
                            exit;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) 
                        {
                            define("success3","Sorry, your photo was not uploaded.");
                            header("location:add_recommendation?flag=3&id=".$MatriID);
                            exit;
                            // if everything is ok, try to upload file
                        } 
                        else 
                        {
                            if (move_uploaded_file($_FILES["uploaded_photo"]["tmp_name"], $target_file)) 
                            {
                                $photo = $sav;
                                echo $photo.'<br>';
                                if( $check_upload == 1 )
                                {
                                    echo $photo.'<br>';
                                    echo "insert into recommendation(  MatriID,description,photo,date) values('$MatriID','$desc','$sav','$date')";
                                    mysqli_query($con,"insert into recommendation(MatriID,description,photo,date) values('$MatriID','$desc','$sav','$date')");
                                     header("location: view_recommendation?id=".$MatriID);
                                    /*mysqli_query($con,"insert into recommendation(  MatriID,description,biodata1,date) values('$MatriID','$desc','$sav','$date')")or svr_db_fail($con);
                                    define("success3","Your Photo Uploaded Successfully.");
                                    header("location: view_recommendation?id=".$MatriID);*/
                                }
                                
                            } 
                            else 
                            {
                                define("success3","Sorry, there was an error uploading your photo.");
                                header("location:add_recommendation?flag=4&id=".$MatriID);
                                exit;
                            }
                        }
                    }
                }
                
            }
            if( $check_upload == 3)
            {
                echo "insert into recommendation(MatriID,description,photo1,biodata1,date) values('$MatriID','$desc','$photo','$Biodata','$date')"; 
                mysqli_query($con,"insert into recommendation(MatriID,description,photo,biodata1,date) values('$MatriID','$desc','$photo','$Biodata','$date')");
                header("location: view_recommendation?id=".$MatriID);

            }
            
            
        }
        else
        {
            echo $desc.'<br>';
            mysqli_query($con,"insert into recommendation(MatriID,description,date) values('$MatriID','$desc','$date')");
            header("location: view_recommendation?id=".$MatriID); 
        }
        
    }
   
?>
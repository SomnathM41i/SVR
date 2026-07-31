<?php require_once('sys_dbconnection.php');


  $result=mysqli_query($con,"SELECT * FROM cms where cms_id='9'");
$rowdata=mysqli_fetch_array($result);?>

<div class="contact-column col-lg-3 col-md-12 col-sm-12 order-2 coninfo" >
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2>Contact Us</h2>
                        </div>
                        <ul class="contact-info">
                            <li>
                                <span class="icon fa fa-phone-volume"></span> 
                                <p><strong>Call Us</strong>
                                <?php $call=$rowdata['mobile'];
										  $call1=$rowdata['whatsapp'];
								             echo $call; ?><br> <?php echo $call1;?></p>
										
                            </li>

                            <li>
                                <span class="icon fa fa-envelope"></span> 
                                <p><strong>Mail Us</strong></p>
                                <p><?php $mail=$rowdata['email'];
								             echo $mail; ?></p>
                            </li>

                            <li>
                                <span class="icon fa fa-clock"></span> 
                                <p><strong>Office Time</strong></p>
                                <p>Time:<?php $open=$rowdata['officetime'];
								             echo $open; ?></p>
                            </li>
                        </ul>

                       <!-- <ul class="social-icon-two social-icon-colored">
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        </ul>-->
                    </div>
                </div>
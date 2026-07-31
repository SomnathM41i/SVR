<select class="selectpicker dropcss drop" multiple data-max-options="1" data-live-search="true" title="Select District" data-width="90%" name="dist"  tabindex="3" id="dist">
                      <!--<option value="">Select District</option>-->
                        <?php if($row['State']!=""){ ?>
						<?php 
						$rrs=mysqli_query($con,"select * from e_dist where sid2='".$row['State']."'");
						while($rrow=mysqli_fetch_array($rrs))
						{
							$_SESSION['dis']=$rrow['dist'];
							if($rrow['dist']==$row['dist'])
							{
								?>
							<option value="<?php echo $rrow['Dist'];?>" selected><?php echo $rrow['Dist'];?></option>
                    <?php }else{?>
							<option value="<?php echo $rrow['dist'];?>"><?php echo $rrow['dist'];?></option>
                    <?php	}   }}?>
					</select>
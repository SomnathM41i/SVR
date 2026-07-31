<?php 
	$data = mysqli_query($con,"SELECT * FROM register WHERE MatriID='$matriid'");
	$fetch_data = mysqli_fetch_array($data);
	$date = $fetch_data['Lastlogin'];
	$o_date = explode(" ",$date);
	$date_change = $o_date['0'];
	$newDate = date("d-m-Y", strtotime($date_change));
?>
<style>
	/*.change_size{
		font-size: 12px;

	}*/
</style>
<span class="change_size">
<?php echo $fetch_data['Name']; ?>
<a href="profile_view?ID=<?php echo $matriid; ?>">
<?php echo ' ('.$fetch_data['MatriID'].')'; ?></a>
<?php echo ' Last Login: '.$newDate; ?><br>
</span>
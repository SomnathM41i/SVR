<table id="report-table" class="table  table-striped mb-0" >
    <thead>
      
    </thead>
    <tbody>
        <tr>
            <td>
                Profile Created By <?php echo $fetch_data['Profilecreatedby']; ?>
            </td>
            <td>
                <sub><b><?php echo $new_reg_Date;?></b></sub>
            </td> 
        </tr>
        <?php 
            if($fetch_data['Status'] == 'Paid')
            {
        ?>
        <tr>
            <td>
                Membership Expiry Date
            </td>
            <td>
                <sub><b><?php echo $new_memdate ;?></b></sub>
            </td> 
        </tr>
        <?php
            }
        ?>
        <tr>
            <td>
                Last Log In
            </td>
            <td>
                <sub><b><?php echo $new_last_login; ;?></b></sub>
            </td> 
        </tr>
    </tbody>
</table>

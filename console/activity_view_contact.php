<?php require_once(dirname(__FILE__).'/protect.php'); ?>
<table id="report-table_view_contact" class="table  table-striped mb-0" >
    <thead>
        <tr>
            <th width="20%"></th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $contact_view  = mysqli_query($con,"SELECT * FROM notification where noti_sender='$id' AND notification_type='Viewed Contact' ORDER BY date_time desc");
            if(mysqli_num_rows($contact_view ) > 0 )    
            {
                while( $row = mysqli_fetch_assoc($contact_view) )
                {
        ?>
        <tr>
            <td>
                <b><?php echo $row['noti_sender']?></b> Viewed Contact of <b><?php echo $row['noti_receiver']; ?></b>
            </td>
            <?Php 
                $new_date = $row['date_time'];
                $date = date("d-m-Y", strtotime($new_date));
            ?>
            <td>
                <sub><b><?php echo $date;?></b></sub>
            </td> 
        </tr>
        <?php
                }
            }
            $contact_viewed  = mysqli_query($con,"SELECT * FROM notification where noti_receiver='$id' AND notification_type='Viewed Contact' ORDER BY date_time desc");
            if(mysqli_num_rows($contact_viewed ) > 0 )    
            {
        ?>
        <tr>
            <td style="text-align: center;" colspan="2"> <strong>Who Viewed Contact of <?php echo $id; ?></strong> </td>
            <td hidden></td>
            
        </tr>
        <?Php
                while( $row = mysqli_fetch_assoc($contact_viewed) )
                {
        ?>
        <tr>
            <td>
                <b><?php echo $row['noti_sender']?></b> Viewed Contact of <b><?php echo $row['noti_receiver']; ?></b>
            </td>
            <?Php 
                $new_date = $row['date_time'];
                $date = date("d-m-Y", strtotime($new_date));
            ?>
            <td>
                <sub><b><?php echo $date;?></b></sub>
            </td> 
        </tr>
            <?php
                }
            }
            ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
    $('#report-table_view_contact').DataTable({
     "order": [[ 1, "desc" ]],
     "columnDefs": [ { type: 'date', 'targets': [1] } ]
    });
    $('.dataTables_length').addClass('bs-select');
    });
</script>
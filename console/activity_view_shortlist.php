<table id="report-table_shortlist" class="table  table-striped mb-0" >
    <thead>
        <th>
        </th>
        <th>
        </th>
    </thead>
    <tbody>
        <?php 
            $profile_shortlist  = mysqli_query($con,"SELECT * FROM notification where noti_sender='$id' AND notification_type='Shortlisted' ORDER BY date_time desc");
            if(mysqli_num_rows($profile_shortlist ) > 0 )    
            {
                while( $row = mysqli_fetch_assoc( $profile_shortlist ) )
                {
        ?>
        <tr>
            <td>
                <b><?php echo $row['noti_sender']?></b> Shortlisted Profile of <b><?php echo $row['noti_receiver']; ?></b>
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
        $profile_shortlisted  = mysqli_query($con,"SELECT * FROM notification where noti_receiver='$id' AND notification_type='Shortlisted' ORDER BY date_time desc");
        if(mysqli_num_rows($profile_shortlisted ) > 0 )    
        {
        ?>
        <tr>
            <td style="text-align: center;" colspan="2"><strong>Who Shortlisted <?php echo $id; ?></strong></td>
            <td hidden></td>
        </tr>

        <?Php
            while( $row = mysqli_fetch_assoc( $profile_shortlisted ) )
            {
        ?>
        <tr>
            <td>
                <b><?php echo $row['noti_sender']?></b> Shortlisted Profile of <b><?php echo $row['noti_receiver']; ?></b>
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
    $('#report-table_shortlist').DataTable({
     "order": [[ 1, "desc" ]],
     "columnDefs": [ { type: 'date', 'targets': [1] } ]
    });
    $('.dataTables_length').addClass('bs-select');
    });
</script>
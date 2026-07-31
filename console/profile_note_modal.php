<?php require_once(dirname(__FILE__).'/protect.php'); ?>

<div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
           
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#modal-report').on('show.bs.modal', function (e) {
       $(e.target, '[autofocus]').focus();
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'note_pop', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.modal-content').html(data);//Show fetched data from database
            }
        });
     });
});
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/sample.js" type="text/javascript"></script>
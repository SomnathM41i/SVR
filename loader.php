
<button type="button" data-loading-text="Loading..." class="btn btn-primary">
  Loading state
</button>
<script>
$("button").click(function() {
    var $btn = $(this);
    $btn.button('loading');
    // Then whatever you actually want to do i.e. submit form
    // After that has finished, reset the button state using
    setTimeout(function () {
        $btn.button('reset');
    }, 1000);
});
</script>
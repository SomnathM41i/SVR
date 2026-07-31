

<!DOCTYPE html>
<html>
<head>
  <title></title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/stylenew.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
</head>
<style type="text/css">
  .loader_bg{
    position: fixed;
    z-index: 999999;
    background: #fff;
    width: 100%;
    height: 100;

  }
  .loader{
    
    border-radius: 50%;
    width: 150px;
    height: 150px;
    position: absolute;
    top: calc(50vh - 75px);
    left: calc(50vw - 75px);
    
  }
  .loader:before,.loader:after{
      content: '';
      border: 1em solid #6f42c1;
      border-radius: 50%;
      width: inherit;
      height: inherit;
      position: absolute;
      top: 0;
      left: 0;
      animation: loader 2s linear infinite;
      opacity: 0;


  }
  .loader:before{
    animation-delay: .5s;
  }

  @keyframes loader{
    0%{
        transform: scale(0);
        opacity: 0;
    }
    50%{
        opacity: 1;
    }
    100%{
        transform: scale(1);
        opacity: 0;
    }
  }

  .button:after{
   visibility: hidden;
  }


</style>
<body>
<?php
  if(isset($_POST['submit']))
  {
    ?>
  
 
  <div class="loader_bg">
    <div class="loader"></div>
    
  </div>
<?php 
   }


?>

  <form method="post" action="#" id="contact-form">
    <button class="button" type="submit" name="submit">SUBMIT</button>
  </form>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  setTimeout(function(){
    $('.loader_bg').fadeToggle();
  }, 5500);
</script>
</body>
</html>
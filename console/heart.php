<?php //pink:#ed07b1 ?>
<?php require_once(dirname(__FILE__).'/protect.php'); ?>
<!DOCTYPE html>

<html>
<head>
  <title></title>
  <style type="text/css">
    
    .heart
    {
      top: 140px;
      left: 300px;
      bottom: 0px;
      background: #f90202;
      position: relative;
      width: 50px;
      height: 50px;
      opacity: 0.1;
      transform: rotate(-45deg);
      animation: heart 0.7s linear infinite;
    }
    
    
    <?php /*@keyframes fade ?>
    {
      from{
        opacity: 0;
      }
      to{
        opacity: 1;
      }
    }<?php  */ ?>
    @keyframes heart
    {
      0% 
      {
        transform: rotate(-45deg) scale(1.07) ;  
      }
      80%
      {
        transform: rotate(-45deg) scale(1.0) ;  
      }
      100%
      {
        transform: rotate(-45deg) scale(1.0) ;  
      }
      
    }
    
    
    body
    { 
      
      display: flex;
      width: 100%;
      min-height: 100vh;
      justify-content: center;  
      
    }
    
    .heart::after
    {
      background: inherit;
      width: 50px;
      height: 50px;
      content:'';
      position: absolute;
      top: -50%;
      left: 0;
      border-radius: 50%;
      opacity: 1;
       

    }
    
    
    .heart::before
    {
      background: inherit;
      width: 50px;
      height: 50px;
      content:'';
      position: absolute;
      top: 0;
      right: -50%;
      border-radius: 50%;
      opacity: 1;
     

    }
    
   
    
  </style>
</head>
<body>
  
    <div class="heart">
      
    </div>
  
    
    
  
  
</body>
</html>
<?php //pink:#ed07b1 ?>
require_once(dirname(__FILE__).'/protect.php');
<!DOCTYPE html>

<html>
<head>
  <title></title>
  <style type="text/css">
    
    .heart
    {
      top: 46px;
      right:10px;
      background: #f90202;
      position: relative;
      width: 30px;
      height: 30px;
      transform: rotate(-45deg);
      animation: heart 0.7s linear infinite;
    }
    
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
    
 
    
    .heart::after
    {
      background: inherit;
      width: 30px;
      height: 30px;
      content:'';
      position: absolute;
      top: -50%;
      left: 0;
      border-radius: 50%;
    }
    
    .heart::before
    {
      background: inherit;
      width: 30px;
      height: 30px;
      content:'';
      position: absolute;
      top: 0;
      right: -50%;
      border-radius: 50%;
    }
  </style>
</head>
<body>
  <div class="heart"> 
  </div>
</body>
</html>
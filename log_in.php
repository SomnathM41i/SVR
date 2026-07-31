<?php
  //ACCESS TOKEN:-  EAAEE_REPLACE_WITH_YOUR_ACCESS_TOKEN
  //APP ID:- 974400316633433 2147483647 2896287927305673
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
</head>
<body>
<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      /*document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';*/
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2896287927305673',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v10.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });

  };
  
  function fblogin()
  {
    FB.login(function(response)
    {
      if(response.authResponse)
      {
        fbafterlogin();
      }
    });

  }
  function fbafterlogin()
  {
    FB.getLoginStatus(function(response) 
    {   // Called after the JS SDK has been initialized.
      if (response.status === 'connected') 
      {
        FB.api('/me','GET',{"fields":"id,name,email,birthday,first_name,last_name"}, function(response) 
        {
          console.log(response);
          jQuery.ajax
          ({
              url:'check_fb.php',
              type:'post',
              data:'id='+response.id+'&email='+response.email+'&name='+response.name,


          });
        
        });
        statusChangeCallback(response);        // Returns the login status.
      }
    });
    
  }
  

  function testAPI() {                   // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');

    FB.api('/me','GET',
  {"fields":"id,name,email,birthday,first_name,last_name"}, function(response) 
  {
      console.log(response);
      /*console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + response.email + response.first_name + response.last_name + response.id + '!';
      */
      jQuery.ajax
          ({
              url:'check_fb.php',
              type:'post',
              data:'id='+response.id+'&fname='+response.first_name+'&lname='+response.last_name+'&email='+response.email+'&name='+response.name,
              

          });

  });
    

  }
  
 
</script>


<!-- The JS SDK Login Button -->
<?PHP /*<a href="javascript:void(0)" onclick="fblogin()">Log in</a>*/ ?>
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>



<div id="status">
</div>

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>


<?php /* ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

</body>
</html>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : 'v6.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

    function fb_login()
    {
      FB.getLoginStatus(function(response) 
      {
        FB.api('/me', function(response) {
      console.log(response);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });      });
    }



</script>



<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '286894012977145',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v6.0'           // Use this Graph API version for this call.
    });

    function fb_login()
    {
      FB.getLoginStatus(function(response) 
      {   // Called after the JS SDK has been initialized.
        if (response.status === 'connected') 
        {
          FB.api('/me', function(response) 
          {
            console.log('response');
            
          });//statusChangeCallback(response);        // Returns the login status.
        }  
        
      });
  };
    }
    
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>
<button type="submit" onclick="fb_login();">LOG IN </button>
<?PHP /* 
<a href="javascript:void(0)" >Log In With Facebook</a>

<!-- The JS SDK Login Button -->

<fb:login-button scope="public_profile,email" onlogin="fb_login();">
</fb:login-button>

<div id="status">
</div>

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>
<?php */ ?>
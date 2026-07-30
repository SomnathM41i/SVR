<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" 
        content="text/html;charset=utf-8" />
    <meta name="viewport" content=
        "width=device-width, initial-scale=1.0">
    <title>
        How to add whatsapp share 
        button on website?
    </title>
    <style type="text/css">
  
        /* To show on small size screen only */
        /*@media screen and (min-width: 500px) {
            .mobileShow {
                display: none
            }
        }*/
    </style>
</head>
<body>
    <h3>Whatsapp sharing</h3>
    <input class="mobileShow" 
        type="text" name="message">
    <button onclick="share()" class="mobileShow">
        Share to whatsapp
    </button>
  
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js">
    </script>
      
    <script type="text/javascript">
          
        // Function to share on whatsapp
        function share() {
  
            // Getting user input
            var message = $("input[name=message]").val();
  
            // Opening URL
            window.open(
                "whatsapp://send?text=" + message,
  
                // This is what makes it 
                // open in a new window.
                '_blank' 
            );
        }
    </script>
</body>
</html>
<?php 
/*{
  "to": "8830340209",
  "type": "template",
  "template": {
    "namespace": "test",
    "language": {
      "policy": "deterministic",
      "code": "php"
    },
    "name": "test",
    "components": [
    {
      "type" : "header",
      "parameters": [
      # The following parameters code example includes several different possible header types, 
      # not all are required for a media message template API call.

      {
        "type": "text",
        "text": "replacement_text"
      }

      # OR

      {
        "type": "document",
        "document": {
          "id": "your-media-id",
          # filename is an optional parameter
          "filename": "your-document-filename"
        }
      }

      # OR

      {
        "type": "document",
        "document": {
          "link": "the-provider-name/protocol://the-url",
          # provider and filename are optional parameters
          "provider": {
            "name" : "provider-name"
          },
          "filename": "your-document-filename"
        }
      }

      # OR
  
      {
        "type": "video",
        "video": {
          "id": "your-media-id"
        }
      }

      # OR
  
      {
        "type": "video",
        "video": {
          "link": "the-provider-name/protocol://the-url"
          # provider is an optional parameter
          "provider": {
            "name" : "provider-name"
          }
        }
      }

      # OR

      {
        "type": "image",
        "image": {
          "link": "http(s)://the-url",
          # provider is an optional parameter
          "provider": {
            "name" : "provider-name"
          },
        }
      }
    ]
    # end header
    },
    {
      "type" : "body",
      "parameters": [
        {
          "type": "text",
          "text": "replacement_text"
        },
        {
          "type": "currency",
          "currency" : {
            "fallback_value": "$100.99",
            "code": "USD",
            "amount_1000": 100990
          }
        },
        {
          "type": "date_time",
          "date_time" : {
            "fallback_value": "February 25, 1977",
            "day_of_week": 5,
            "day_of_month": 25,
            "year": 1977,
            "month": 2,
            "hour": 15,
            "minute": 33, #OR
            "timestamp": 1485470276
          }
        },
        {
        ...
        # Any additional template parameters
        }
      ] 
      # end body
      },
    ]
  }
}*/
?>
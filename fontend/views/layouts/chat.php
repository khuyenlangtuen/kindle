<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<title>test2</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html2canvas.js?rev032"></script> 
<script type="text/javascript">

	function get_friend(accessToken)
	{
		 var url = '<?php echo CController::CreateUrl('site/getfriend')?>';
			$.ajax({ 
				type: "POST", 
				url: url,
				dataType: 'text',
				data: {
					fbid : $("#txt_id").val(),
					token:accessToken
				}
			}).done(function(data) {
				alert("Share success !!!:"+data);
			});
	}
     function screenshot()
    {
        FB.getLoginStatus(function(response) {
          if (response.status === 'connected') {
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
               get_friend(accessToken);
             
          } else if (response.status === 'not_authorized') {
            FB.login(function(response) {
                var accessToken = response.authResponse.accessToken;
               get_friend(accessToken);
               ///
             }, {scope: 'publish_actions,publish_stream,user_photos,read_stream'});
          } else {
            FB.login(function(response) {
               var accessToken = response.authResponse.accessToken;
					get_friend(accessToken);
             }, {scope: 'publish_actions,publish_stream,user_photos,read_stream'});
          }
         });
        
    }
         
</script>       

 </head>
 <body>  
 <input type="text" id="txt_id" />
 <a href="javascript:screenshot()">get</a>
<?php echo $content; ?> 
</body>
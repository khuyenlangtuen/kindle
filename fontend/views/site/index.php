<form action="<?php echo CController::createUrl('/site/uploadfb');?>" method="post" enctype="multipart/form-data" name="form" id="form">
<h1>Post Photos to User Profile</h1>
<p> The image will be posted on your profile wall! <a href="?reset=1">Reset User Session</a>.</p>
<label>Pages
<span class="small">Select a Page</span>
</label>
<input type="file" name="pictureFile" id="pictureFile">
<label>Message
<span class="small">Write something to post!</span>
</label>
<textarea name="message"></textarea>
<button type="submit" class="button" id="submit_button">Post Picture</button>
<div class="spacer"></div>
</form>

<a href="<?php echo CController::createUrl('/site/postfb');?>?code=">a</a>

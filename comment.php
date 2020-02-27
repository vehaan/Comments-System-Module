<?php
//index.php

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Comment System using PHP and Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
	 <style>
		 body{
			 background: url(slider.jpg);
			 background-repeat: no-repeat;
			 background-attachment: fixed;
			 padding-bottom: 10px;
/*			 color: #ff3a6d;*/
		 }
		 .btnact, .btnact:hover{
			 background: #008000;
			 color: white;
		 }
		 .rep{
			 color: white;
			 font-size: 20px;
			 font-family: Baskerville, "Palatino Linotype", Palatino, "Century Schoolbook L", "Times New Roman", "serif";
		 }
	 </style>
  <br />
  <h2 style="color: #ff3a6d;" align="center">Reviews for Tasty Noodles</h2>
  <br />
  <div class="container">
	  <div class="rep"></div>
   <form method="POST" id="comment_form">
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group" style="margin-left: 85%">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
   
		<a href="detail.php" class="btn btn-danger">Back</a>
		  <input style="margin-left: 5%" type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
<!--	<center><a href="index.php" class="btn btn-danger"><i class="icon-home icon-white"></i> Take Me Home</a></center>-->
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
	 
<!--	 use the below line to direct to -->
<!--	 <center><a href="index.php" class="btn btn-large btn-danger"><i class="icon-home icon-white"></i> Take Me Home</a></center>-->
	 
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }
 var count =0;
 $(document).on('click', '.reply', function(){
	 
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
  $('.reply').removeClass('btnact');
  $(this).addClass('btnact');
  if(count==0)
  {
	  count++;
	  $('.rep').append('<p>Reply Now:</p>');
  }
 });
 
});
</script>

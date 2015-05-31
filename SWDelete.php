<!DOCTYPE html>
<html>
<head>
	<title>It's a Mistake!</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(http://cdn29.us3.fansshare.com/images/starwars/star-wars-logo-logo-922413625.jpg); background-size:100% auto;">
	<div>
		<h2 style="text-align:center;"> <span class="label label-primary">Star Wars Book Inventory Delete</span></h2><br />
		<?php
		echo '<h4 style="text-align:center;"><span class="label label-info">Delete in progress... I hope you know what you are doing.</span></h4><br />';
		?>
	</div>
	<div class="form-group">
		<form class="form-inline" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<span style="text-align:center; display: block; margin: 0 auto;">
		<h4><span class="label label-default">Delete Characters (comma separated):</span></h4>
		<textarea class="form-control input-inline" rows="6" id="usr" cols="22"name="character" placeholder="loke Skywalker, (1 per line)"></textarea>
		<h4><span class="label label-default">Delete Title: '</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="book" placeholder="Star War: DarkForce Rising">
		<h4><span class="label label-default">Delete Set Name :</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="book" placeholder="The Thrann Trilogy"><br /> <br />
		<input type="submit" class="btn btn-default btn-sm" name="submit" value="Delete Book">
		</form>
		<a href="SWBooks.php"class="btn btn-default btn-sm" role="button">Search For Book</a>
		<a href="SWInsert.php"class="btn btn-default btn-sm" role="button">Insert a Book</a></span>

	</div>
</body>
</html>
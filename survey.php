<?php
	// Start the session
	session_start();

	// Check to see if the person has taken the survey
	if (isset($_SESSION['hasTaken']))
		header( 'Location:/results.php' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Star Wars Survey</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 	
</head>
<body style="background-image: url('http://cdn29.us1.fansshare.com/images/starwars/star-wars-episode-disney-logo-by-umbridge-jmoni-1276606412.jpg'); background-size:100% auto;">
<div class="container" role="main">
	<div class="center-block">
	<form class="form-inline" role="form" method="post" action="results.php">
		<div class="checkbox-inline">
		  <h4><span class="label label-default">Which Star Wars movies have you seen:</span></h4><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="Star Wars Episode I: The Phantom Menace">
		  Star Wars Episode I: The Phantom Menace</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="Star Wars Episode II: Attack of the Clones">
		  Star Wars Episode II: Attack of the Clones</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="Star Wars Episode III: Revenge of the Sith">
		  Star Wars Episode III: Revenge of the Sith</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="Star Wars Episode IV: A New Hope">
		  Star Wars Episode IV: A New Hope</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="Star Wars Episode V: The Empire Strikes Back">
		  Star Wars Episode V: The Empire Strikes Back</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="Star Wars Episode VI: Return of the Jedi">
		  Star Wars Episode VI: Return of the Jedi</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW[]" value="I Haven't Seen Star Wars">I Haven't Seen Star Wars</label><br />
		</div> 
		<div class="radio-inline">
		  <h4><span class="label label-default">Which Star Wars movie was your favorite:</span></h4> <br />
		  <label class="label label-default"><input type="radio" name="favSW" value="Star Wars Episode I: The Phantom Menace" required>
		  Star Wars Episode I: The Phantom Menace</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="Star Wars Episode II: Attack of the Clones" required>
		  Star Wars Episode II: Attack of the Clones</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="Star Wars Episode III: Revenge of the Sith" required>
		  Star Wars Episode III: Revenge of the Sith</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="Star Wars Episode IV: A New Hope">
		  Star Wars Episode IV: A New Hope</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="Star Wars Episode V: The Empire Strikes Back" required>
		  Star Wars Episode V: The Empire Strikes Back</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="Star Wars Episode VI: Return of the Jedi" required>
		  Star Wars Episode VI: Return of the Jedi</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="I Haven't Seen Star Wars" required>I Haven't Seen Star Wars</label><br />
		</div> 
		<div class="radio-inline">
		  <h4><span class="label label-default">Pick a lighsaber color:</span></h4><br />
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Green" required>Green</label>
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Yellow" required>Yellow</label><br />
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Purple" required>Purple</label>
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Cyan" required>Cyan</label><br />
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Orange" required>Orange</label>		  
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Blue" required>Blue</label><br />		  
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Veridian" required>Veridian</label>
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Silver" required>Silver</label><br />		  
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="Red" required>Red</label>
		</div> 
		<div class="input-inline">
			<h4><span class="label label-default">Who is your favorite Star Wars Character:</span></h4><br />
			<input type="text" class="form-control input-inline" id="usr" name="favChar"placeholder="Boba Fett" required>
			<input type="submit" class="btn btn-default btn-xs" name="submit" value="Submit">
			<a href="results.php" class="btn btn-default btn-xs" role="button">See Results</a>
		</div>
		
	</form>
	</div>	
</div>
</body>
</html
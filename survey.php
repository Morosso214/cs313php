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
	<form class="form-inline" role="form" action="results.php">
		<div class="checkbox-inline">
		  <h4><span class="label label-default">Which Star Wars movies have you seen:</span></h4><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="E1">Star Wars Episode I: The Phantom Menace</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="E2">Star Wars Episode II: Attack of the Clones
		  </label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="E3">Star Wars Episode III: Revenge of the Sith
		  </label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="E4">Star Wars Episode IV: A New Hope</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="E5">Star Wars Episode V: The Empire Strikes Back
		  </label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="E6">Star Wars Episode VI: Return of the Jedi</label><br />
		  <label class="label label-default"><input type="checkbox" name="seenSW" value="NA">I Haven't Seen Star Wars</label><br />
		</div> 
		<div class="radio-inline">
		  <h4><span class="label label-default">Which Star Wars movie was your favorite:</span></h4> <br />
		  <label class="label label-default"><input type="radio" name="favSW" value="E1" >Star Wars Episode I: The Phantom Menace</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="E2">Star Wars Episode II: Attack of the Clones
		  </label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="E3">Star Wars Episode III: Revenge of the Sith
		  </label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="E4">Star Wars Episode IV: A New Hope</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="E5" >Star Wars Episode V: The Empire Strikes Back
		  </label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="E6">Star Wars Episode VI: Return of the Jedi</label><br />
		  <label class="label label-default"><input type="radio" name="favSW" value="NA">I Haven't Seen Star Wars</label><br />
		</div> 
		<div class="radio-inline">
		  <h4><span class="label label-default">Pick a lighsaber color:</span></h4><br />
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="green">Green</label>
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="yellow">Yellow</label><br />
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="purple">Purple</label>
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="cyan">Cyan</label><br />
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="orange">Orange</label>		  
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="blue">Blue</label><br />		  
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="veridian">Veridian</label>
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="silver">Silver</label><br />		  
		  <label class="label label-default radio-inline"><input type="radio" name="lcolor" value="red">Red</label>
		</div> 
		<div class="input-inline">
			<h4><span class="label label-default">Who is your favorite Star Wars Character:</span></h4><br />
			<input type="text" class="form-control input-inline" id="usr" placeholder="Boba Fett">
			<input type="submit" class="btn btn-default btn-xs" value="See Results">
		</div>
		
	</form>
	</div>	
</div>
</body>
</html
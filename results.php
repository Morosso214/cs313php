<?php
	// Start the session
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Star Wars Survey Results</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 	
</head>
<body style="background-image: url('http://cdn29.us1.fansshare.com/images/starwars/star-wars-episode-disney-logo-by-umbridge-jmoni-1276606412.jpg'); 
background-size:100% auto;">
	<?php 		
 	
	$movie = $color = $favchar = ""; // Initialize member variables to work with the results of the most recent survey
	
	// Set up the arrays to store the results of the survey 
	$numSeen = array('Star Wars Episode I: The Phantom Menace' => '1', 'Star Wars Episode II: Attack of the Clones' => '1', 
		'Star Wars Episode III: Revenge of the Sith' => '1', 'Star Wars Episode IV: A New Hope' => '1',
	    'Star Wars Episode V: The Empire Strikes Back' => '1', 'Star Wars Episode VI: Return of the Jedi' => '1',
	    'I Haven\'t Seen Star Wars' => '0'); 
	$numFavMovie = array('Star Wars Episode I: The Phantom Menace' => '0', 'Star Wars Episode II: Attack of the Clones' => '0', 
		'Star Wars Episode III: Revenge of the Sith' => '0', 'Star Wars Episode IV: A New Hope' => '1',
	    'Star Wars Episode V: The Empire Strikes Back' => '0', 'Star Wars Episode VI: Return of the Jedi' => '0',
	    'I Haven\'t Seen Star Wars' => '0');
	$numLcolor = array('Green' => '0', 'Purple' => '0', 'Yellow' => '0', 'Cyan' => '0', 'Orange' => '1', 'Blue' => '0', 'Veridian' => '0',
	    'Silver' => '0', 'Red' => '0');
	$numFavChars = array('Stormtrooper TK-421' => '1');

	$file = fopen("results.txt","r");
	$tempNum = 1;
 	if($file)
 	{
     	while ($line = fgets($file))
     	{
        	$num = explode(',',$line);
        	if(isset($line))
        	{
        		if ($tempNum < 8)
            		$numSeen[$num[0]] = $num[1];
            	elseif (($tempNum > 7) && ($tempNum < 15))
            		$numFavMovie[$num[0]] = $num[1];
            	elseif (($tempNum > 14) && ($tempNum < 24))
            		$numLcolor[$num[0]] = $num[1];
            	else
            		$numFavChars[$num[0]] = $num[1];            	
        	}
        	$tempNum++;
     	}   	
    }
    fclose($file);

	// Set the variables to the ones that were passed in and increment each array for display
	if (!isset($_SESSION['hasTaken']))
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if (isset($_POST['favSW']))
			{
  				$movie = test_input($_POST["favSW"]);
  				$numFavMovie[$movie] = $numFavMovie[$movie] + 1;
  			}
  			if (isset($_POST['lcolor'])) 
  			{
  				$color = test_input($_POST["lcolor"]);
  				$numLcolor[$color] = $numLcolor[$color] + 1;
  			}	

  			if (!empty($_POST['favChar']))
  			{
  				$favchar = test_input($_POST["favChar"]);
  				if (isset($numFavChars[$favchar]))
  					$numFavChars[$favchar] = $numFavChars[$favchar] + 1;
  				else
  					$numFavChars[$favchar] = 1;
  			}

  			if (isset($_POST['seenSW']))
  			{
  				foreach ($_POST['seenSW'] as $i) 
  				{
  					$numSeen[$i] = $numSeen[$i] + 1;
  				}
  			}
		}

	}
	else
		echo "<h4 style=\"text-align:center\"><span class=\"label label-danger\">You have already taken the survey</span></h4><br />";

	$file =fopen("results.txt", "w");
	if($file)
	{
  	  foreach($numSeen as $key => $value)
  	  {
		fwrite($file, "$key,$value," .  PHP_EOL);
      }
      foreach($numFavMovie as $key2 => $value2)
  	  {
		fwrite($file, "$key2,$value2," .  PHP_EOL);
      }
      foreach($numLcolor as $key3 => $value3)
  	  {
		fwrite($file, "$key3,$value3," .  PHP_EOL);
      }
      foreach($numFavChars as $key4 => $value4)
  	  {
		fwrite($file, "$key4,$value4," .  PHP_EOL);
      }
      
      fclose($file);
	}
	
	

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 
	
	if (isset($_POST['favChar']))
 		{
 			$cookieName = "hasTaken";
 			$cookieVal = rand();
 			setcookie($cookieName, $cookieVal, time() + 1800, "/"); 
 			
 		}
	?>
	<div class="panel-group col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align:center; font-weight:bold">Which Star Wars movies have you seen:</div>
      <div class="panel-body" style="text-align:center">
      <?php
      	foreach ($numSeen as $x => $x_value)
		{
			if ($x_value == '1')
				echo $x_value . " Person has selected " . $x . "<br/>";
			else
				echo $x_value . " People have selected " . $x . "<br/>";
		}
		  
      ?>
      </div>
    </div>
    </div>
    <div class="panel-group col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align:center; font-weight:bold">Which Star Wars movie was your favorite:</div>
      <div class="panel-body" style="text-align:center">
      <?php 
      	foreach ($numFavMovie as $x => $x_value)
		{
			if ($x_value == '1')
				echo $x_value . " Person has selected " . $x . "<br/>";
			else
				echo $x_value . " People have selected " . $x . "<br/>";
		}
      ?>
      </div>
    </div>
    </div>
    <div class="panel-group col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align:center; font-weight:bold">Pick a lighsaber color:</div>
      <div class="panel-body" style="text-align:center">
      <?php 
      	foreach ($numLcolor as $x => $x_value)
		{
			if ($x_value == '1')
				echo $x_value . " Person has selected " . $x . "<br/>";
			else
				echo $x_value . " People have selected " . $x . "<br/>";
		}
      ?>
      </div>
    </div>
    </div>
    <div class="panel-group col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align:center; font-weight:bold">Who is your favorite Star Wars Character:</div>
      <div class="panel-body" style="text-align:center">
      	<?php 
      	foreach ($numFavChars as $x => $x_value)
		{
			if (isset($numFavChars[$x]))
			{
				if ($x_value == '1')
					echo $x_value . " Person has selected " . $x . "<br/>";
				else
					echo $x_value . " People have selected " . $x . "<br/>";
			}			
		}
		
        ?>
      </div>
    </div>
    </div>    
</body>
</html>
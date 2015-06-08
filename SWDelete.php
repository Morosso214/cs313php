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
		require("dbConn.php");
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try
			{
				$db = loadDatabase();
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bookNum = 0;
				$setNum = 0;
				$charArr;
				$charName = '';
				echo '<h4 style="text-align:center;"><span class="label label-info">Delete in progress... I hope you know what you are doing.</span></h4><br />';
				if (isset($_POST['book']))
	  			{
	  				$book = test_input($_POST['book']);
	  				if ($book != '')
	  				{
	  					$query = "SELECT id FROM sw_book WHERE title=:title;";
	  					$stmt = $db->prepare($query);
	  					$stmt->bindValue(':title', $book);
	  					$stmt->execute();
	  					$temp = $stmt->fetch();
	  					$bookNum = $temp[0];

  						// delete from many-many
  						$query = "DELETE FROM sw_book_character WHERE book_id=:book;";
	  					$stmt = $db->prepare($query);
	  					$stmt->bindValue(':book', $bookNum);
	  					$stmt->execute();

	  					$stmt->closeCursor();

  						$query = "SELECT title FROM sw_book WHERE title=:title;";
  						$stmt = $db->prepare($query);
  						$stmt->bindValue(':title', $book);
  						$stmt->execute();
  						$temp = $stmt->fetch();
  						$tempVal = $temp['title'];
						
						if ($tempVal == $book)
						{
   							$query = "DELETE FROM sw_book WHERE title=:title;";
	  						$stmt = $db->prepare($query);
	  						$stmt->bindValue(':title', $book);
	  						$stmt->execute();
								
	  					}
  					}
	  			}
	
				if (isset($_POST['thrawn']))
				{
					$setName = test_input($_POST["thrawn"]);
					if ($setName != '')
					{
						$query = "SELECT name FROM book_set WHERE name=:setName;";
						$stmt = $db->prepare($query);
						$stmt->bindValue(':setName', $setName);
						$stmt->execute();
						$temp = $stmt->fetch();
						$tempVal = $temp['name'];

  						$stmt->closeCursor();
	  						
 						if ($tempVal == $setName)
  						{
  							$query = "DELETE FROM book_set WHERE name =  :setName;";
	  						$stmt = $db->prepare($query);
	  						$stmt->bindValue(':setName', $setName);
	  						$stmt->execute();
	  					}
	  				}  					
  				}

  				if (isset($_POST['character']))
				{
  					$charName = test_input($_POST["character"]);
  					if ($charName != '')
  					{
  						$charArr = explode(', ', $charName);
  						foreach ($charArr as $val)
  						{
  							$query = "SELECT name FROM sw_character WHERE name=:name;";
  							$stmt = $db->prepare($query);
  							$stmt->bindValue(':name', $val);
  							$stmt->execute();
  							$temp = $stmt->fetch();
  							$tempVal = $temp['name'];
							
							if ($tempVal == $val)
							{
   								$query = "DELETE FROM sw_character WHERE name=:charName;";
	  							$stmt = $db->prepare($query);
	  							$stmt->bindValue(':charName', $val);
	  							$stmt->execute();
	  						}
  						}	  					
	  				}  					
  				}
				
			}
			catch (PDOEXCEPTION $ex)
			{
				echo '<h4 style="text-align:center;"><span class="label label-info">Something bad happened! Details: ' . $ex . '</span></h4><br />';
			}

		}

		function test_input($data) {
  		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		} 
		
		?>
	</div>
	<div class="form-group">
		<form class="form-inline" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<span style="text-align:center; display: block; margin: 0 auto;">
		<h4><span class="label label-default">Delete Characters (comma separated):</span></h4>
		<h4><span class="label label-default">Please put a space after every comma</span></h4>
		<textarea class="form-control input-inline" rows="6" id="usr" cols="22"name="character" placeholder="loke Skywalker, Bib Frotuna, etc..."></textarea>
		<h4><span class="label label-default">Delete Title:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="book" placeholder="Star War: DarkForce Rising">
		<h4><span class="label label-default">Delete Set Name:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="thrawn" placeholder="The Thrann Trilogy"><br /> <br />
		<input type="submit" class="btn btn-default btn-sm" name="submit" value="Delete Book">
		</form>
		<a href="SWBooks.php"class="btn btn-default btn-sm" role="button">Search For Book</a>
		<a href="SWInsert.php"class="btn btn-default btn-sm" role="button">Insert a Book</a></span>

	</div>
</body>
</html>
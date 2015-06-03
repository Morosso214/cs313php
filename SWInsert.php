<!DOCTYPE html>
<html>
<head>
	<title>It's an Addition!</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(http://cdn29.us3.fansshare.com/images/starwars/star-wars-logo-logo-922413625.jpg); background-size:100% auto;">
	<div>
		<h2 style="text-align:center;"> <span class="label label-primary">Star Wars Book Inventory Insert</span></h2><br />
		<?php
		require("dbConn.php");
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try
			{
				$db = loadDatabase();
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$isSetName = false;
				$setNum = 0;
				$bookNum = 0;
				$charArr;
				$charName = '';
				
				if (isset($_POST['setName']))
					{
	  					$setName = test_input($_POST["setName"]);
	  					if ($setName != '')
	  					{
	  						$isSetName = true; 
		  					$query = "INSERT INTO book_set(name) VALUES (:setName);";
		  					$stmt = $db->prepare($query);
		  					$stmt->bindValue(':setName', $setName);
		  					$stmt->execute();
		  					$setNum = $db->lastInsertId();
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
	  							$query = "INSERT INTO sw_character(name) VALUES (:charName);";
		  						$stmt = $db->prepare($query);
		  						$stmt->bindValue(':charName', $val);
		  						$stmt->execute();
	  						}	  					
		  				}  					
	  				}
	  				if (isset($_POST['author']))
					{
	  					$author = test_input($_POST["author"]);
	  					$title = test_input($_POST["book"]);
	  					$year = test_input($_POST["year"]);
	  					$chron = test_input($_POST["chron"]);
	  					$chronId;
	  					if ($chron == 'ABY')
	  						$chronId = 1;
	  					else
	  						$chronId = 2;
	  					if (($author != '') && ($title != '') && ($year != '') && ($chron != ''))
	  					{
	  						if (isset($_POST['author2']))
	  						{
	  							$author2 = test_input($_POST['author2']);
	  							if ($author2 != '')
	  							{
	  								if ($isSetName)
	  								{
	  									$query = "INSERT INTO sw_book(title, set_id, chron_id, year, author_name, author2_name) ";
	  									$query .= "VALUES (:title, :setNum, :chronId, :year, :author, :author2);";
		  								$stmt = $db->prepare($query);
		  								$stmt->bindValue(':title', $title);
		  								$stmt->bindValue(':setNum', $setNum);
		  								$stmt->bindValue(':chronId', $chronId);
		  								$stmt->bindValue(':year', $year);
		  								$stmt->bindValue(':author', $author);
		  								$stmt->bindValue(':author2', $author2);
		  								$stmt->execute();
	  								}
	  								else
	  								{
	  									$query = "INSERT INTO sw_book(title, chron_id, year, author_name, author2_name) ";
	  									$query .= "VALUES (:title, :chronId, :year, :author, :author2);";
		  								$stmt = $db->prepare($query);
		  								$stmt->bindValue(':title', $title);
		  								$stmt->bindValue(':chronId', $chronId);
		  								$stmt->bindValue(':year', $year);
		  								$stmt->bindValue(':author', $author);
		  								$stmt->bindValue(':author2', $author2);
		  								$stmt->execute();
	  								}
	  							}
	  							else
	  							{
	  								if ($isSetName)
	  								{
			  							$query = "INSERT INTO sw_book(title, set_id, chron_id, year, author_name) ";
			  							$query .= "VALUES (:title, :setNum, :chronId, :year, :author);";
				  						$stmt = $db->prepare($query);
				  						$stmt->bindValue(':title', $title);
				  						$stmt->bindValue(':setNum', $setNum);
				  						$stmt->bindValue(':chronId', $chronId);
				  						$stmt->bindValue(':year', $year);
				  						$stmt->bindValue(':author', $author);
				  						$stmt->execute();
			  						}
			  						else
			  						{
			  							$query = "INSERT INTO sw_book(title, chron_id, year, author_name) ";
			  							$query .= "VALUES (:title, :chronId, :year, :author);";
				  						$stmt = $db->prepare($query);
				  						$stmt->bindValue(':title', $title);
				  						$stmt->bindValue(':chronId', $chronId);
				  						$stmt->bindValue(':year', $year);
				  						$stmt->bindValue(':author', $author);
				  						$stmt->execute();
			  						}
	  							}
	  						}
	  						
	  						
	  							  					
							$bookNum = $db->lastInsertId();
							foreach($charArr as $val)
							{
								$query = "SELECT id FROM sw_character WHERE name=:name;";
								$stmt = $db->prepare($query);
								$stmt->bindValue(':name', $val);
								$stmt->execute();
								$Temp = $stmt->fetch();
								$charId = $Temp[0];
								
								$stmt->closeCursor();

								$query = "INSERT INTO sw_book_character(book_id, char_id) VALUES(:book, :character);";
								$stmt = $db->prepare($query);
								$stmt->bindValue(':book', $bookNum);
								$stmt->bindValue(':character', $charId);
								$stmt->execute();
							}   							  					
		  				}  					
	  				}

				echo '<h4 style="text-align:center;"><span class="label label-info">Book Inserted</span></h4><br />';
			}
			catch (PDOEXCEPTION $ex)
			{
				echo "Something bad happened!";
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
		<span style="text-align:center; display: block; margin: 0 auto;"> <h4><span class="label label-default">Insert Author:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="author" placeholder="Timothy Zahn" required>
		<h4><span class="label label-default">Insert Author 2 (optional):</span></h4>
		<input type="text" class="form-control input-inline" id="usr2" name="author2" placeholder="Michael Reaves">
		<h4><span class="label label-default">Insert Main Characters (comma separated):</span></h4>
		<textarea class="form-control input-inline" rows="6" id="person" cols="22"name="character" placeholder="Luke Skywalker, Han Solo, etc..." required></textarea>
		<h4><span class="label label-default">Insert Title With 'Star Wars: '</span></h4>
		<input type="text" class="form-control input-inline" id="book" name="book" placeholder="Star Wars: Dark Force Rising" required>
		<h4><span class="label label-default">Insert Set Name (Optional):</span></h4>
		<input type="text" class="form-control input-inline" id="set" name="setName" placeholder="The Thrawn Trilogy">
		<h4><span class="label label-default">Insert Year with description (ABY or BBY):</span></h4>		
		<input type="text" class="form-control input-inline" id="year" name="year" placeholder="22" required>
		<label class="label label-default radio-inline" style="margin-left:15px;"><input type="radio" name="chron" value="ABY" required>ABY</label>
		<label class="label label-default radio-inline" style="margin-left:15px;"><input type="radio" name="chron" value="BBY" required>BBY</label><br /> <br />
		<input type="submit" class="btn btn-default btn-sm" name="submit" value="Insert Book">
		</form>
		<a href="SWBooks.php"class="btn btn-default btn-sm" role="button">Search For a Book</a>
		<a href="SWDelete.php"class="btn btn-default btn-sm" role="button">Delete a Book</a></span>

	</div>
</body>
</html>
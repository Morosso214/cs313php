<!DOCTYPE html>
<html>
<head>
	<title>It's an Inventory!</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(http://cdn29.us3.fansshare.com/images/starwars/star-wars-logo-logo-922413625.jpg); background-size:100% auto;">
	<div>
		<h2 style="text-align:center;"> <span class="label label-primary">Star Wars Book Inventory Search</span></h2><br />
		<?php
			require("dbConn.php");
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{

			try
			{
				$db = loadDatabase();
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$character = test_input($_POST["character"]);
				$title = test_input($_POST["book"]);
				$setName = test_input($_POST["set"]);
				$author = test_input($_POST["author"]);
				$author2 = '';
				$query = '';
				$stmt = '';


				if ($title != '')
				{
					$title = "%" . $title . "%";
					$query = "SELECT * FROM sw_book WHERE title LIKE :title;";
	  				$stmt = $db->prepare($query);
	  				$stmt->bindValue(':title', $title);
	  				$stmt->execute();
	  				$temp = $stmt->fetch();
  					$author2 = $temp['author2_name'];
				}

				if (isset($_POST['year']))
  				{
  					$year = test_input($_POST['year']);
  					$query = "SELECT * FROM sw_book b JOIN chronology c ON b.chron_id = c.id WHERE c.name=:year ORDER BY year;";
  					$stmt = $db->prepare($query);
  					$stmt->bindValue(':year', $year);
	  				$stmt->execute();

  					foreach ($stmt->fetchAll() as $row ) {
  						echo '<h4 style="text-align:center;"><span class="label label-default">' . $row['title'] . ' by ' . $row['author_name'] . ' takes place ' . $row['year'] . " " . $row['name'] . "</span></h4><br />";
  					}  				
				
				}


				if (($character != '') && ($author != '') && ($title != '') && ($setName != ''))
				{
					$character = "%" . $character . "%";
					$author = "%" . $author . "%";
					$title = "%" . $title . "%";
					$setName = "%" . $setName . "%";
					$query = "SELECT title, c.name AS characterName, sbs.name AS setName, author_name FROM sw_character c JOIN sw_book_character sbc ON c.id = sbc.char_id JOIN sw_book b ON sbc.book_id = b.id JOIN book_set sbs ON b.set_id = sbs.id WHERE c.name LIKE :cname AND title LIKE :title AND author_name LIKE :aname AND sbs.name LIKE :sname;";
					$stmt = $db->prepare($query);
					$stmt->bindValue(':cname', $character);
					$stmt->bindValue(':aname', $author);
					$stmt->bindValue(':sname', $setName);
					$stmt->bindValue(':title', $title);
					$stmt->execute();

					foreach ($stmt->fetchAll() as $row ) {
  						$out = '<h4 style="text-align:center;"><span class="label label-default">' . $row['characterName'];
  						$out .= ' is in ' . $row['title'] . ' Which belongs to set ' . $row['setName'];
  						$out .= ' by ' . $row['author_name'] . "</span></h4><br />";
  						echo $out; 
  					}

				}
				elseif (($character != '') && ($author != '') && ($title != ''))
				{
					$character = "%" . $character . "%";
					$author = "%" . $author . "%";
					$title = "%" . $title . "%";
					$setName = "%" . $setName . "%";
					$query = "SELECT title, c.name AS characterName, author_name FROM sw_character c JOIN sw_book_character sbc ON c.id = sbc.char_id JOIN sw_book b ON sbc.book_id = b.id WHERE c.name LIKE :cname AND title LIKE :title AND author_name LIKE :aname;";
					$stmt = $db->prepare($query);
					$stmt->bindValue(':cname', $character);
					$stmt->bindValue(':aname', $author);
					$stmt->bindValue(':title', $title);
					$stmt->execute();

					foreach ($stmt->fetchAll() as $row ) {
  						$out = '<h4 style="text-align:center;"><span class="label label-default">' . $row['characterName'];
  						$out .= ' is in ' . $row['title'] . ' by ' . $row['author_name'] . "</span></h4><br />";
  						echo $out; 
  					}

				}
				elseif (($character != '') && ($author != '') && ($setName != ''))
				{
					$character = "%" . $character . "%";
					$author = "%" . $author . "%";
					$title = "%" . $title . "%";
					$setName = "%" . $setName . "%";
					$query = "SELECT title, c.name AS characterName, sbs.name AS setName, author_name FROM sw_character c JOIN sw_book_character sbc ON c.id = sbc.char_id JOIN sw_book b ON sbc.book_id = b.id JOIN book_set sbs ON b.set_id = sbs.id WHERE c.name LIKE :cname AND author_name LIKE :aname AND sbs.name LIKE :sname;";
					$stmt = $db->prepare($query);
					$stmt->bindValue(':cname', $character);
					$stmt->bindValue(':aname', $author);
					$stmt->bindValue(':sname', $setName);
					$stmt->execute();

					foreach ($stmt->fetchAll() as $row ) {
  						$out = '<h4 style="text-align:center;"><span class="label label-default">' . $row['characterName'];
  						$out .= ' is in ' . $row['title'] . ' Which belongs to set ' . $row['setName'];
  						$out .= ' by ' . $row['author_name'] . "</span></h4><br />";
  						echo $out; 
  					}

				}				
				elseif ($character != '')
  				{
  					$character = "%" . $character . "%";
 	  				$query = "SELECT * FROM sw_book b JOIN sw_book_character sbc ON b.id = sbc.book_id JOIN sw_character sc ON sc.id = sbc.char_id WHERE sc.name LIKE :name;";
	  				$stmt = $db->prepare($query);
	  				$stmt->bindValue(':name', $character);
	  				$stmt->execute();
	  			
  					foreach ($stmt->fetchAll() as $row ) {
  						$out = '<h4 style="text-align:center;"><span class="label label-default">' . $row['name'];
  						$out .= ' is in ' . $row['title'] . ' by ' . $row['author_name'] . "</span></h4><br />";
  						echo $out; 
  					}
  				}
  				
				elseif ($title != '')
  				{
  					$title = "%" . $title . "%";
	  				$query = "SELECT title, author_name FROM sw_book WHERE title LIKE :title;";
	  				$stmt = $db->prepare($query);
	  				$stmt->bindValue(':title', $title);
	  				$stmt->execute();

  					foreach ($stmt->fetchAll() as $row ) {
  						echo '<h4 style="text-align:center;"><span class="label label-default">' . $row['title'] . ' by ' . $row['author_name'] . "</span></h4><br />";
  					}
  				}
				elseif ($setName != '')
  				{
  					$setName = "%" . $setName . "%";
	  				$query = "SELECT * FROM sw_book  b JOIN book_set s ON b.set_id = s.id WHERE s.name LIKE :name;";
	  				$stmt = $db->prepare($query);
	  				$stmt->bindValue(':name', $setName);
	  				$stmt->execute();
	  			
  					foreach ($stmt->fetchAll() as $row ) {
  						$output = '<h4 style="text-align:center;"><span class="label label-default">' . $row['title'] . ' by ' . $row['author_name'];
  						$output .= ' is in ' . $row['name'] . "</span></h4><br />";
  						echo $output;
  					}
  				}
				elseif ($author != '')
  				{
	  				$author = "%" . $author . "%";
	  				$query = "SELECT title, author_name FROM sw_book WHERE author_name LIKE :name;";
	  				$stmt = $db->prepare($query);
	  				$stmt->bindValue(':name', $author);
	  				$stmt->execute();
	  			
  					foreach ($stmt->fetchAll() as $row ) {
  						echo '<h4 style="text-align:center;"><span class="label label-default">' . $row['title'] . ' by ' . $row['author_name'] . "</span></h4><br />";
  					}

  				}  				
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
		<span style="text-align:center; display: block; margin: 0 auto;"> <h4><span class="label label-default">Search by Author:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="author" placeholder="Timothy Zahn">
		<h4><span class="label label-default">Search by Character:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="character" placeholder="R2-D2">
		<h4><span class="label label-default">Search by Title:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="book" placeholder="Dark Force Rising">
		<h4><span class="label label-default">Search by Set Name:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="set" placeholder="The Thrawn Trilogy">
		<h4><span class="label label-default">Search by Year:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="year" placeholder="ABY or BBY"><br /> <br />
		<input type="submit" class="btn btn-default btn-sm" name="submit" value="See Books">
		</form>
		<a href="SWInsert.php"class="btn btn-default btn-sm" role="button">Insert a Book</a>
		<a href="SWDelete.php"class="btn btn-default btn-sm" role="button">Delete a Book</a></span>

	</div>

</body>
</html>
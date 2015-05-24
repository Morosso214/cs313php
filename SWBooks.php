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
		<h2 style="text-align:center;"> <span class="label label-primary">Star Wars Book Inventory</span></h2><br />
		<?php
			require("dbConn.php");
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{

			try
			{
				$db = loadDatabase();
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$query = '';
				$stmt = '';

				if (isset($_POST['year']))
  				{
  					$year = test_input($_POST['year']);
  					$query = "SELECT * FROM sw_book b JOIN chronology c ON b.chron_id = c.id WHERE c.name=:year ORDER BY year;";
  					$stmt = $db->prepare($query);
  					$stmt->bindValue(':year', $year);
	  				$stmt->execute();

  					foreach ($stmt->fetchAll() as $row ) {
  						echo '<h4 style="text-align:center;"><span class="label label-default">' . $row['title'] . ' takes place ' . $row['year'] . " " . $row['name'] . "</span></h4><br />";
  					}  				
				
				}

				if (isset($_POST['author']))
				{
  					$author = test_input($_POST["author"]);
  					$query = "SELECT title, author_name FROM sw_book WHERE author_name=:name;";
  					$stmt = $db->prepare($query);
  					$stmt->bindValue(':name', $author);
  					$stmt->execute();

  					foreach ($stmt->fetchAll() as $row ) {
  						echo '<h4 style="text-align:center;"><span class="label label-default">' . $row['title'] . ' by ' . $row['author_name'] . "</span></h4><br />";
  					}

  				}
  				if (isset($_POST['character']))
				{
  					$character = test_input($_POST["character"]);
  					$query = "SELECT * FROM sw_book b JOIN sw_book_character sbc ON b.id = sbc.book_id JOIN sw_character sc ON sc.id = sbc.char_id WHERE sc.name=:name;";
  					$stmt = $db->prepare($query);
  					$stmt->bindValue(':name', $character);
  					$stmt->execute();
  					foreach ($stmt->fetchAll() as $row ) {
  						echo '<h4 style="text-align:center;"><span class="label label-default">' . $row['name'] . ' is in ' . $row['title'] . "</span></h4><br />";
  					}
  				}
  				if (isset($_POST['book']))
				{
  					$title = test_input($_POST["book"]);
  					$query = "SELECT title, author_name FROM sw_book WHERE title=:title;";
  					$stmt = $db->prepare($query);
  					$stmt->bindValue(':title', $title);
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
		<h4><span class="label label-default">Search by Year:</span></h4>
		<input type="text" class="form-control input-inline" id="usr" name="year" placeholder="ABY or BBY"><br /> <br />
		<input type="submit" class="btn btn-default btn-sm" name="submit" value="See Books">
		</span></form>

	</div>

</body>
</html>
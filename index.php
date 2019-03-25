<?php
	include 'dh.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search">
	<button type="submit" name="submit-search">Search</button>
</form>

<h1>Games</h1>
<h2>All Games</h2>

<div class="games-container">
	<?php
	    $sql = "SELECT * FROM Games";
	    $result= mysqli_query($conn, $sql);
	    $queryResults = mysqli_num_rows($result);

	    if($queryResults>0){
		    while($row=mysqli_fetch_assoc()){
			    echo "<div>
				<h3>".$row['g_league']."</h3>
				<p>".$row['g_game']."</p>
				<p>".$row['g_date']."</p>
				<p>".$row['g_time']."</p>	
			</div>";
		}
	}

	?>
</div>
</body>
</html>


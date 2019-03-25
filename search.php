<?php

	include_once 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="games-container">
<?php
if(isset($_POST['submit-search'])){
$search = mysqli_real_escape_string($conn, $_POST['search']);
$sql = "select * from Games where g_league like '%$search%' or g_game like '%$search%' or g_date like '%$search%' or g_time like '%$search%'";
$result = mysqli_query($conn, $sql);
$queryResult=mysqli_num_rows($result);
if($queryResult > 0){
	while($row = mysqli_fetch_assoc($result)){
	 	echo "<a href='games.php?league=".$row['g_league']."&game=".$row['g_game']."'><div class='game-box'>
                       <h3>".$row['g_league']."</h3>
                       <p>".$row['g_game']."</p>
                       <p>".$row['g_date']."</p>
                       <p>".$row['g_time']."</p>       
                     </div></a>"
	

}else{
	echo "There are no results matching your search!";}
?>

</div>
</body>
</html>

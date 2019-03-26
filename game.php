<?php
	include 'db.php';
?>


<h1>Games</h1>

<div class="games-container">
<?php
	$league = mysqli_real_escape_string($conn, $_GET['league']);
	$game = mysqli_real_escape_string($conn, $_GET['game']);


	$sql = "SELECT * FROM Games WHERE g_league='$league' AND g_game='$game'";
        $result= mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

        if($queryResults>0){
        	while($row=mysqli_fetch_assoc()){
                	echo "<div class='games-container'>
                                <h3>".$row['g_league']."</h3>
                                <p>".$row['g_game']."</p>
                                <p>".$row['g_date']."</p>
                                <p>".$row['g_time']."</p>       
                        </div>"
                }
        }

        ?>
</div>
</body>
</html>



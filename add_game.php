<?php

    require_once('dbConnect.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
 
		$game_fk_console = $_POST['game_fk_console'];
        $game_name       = $_POST['game_name'];
        		
		$sql_perso = "INSERT INTO gg_game (game_fk_console,game_name) 
		                  VALUES ('$game_fk_console','$game_name')";
		
		mysqli_query($con,$sql_perso);
        

        $modification_date = date('Y-m-j H:i:s');
        $sql_modification_date = "UPDATE gg_version
                                  SET version_date = '$modification_date'
                                  WHERE version_id = 1";
        mysqli_query($con,$sql_modification_date);
        
		echo "success" ;
	}
	else{
		echo "no data" ;
	}
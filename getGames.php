<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	//Importing database
	require_once('dbConnect.php');

	$sql = "SELECT game_id,
				   game_name,
			       game_fk_console
			FROM gg_game" ;

	//getting result
	$result_search_dishes = mysqli_query($con,$sql);

	//pushing result to an array
	$result = array();
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_search_dishes)){

		//Pushing name and id in the blank array created
		array_push($result,array("game_id"=>$row['game_id'],
								 "game_name"=>$row['game_name'],
								 "game_fk_console"=>$row['game_fk_console']
		));
	}

	//displaying in json format
	echo json_encode(array('result'=>$result));

	mysqli_close($con);
}

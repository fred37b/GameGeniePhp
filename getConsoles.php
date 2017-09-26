<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	//Importing database
	require_once('dbConnect.php');

	$sql = "SELECT console_id,
				   console_name
			FROM gg_console" ;

	//getting result
	$result_search_dishes = mysqli_query($con,$sql);

	//pushing result to an array
	$result = array();
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_search_dishes)){

		//Pushing name and id in the blank array created
		array_push($result,array("console_id"=>$row['console_id'],
								 "console_name"=>$row['console_name']
		));
	}

	//displaying in json format
	echo json_encode(array('result'=>$result));

	mysqli_close($con);
}

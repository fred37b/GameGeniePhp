<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	//Importing database
	require_once('dbConnect.php');

	$sql = "SELECT code_id,
				   code_code,
			       code_desc,
				   code_fk_game
			FROM gg_code" ;

	//getting result
	$result_search_dishes = mysqli_query($con,$sql);

	//pushing result to an array
	$result = array();
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_search_dishes)){

		//Pushing name and id in the blank array created
		array_push($result,array("code_id"=>$row['code_id'],
								 "code_code"=>$row['code_code'],
								 "code_desc"=>$row['code_desc'],
								 "code_fk_game"=>$row['code_fk_game']
		));
	}

	//displaying in json format
	echo json_encode(array('result'=>$result));

	mysqli_close($con);
}

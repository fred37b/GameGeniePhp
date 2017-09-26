<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

	//Importing database
	require_once('dbConnect.php');

	$sql = "SELECT version_id,
				   version_date
			FROM gg_version" ;

	//getting result
	$result_search_dishes = mysqli_query($con,$sql);

	//pushing result to an array
	$result = array();
	//looping through all the records fetched
	while($row = mysqli_fetch_array($result_search_dishes)){

		//Pushing name and id in the blank array created
		array_push($result,array("version_id"=>$row['version_id'],
								 "version_date"=>$row['version_date']
		));
	}

	//displaying in json format
	echo json_encode(array('result'=>$result));

	mysqli_close($con);
}

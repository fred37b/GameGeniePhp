<?php

    require_once('dbConnect.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
 
		$code_code    = $_POST['code_code'];
        $code_desc    = $_POST['code_desc'];
        $code_fk_game = $_POST['code_fk_game'];
        		
		$sql_perso = "INSERT INTO gg_code (code_code,code_desc,code_fk_game) 
		              VALUES ('$code_code','$code_desc','$code_fk_game')";
		
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
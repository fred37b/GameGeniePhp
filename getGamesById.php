<?php
    /*
     * getGamesById.php
     */ 
    if($_SERVER['REQUEST_METHOD']=='POST'){
  
        require_once('dbConnect.php');
        
        $game_fk_console = $_POST['game_fk_console'];
        //$console_id = 1 ;
        //$game_fk_console = 1;

        $sql_media = "SELECT game_id,game_name,game_fk_console 
                      FROM gg_game 
                      WHERE game_fk_console = $game_fk_console";

        //Creating sql query
        /*
        $sql_media = "SELECT game_id,game_name,game_fk_console 
                      FROM gg_game
                      WHERE game_id = 1";
        */

        //getting result
        $result_media = mysqli_query($con,$sql_media);

        //creating a blank array
        $result = array();

        //looping through all the records fetched
        while($row = mysqli_fetch_array($result_media)){
            //Pushing name and id in the blank array created
            array_push($result,array("game_id"=>$row['game_id'],
                                    "game_name"=>$row['game_name']));
        }

        $empty = empty($result) ;

        if($empty == 1){	
            echo json_encode(array('result'=>$result));
        }else{
            echo json_encode(array('result'=>$result));
        }

        mysqli_close($con);

        /*
        require_once('dbConnect.php');

        $console_id = $_POST['console_id'];
         
        $sql = "SELECT game_id,game_name,game_fk_console 
                FROM gg_game 
                WHERE game_id = $console_id";

        $result_media = mysqli_query($con,$sql);
         
        //creating a blank array
		$result = array();

        while($row = mysqli_fetch_array($result_media)){
			//Pushing name and id in the blank array created
			array_push($result,array("game_id"=>$row['game_id'],
									 "game_name"=>$row['game_name'],
									 "game_fk_console"=>$row['game_fk_console']
			));
        }
        
        echo json_encode($result);
        mysqli_close($con);
        */
    }
    else{
        echo "no data" ;
    }
<?php 
    /*
     * get_codes_by_game_id.php
     * Permet de recuper les codes d'un jeu en donnant son id
     * 
     * code_id	
     * code_code	
     * code_desc	
     * code_fk_game
     */

     if($_SERVER['REQUEST_METHOD']=='POST'){
        
              require_once('dbConnect.php');
              
              $code_fk_game = $_POST['code_fk_game'];

              //Creating sql query
              $sql_media = "SELECT code_id,code_code,code_desc,code_fk_game 
                            FROM gg_code 
                            WHERE code_fk_game = $code_fk_game";
            
              //getting result
              $result_media = mysqli_query($con,$sql_media);
      
              //creating a blank array
              $result = array();
      
              //looping through all the records fetched
              while($row = mysqli_fetch_array($result_media)){
                  //Pushing name and id in the blank array created
                  array_push($result,array("code_id"=>$row['code_id'],
                                           "code_code"=>$row['code_code'],
                                           "code_desc"=>$row['code_desc'],
                                           "code_fk_game"=>$row['code_fk_game']));
              }
      
              $empty = empty($result) ;
      
              if($empty == 1){	
                  echo json_encode(array('result'=>$result));
              }else{
                  echo json_encode(array('result'=>$result));
              }
      
              mysqli_close($con);
          }
          else{
              echo "no data" ;
          }
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page Title</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <h1>Game Genie Inputer</h1>

        <h2>Add Game</h2>
        
        
        <div class="alert alert-success" role="alert" id="addGameAck">
            <strong>Well done!</strong> You successfully read this important alert message.
        </div>
        <div class="alert alert-danger" role="alert" id="addGameWrong">
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
        </div>
        
        <div class="row">
            <form class="col-sm-6">
                <div class="form-group">
                    <label for="formGroupExampleInput">Selection de la console :</label>
                    <select class="form-control" id="typeConsole">
                        <!-- onchange="selectConsole(this)" -->
                        <!--
                        <option value="1">TV</option>
                        <option value="2">Radio</option>
                        -->
                    </select>
                </div>
            </form>
            <div class="col-sm-4">
                <label>Code :</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Entrer un jeu" aria-describedby="basic-addon1" id="addGameTxtFld">
                </div>    
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger" onclick="clearAddGameField()">Clear Field</button>
                <button type="button" class="btn btn-primary" onclick="addGame()">Submit</button>
            </div>
        </div>
        <hr>
        <h2>Add Code</h2>
        <div class="alert alert-success" role="alert" id="addCodeAck">
            <strong>Well done!</strong> You successfully read this important alert message.
        </div>
        <div class="alert alert-danger" role="alert" id="addCodeWrong">
            <strong>Oh snap!</strong> Change a few things up and try submitting again.
        </div>
        <div class="row">
            <form class="col-sm-6">
                <div class="form-group">
                    <label for="formGroupExampleInput">Selection de la console :</label>
                    <select class="form-control" id="typeConsoleAddCode" onchange="selectConsole(this)">
                    </select>
                </div>
            </form>
            <form class="col-sm-6">
                <div class="form-group">
                    <label for="formGroupExampleInput">Selection du jeux :</label>
                    <select class="form-control" id="selectGame" onchange="selectAGame(this)">
                        <option>Selectionner un jeu</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label>Code :</label>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Code" aria-describedby="basic-addon1" id="addCodeTxtFld">
                </div>    
            </div>
            <div class="col-sm-6">
                <label>Description :</label>  
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon1" id="addDescTxtFld">
                </div>   
            </div>
        </div>
        <br>
        <button type="button" class="btn btn-danger" onclick="clearAddCodeField()">Clear Field</button>
        <button type="button" class="btn btn-primary" onclick="addCode()">Submit</button>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>code_id</th>
                    <th>code_code</th>
                    <th>code_desc</th>
                    <th>code_fk_game</th>
                </tr>
            </thead>
            <tbody id="tbodyCodeList">
            </tbody>
        </table>
        <hr>
        
        <script src="jquery-3.1.1.js"></script>
        <script>
              
            //--- Init
            fullSelectConsoleList("typeConsole");
            fullSelectConsoleList("typeConsoleAddCode");

            document.getElementById("addGameAck").style.visibility='hidden';
            document.getElementById("addGameWrong").style.visibility='hidden';
            document.getElementById("addCodeAck").style.visibility='hidden';
            document.getElementById("addCodeWrong").style.visibility='hidden';

            /*
             * Permet de remplir la combo box des consoles
             */
            function fullSelectConsoleList(selectId){
                $.ajax({type: "POST",
                    url: 'getConsoles.php',                            
                    data: "",                        
                    dataType: 'json',                     
                    success: function(data)         
                    {  
                        var results = data.result ;
                        var comboBoxPersoInterview = document.getElementById(selectId);
                        
                        var optionMedia = document.createElement('option');
                        optionMedia.text= "<Selectionner une console>";
                        comboBoxPersoInterview.appendChild(optionMedia);
                        
                        for (var i = 0; i < results.length; i++) {
                            var option = document.createElement('option');
                            option.value=results[i].console_id;
                            option.text= results[i].console_name;
                            comboBoxPersoInterview.appendChild(option);
                        }
                        
                    }  
                });
            }
 
            /*
             * Vide le champ d'ajout de jeu
             */
            function clearAddGameField(){
                var addGameTxtFld = document.getElementById("addGameTxtFld");
                addGameTxtFld.value = '';
            }

            function clearAddCodeField(){ 
                var addCodeTxtFld = document.getElementById("addCodeTxtFld");
                addCodeTxtFld.value = '';
                var addDescTxtFld = document.getElementById("addDescTxtFld");
                addDescTxtFld.value = '';
            }

            /*
             * Permet de rajouter un jeu dans la base
             */
            function addGame(){
                var selectConsole = document.getElementById("typeConsole"); 
                var addGameTxtFld = document.getElementById("addGameTxtFld");

                console.log("select value :" + selectConsole.value) ;
                console.log("addGameTxtFld :" + addGameTxtFld.value) ;

                $.ajax({type: 'POST',  
                        url: 'add_game.php', 
                        data: { game_fk_console: selectConsole.value,
                                game_name: addGameTxtFld.value },
                        success: function(response) {
                            console.log(response);
                            if('success' === response){
                                document.getElementById("addGameAck").style.visibility='visible';
                                setTimeout(function() {
                                    document.getElementById("addGameAck").style.visibility='hidden';
                                }, 1000); // <-- time in milliseconds
                            }else{
                                document.getElementById("addGameWrong").style.visibility='visible';
                                setTimeout(function() {
                                    document.getElementById("addGameWrong").style.visibility='hidden';
                                }, 1000); // <-- time in milliseconds
                            }
                    }
                });

                clearAddGameField();
            }

            /*
             *
             */
            function addCode(){
                var selectedGame = document.getElementById("selectGame");
                var addCodeTxtFld = document.getElementById("addCodeTxtFld");
                var addDescTxtFld = document.getElementById("addDescTxtFld");

                console.log(selectedGame.value);
                console.log(addCodeTxtFld.value);
                console.log(addDescTxtFld.value);

                $.ajax({type: 'POST',  
                        url: 'add_code.php', 
                        data: { code_code: addCodeTxtFld.value,
                                code_desc: addDescTxtFld.value,
                                code_fk_game: selectedGame.value },
                        success: function(response) {
                            console.log(response);
                            if('success' === response){
                                document.getElementById("addCodeAck").style.visibility='visible';
                                setTimeout(function() {
                                    document.getElementById("addCodeAck").style.visibility='hidden';
                                }, 1000); // <-- time in milliseconds
                            }else{
                                document.getElementById("addCodeWrong").style.visibility='visible';
                                setTimeout(function() {
                                    document.getElementById("addCodeWrong").style.visibility='hidden';
                                }, 1000); // <-- time in milliseconds
                            }
                    }
                });

                clearAddCodeField();
            }

            /*
             *
             */
            function selectConsole(myValue) {
                
                console.log("select console :" + myValue.value);
                console.log("id :" + myValue.id);

                $.ajax({type: "POST",
                        url: 'getGamesById.php',                            
                        data: { game_fk_console: myValue.value },                        
                        dataType: 'json',                     
                        success: function(data)         
                        {  
                            console.log("results :")
                            var results = data.result ;
                            console.log(results);
                            var comboBoxPersoInterview = document.getElementById("selectGame");

                            for (var i=document.getElementById("selectGame").options.length; i-->0;)
                                document.getElementById("selectGame").options[i] = null;

                            var optionMedia = document.createElement('option');
                            optionMedia.text= "<Selectionner un jeu>";
                            optionMedia.selected = true ;
                            comboBoxPersoInterview.appendChild(optionMedia);
                            
                            // todo il faut reseter la valeur selectionner
                            for (var i = 0; i < results.length; i++) {
                                var option = document.createElement('option');
                                option.value=results[i].game_id;
                                option.text= results[i].game_name;
                                comboBoxPersoInterview.appendChild(option);
                            }               
                        }  
                }); 
            }

            /**
             * Fonction sur la selection des jeux
             */
            function selectAGame(myValue){
                
                console.log("selectAGame");
                console.log("id value :" + myValue.value);

                $.ajax({type: "POST",
                        url: 'get_codes_by_game_id.php',                            
                        data: { code_fk_game: myValue.value },                        
                        dataType: 'json',                     
                        success: function(data)         
                        {  
                            console.log("selectAGame results :");
                            var results = data.result ;
                            console.log(results);             

                            displayCodes(data);
                        }  
                }); 
            } 

            /**
             * code_id	code_code	code_desc	code_fk_game tbodyCodeList
             */
            function displayCodes(codes){

                var codeResults = codes.result ;
                console.log("results :");
                console.log(results);
                            
                var results = codeResults ;

                var tbodyCodeList = document.getElementById("tbodyCodeList");
                while(tbodyCodeList.hasChildNodes()) // On efface le tbody
                {
                    tbodyCodeList.removeChild(tbodyCodeList.firstChild);
                }
                for (var i = 0; i < results.length; i++) {
                    var option   = document.createElement('tr');
                    var tdId     = document.createElement('td');
                    var tdCode   = document.createElement('td');
                    var tdDesc   = document.createElement('td');
                    var tdFkGame = document.createElement('td');

                    var id     = document.createTextNode(results[i].code_id);
                    var code   = document.createTextNode(results[i].code_code);
                    var desc   = document.createTextNode(results[i].code_desc);
                    var fkGame = document.createTextNode(results[i].code_fk_game);
                    
                    tdId.appendChild(id);
                    tdCode.appendChild(code);
                    tdDesc.appendChild(desc);
                    tdFkGame.appendChild(fkGame);

                    option.appendChild(tdId);
                    option.appendChild(tdCode);
                    option.appendChild(tdDesc);
                    option.appendChild(tdFkGame);
                    tbodyCodeList.appendChild(option);
                }
            }
        </script>
    </body>
</html> 
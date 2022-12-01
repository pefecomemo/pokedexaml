<?php

require_once("./lib/ConsomeApi.php"); 

$consomeApi = new ConsomeAPI("https://pokeapi.co/api/v2/");
$limit = 10;
$offset = $limit*(isset($_REQUEST['page']) == true ? $_REQUEST['page']: 0);
$resposta_pkmn = json_decode($consomeApi->consomeAPIcUrl("pokemon/", "GET", null, "?offset=$offset&limit=$limit"));
$page = isset($_REQUEST['page']) == true ? $_GET['page'] : 0;

$resposta_types = json_decode($consomeApi->consomeAPIcUrl("type/", "GET", null, $offset));

foreach ($resposta_types->results as $pkmn_type){
    echo '<pre>';
    var_dump($pkmn_type->name);
    var_dump($pkmn_type->id);
    echo '</pre>';
}

echo '<pre>';
    var_dump($resposta_types);
    echo '</pre>';

?>

</body>
</html>
<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mighty Pokedex</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1> Mighty Pokedex</h1>

<div style="position: relative;">

<?php
    $bg_colortype = "#fafafa";
?>

    <div style="width:auto;
                position: absolute;
                top:50%;
                left:50%;
                background-color: <?= $bg_colortype; ?>;
                padding: 2rem;
                display: flex;
                flex-direction: column; 
                align-items:stretch;
                transform: translate(-50%, 0);"
                >
        
        <?php

            $count = 1+$offset;
            $prev = $page-(1);
            $next = $page+(1);
            $html = '';
            
            if($page == null || $page == 0){
                $prev = 0;
            }
            echo '<div style="display: flex;">';
            echo '<a href="/?page='.$prev.'" alt="Previous" style="margin: 0 2rem;" class="btn-prev-next">Prev</a>';
            echo '<a href="/?page='.$next.'" alt="Next" style="margin: 0 2rem;" class="btn-prev-next">Next</a>';
            echo '</div>';
            
            foreach ($resposta_pkmn->results as $pokemon){
                
                $html .=    '<div class="pkmn-box" style="justify-content: center;">
                                <div class="pkmn-box-name">
                                    <h4>'.$pokemon->name.'</h4>
                                </div>
                                <div class="pkmn-box-img">
                                    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/'.$count.'.png" width="100">
                                </div>
                                <hr>
                            </div>
                        
                            <br />';
                        
                $count++;
                
            }
                
            echo $html;
        
        ?>    
        
    </div>
    
</div>
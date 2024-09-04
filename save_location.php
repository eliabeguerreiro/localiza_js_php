<?php
include "../conexao.php";

//header("Content-Type: application/json");


//var_dump($_SERVER);
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "";

if($contentType === "application/json"){

    $conteudo = trim(file_get_contents("php://input"));
    $dados = json_decode($conteudo, true);
    

    if(!is_array($dados)){
        http_response_code(400);
        echo json_encode(['msg' => "DEU ERRO"]);

    }else{
        
        $lokal = $dados['latitude'].$dados['longitude'];
        
        $query = "INSERT INTO pronas.lokal (localiza) VALUES 
        ('$lokal')";
        //echo($query);
        $insert = pg_query($conn, $query);
    }


}
else{
    http_response_code(400);
    echo json_encode(['msg' => "DEU ERRO"]);
}

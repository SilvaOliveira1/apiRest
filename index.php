<?php
require_once "vendor/autoload.php";

use Slim\App;
use Slim\Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new App(new Container([
    "settings" => [
        "displayErrorDetails" => true
    ]
]));

$app->post("/validar/numericos", function (Request $request, Response $response, array $args) {

    $valoresRequest = json_decode($request->getBody()->getContents(), true);

    $resultadoFinalNumerico = array();
    foreach ($valoresRequest as $valor){
        if (is_numeric($valor)){
            array_push($resultadoFinalNumerico, $valor);
        }
    }
//    var_dump($resultadoFinalNumerico);
    print_r($resultadoFinalNumerico);
});

$app->post("/validar/maior", function (Request $request, Response $response, array $args) {
    $valoresRequest = json_decode($request->getBody()->getContents(), true);

    $maiorNumero = 0;

    foreach ($valoresRequest as $valor){
        if ($valor >= $maiorNumero){
            $maiorNumero = $valor;
        }
    }

//            return $response->withJson([
//                'Maior Numero: ' => $maiorNumero
//            ]);
//    print "O maior numero é: ".$maiorNumero;
    echo "O maior numero é: ".$maiorNumero;
//    var_dump($maiorNumero);
});

$app->get("/validar/par-ou-impar/{numero}", function (Request $request, Response $response, array $args) {
    $numero = $args['numero'];
    return $response->withJson([
        "Valor Informado na URL: " => $args['numero'],
        "Resultado: " => ($numero % 2 == 0 ? "Numero Par" : "Numero Impar")
    ]);
});

$app->post("/testar/tipo-variavel", function (Request $request, Response $response, array $args) {
    $valoresRequest = json_decode($request->getBody()->getContents(), true);
    $resultaTipoVariavel = array();
    foreach ($valoresRequest as $valor){
        array_push($resultaTipoVariavel, "Valor:[ ". $valor . " ], Tipo de Variavel: [ ". gettype($valor)." ]");
    }
    print_r($resultaTipoVariavel);
//    var_dump($resultaTipoVariavel);
});

$app->run();
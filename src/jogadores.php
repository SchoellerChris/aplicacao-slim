<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/apagarJogador/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
    
        $sql = 'DELETE FROM jogador WHERE id = "'.$args['id'].'";';
        $resultSet = $conexao->query($sql);
       
         return $response->withRedirect('/home/');


    });
    $app->get('/cadastroJogador/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
    

       
        return $container->get('renderer')->render($response, 'cadastroJogador.phtml', $args);


    });
    $app->get('/editJogador/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
        
     
    
        return $container->get('renderer')->render($response, 'updateJogador.phtml', $args);


    });
    $app->post('/adicionarJogador/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
        $params = $request->getParsedBody();

        $sql = 'INSERT INTO jogador(id,nome,posicao,numero,timeID) VALUES("","'.$params['nome'].'","'.$params['posicao'].'","'.$params['numero'].'","'.$params['timeID'].'")';
        $resultSet = $conexao->query($sql);
        return $response->withRedirect('/home/');

        // Render index view
     

    });
    $app->post('/editarJogador/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
        $params = $request->getParsedBody();
        $id = $_SESSION['idJogador'];
        $resultSet = $conexao->query('UPDATE jogador SET nome = "' . $params["nome"] . '",  posicao= "' . $params["posicao"] . '", numero = ' . $params["numero"] . ', timeId='.$params['timeID'].' WHERE id = ' . $params['id'] . ';');

        return $response->withRedirect('/home/');

        // Render index view
     

    });
};

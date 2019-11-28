<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/home/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");


        // Render index view
        return $container->get('renderer')->render($response, 'homePage.phtml', $args);


    });
  
    $app->get('/tabela/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
        $sql = 'SELECT * from jogador where timeId = "'.$args['id'].'"';

        $resultSet = $conexao->query($sql);
        $args['jogadores'] = $resultSet;

        // Render index view
        return $container->get('renderer')->render($response, 'tabela.phtml', $args);


    });
};

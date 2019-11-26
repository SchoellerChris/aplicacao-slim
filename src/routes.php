<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");


        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);


    });
    $app->POST('/login/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();
        $senha = md5($params['senha']);
        $sql = 'SELECT * FROM usuario WHERE email = "'.$params['nome'].'" AND "'.$senha.'"';

        $resultSet = $conexao->query($sql);
        if (count($resultSet)==1){
            $_SESSION['login']['ehLogado'] = true;
            $_SESSION['login']['nome'] = $resultSet->nome;
            return $response->withRedirect('/home/');
            
        }
        else {
            $_SESSION['login']['ehLogado'] = false;
            return $response->withRedirect('/login/fail');
        }
        
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get('/cadastro/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");


        // Render index view
        return $container->get('renderer')->render($response, 'cadastro.phtml', $args);


    });
    $app->post('/cadastroUsuario/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        $conexao = $container->get('pdo');
        
        $params = $request->getParsedBody();
        $senha = md5($params['senha']);

        $sql = 'INSERT INTO usuario VALUES("", "'.$params['email'].'","'.$senha.'","'.$params['nome'].'")';

        $resultSet = $conexao->query($sql);



        // Render index view
        return $response->withRedirect('/');


    });


};

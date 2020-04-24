# PHP: small framework
Criação de um micro framework usando o php, aplicando as melhores praticas, psr's e desing patterns.

 - ## Instruções
    ##### clonando o projeto: `git@github.com:romulo2735/php-small-framework.git`
    
    ##### iniciando o servidor: `php -S localhost:8000`
    
    ##### rotas: `routes.php`
    
    ````php
    $app->get('/hello', function ($params) {
        return 'php small framework';
    });
        
    $app->get('/nome/{name}', function ($params) {
        return "Recebendo parametros: {$params[1]}";
    });
    ````
   
   #### URL's
    
    - rota simples: `http://localhost:8000/app.php/hello`
        - saida: `php small framework`     
    - rota com parametros: `http://localhost:8000/app.php/nome/recebendo-parametros`
        - saida: `Recebendo parametros: recebendo-parametros` 
        
    #### Pacotes:
     
     -  https://packagist.org/packages/illuminate/support: `illuminate/support`: 
     -  https://packagist.org/packages/squizlabs/php_codesniffer: `squizlabs/php_codesniffer`
     
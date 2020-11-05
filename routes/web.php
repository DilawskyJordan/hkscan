<?php
$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/hi', function() use ($router) {
	return dd($router);
});

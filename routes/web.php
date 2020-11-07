<?php
$router->get('/', function () use ($router) {
    return "Welcome to HKscan Database API.";
});
// add farms api (create farm by there id , and get farm firebase id by there id)
$router->post("requestToken", "UserController@login");
$router->group(["middleware" => 'auth:api'], function() use ($router) {
	$router->post("/farm/create", "FarmsController@create");
	$router->get("/farm/getDocumentId/{id}", "FarmsController@get");

	$router->post("/carbon/insert", "CarbonController@create");
	$router->post("/carbon/delete", "CarbonController@delete");

	$router->post("/water/create", "WaterController@create");
	$router->post("/water/delete", "WaterController@delete");

	$router->post('/temperature/create', "TemperatureController@create");
	$router->post('/temperature/delete', "TemperatureController@delete");
});

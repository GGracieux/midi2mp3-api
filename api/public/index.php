<?php 

// Define APP_ROOT and autoloader
define('APP_ROOT',dirname(__DIR__));
require APP_ROOT . '/vendor/autoload.php';
require APP_ROOT . '/lib/midi2mp3.php';

// Includes env defined constant (generated through docker image)
@require_once APP_ROOT . '/lib/const.php';

// Creates app
$app = new \Slim\App();


// ------------------------
// INFO ROUTE
// ------------------------
$app->get('/info', function ($request, $response, $args) {

    // gets API Information
    $lp = new Midi2Mp3();
    $result = $lp->info();

	// returns json response
    return $response->withJson($result,200);

});

// ------------------------
// CONVERT ROUTE
// ------------------------
$app->post('/convert', function ($request, $response, $args) {

    // Gets midiData in request
    $midiData = $request->getParsedBody()['base64MidiData'];

    // Convertion
    $lp = new Midi2Mp3();
    $result = $lp->convert($midiData);

    // retrun results
    return $response->withJson($result,200);

});

// Execution
$app->run();
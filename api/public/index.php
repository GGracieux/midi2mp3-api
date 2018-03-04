<?php 

// Définition APP_ROOT et autoloader
define('APP_ROOT',dirname(__DIR__));
require APP_ROOT . '/vendor/autoload.php';
require APP_ROOT . '/lib/midi2mp3.php';

// Instanciation de l'application
$app = new \Slim\App();


// ------------------------
// ROUTE INFO
// ------------------------
$app->get('/info', function ($request, $response, $args) {

    // Compose le message retour
	$infos = array(
		'apiName' => 'midi2mp3',
		'version'=>'1',
		'description' => 'Convertion de fichier midi en mp3',
	);

	// retourne le message
    return $response->withJson($infos,200);

});

// ------------------------
// ROUTE CONVERT
// ------------------------
$app->post('/convert', function ($request, $response, $args) {

    // Recup cnbData via la request
    $midiData = $request->getParsedBody()['base64MidiData'];
    $soundfont = $request->getParsedBody()['soundfont'];

    // Convertion
    $lp = new Midi2Mp3();
    $result = $lp->convert($midiData,$soundfont);

    // retour resultat
    return $response->withJson($result,200);

});

// Execution
$app->run();
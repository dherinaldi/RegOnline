<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/ResourceWs.php';
require __DIR__ . '/phpqrcode/qrlib.php';


// Slim Configuration
$config = array(
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
);

$app = new \Slim\App([
	'settings' => $config
]);

// Get Dependency Injection Container
$container = $app->getContainer();
//$container['notFoundHandler'] = function($c){
//	return function($request,$response) use ($c){
//		return $c['view']->render($response->withStatus(404),'404.php');
//	};
//};
// Register Twig View Helper
$container['view'] = function($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/views', [
        'cache' => false,
        'debug' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    return $view;
};
require __DIR__ .'/routes.php';
<head>
    <meta property="og:title" content="CSGO Broadcast">
    <meta property="og:description" content="Hier werden die CSGO Livestreams aufgelistet.">
    <meta property="og:image" content="https://1000logos.net/wp-content/uploads/2017/12/CSGO-Logo.png">
    <meta property="og:url" content="http://euro-travel-example.com/index.htm">

    <meta name="twitter:title" content="CSGO Broadcast">
    <meta name="twitter:description" content="Hier werden die CSGO Livestreams aufgelistet.">
    <meta name="twitter:image" content="https://1000logos.net/wp-content/uploads/2017/12/CSGO-Logo.png">
    <meta name="twitter:card" content="summary_large_image">
</head>
<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

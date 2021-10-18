<?php 

require_once approot . '/Views/auth/google/vendor/autoload.php';

$clientId = "543388865862-vv8q46fdu4i5fearlfff5dl6jr5e1al8.apps.googleusercontent.com";
$clientSecret = "YdmYfR0HYc8-g_FkA9f_u-3c";
$redirectUrlRegister = "http://localhost/Biblioteca/auth/gregister";
$redirectUrlLogin = "http://localhost/Biblioteca/auth/glogin";

//Creando la peticion cliente a google

//Para el inicio de sesion con google
$client = new Google_Client();
$client->setClientId($clientId);    
$client->setClientSecret($clientSecret);
$client->setApplicationName("SIAB");
$client->setRedirectUri($redirectUrlLogin);
$client->addScope('profile');
$client->addScope('email');

//Luego de la autenticacion, redirigirá al Login de usuario
$urlLogin = $client->createAuthUrl();


//Para el registro con Google
$clienteR = new Google_Client();
$clienteR->setClientId($clientId);
$clienteR->setClientSecret($clientSecret);
$clienteR->setApplicationName("SIAB");
$clienteR->setRedirectUri($redirectUrlRegister);
$clienteR->addScope('profile');
$clienteR->addScope('email');

//Luego de la autenticacion, redirigará al registro de usuario
$urlRegister = $clienteR->createAuthUrl();

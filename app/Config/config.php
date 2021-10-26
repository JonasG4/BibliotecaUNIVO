<?php

//Parametros de BD
define("db_host", "127.0.0.1");
define("db_user", "root");
define("db_pass","");
define("db_name","db_siab");

//???
define("KEY","holadiablo");
define("COD","AES-128-ECB");

//Ruta de la app
define("approot", dirname(dirname(__FILE__)));

//Ruta dinamica
define("urlroot", "https://ohara-siab.azurewebsites.net"); 

//Nombre del sitio
define("sitename", "Biblioteca");

//Para invocar las imagenes desde Azure Blob
define("imagenurl", "https://siab.blob.core.windows.net/imagenes/");

//Credentials
define("azurekey", "DefaultEndpointsProtocol=https;AccountName=siab;AccountKey=lwMKcvQr1zIOa412AVSdLw/shZGwxsSGQa58uXJ12HMw6t/edKcpwN6NDEOsTunrdeXrquW7LAO/zBR5ieLccQ==;EndpointSuffix=core.windows.net");

?>
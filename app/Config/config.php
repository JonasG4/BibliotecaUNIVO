<?php
//Parametros de BD

define("db_host", "db-ohara.mysql.database.azure.com");
define("db_user", "jonas@db-ohara");
define("db_pass","2874502Ed*");

//Offline
// define("db_host", "localhost");
// define("db_user", "root");
// define("db_pass","");
define("db_name","db_siab");

//???
define("KEY","holadiablo");
define("COD","AES-128-ECB");

//Ruta de la app
define("approot", dirname(dirname(__FILE__)));

//Ruta dinamica
define("urlroot", "http://localhost/Biblioteca"); 

//Nombre del sitio
define("sitename", "Biblioteca");

//Para invocar las imagenes desde Azure Blob
define("imagenurl", "https://oharasiab1.blob.core.windows.net/ohara-storage/");

//Credentials
define("azurekey", "DefaultEndpointsProtocol=https;AccountName=oharasiab1;AccountKey=U1hQyOCtqkCBJEJqUQuE6X4xa+KZQw45HMkFlyvreuqOQhUDsRTKiSSx3lvJAxVO7cOT52Lnrq3TXLFWW4aC+Q==;EndpointSuffix=core.windows.net");

?>
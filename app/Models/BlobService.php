<?php

require_once approot . '/Services/azure/vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

class BlobService {
    private $logger;
    private $blobClient;

    public function __construct(){
        // $this->logger = $logger;
        $this->blobClient = BlobRestProxy::createBlobService(azurekey);
    }

    public function allContainers(){
        try{
            $container_list = $this->blobClient->listContainers();
            return $container_list->getContainers();
        }catch (ServiceException $exception){
            $this->logger->error('Fallo al obtener todos los contenedores: '. $exception->getCode() . ':'. $exception->getMessage());
            throw $exception;
        }
    }

    public function allBlobs($container = 'ohara-storage'){
        try{
            $result = $this->blobClient->listBlobs($container);
            return $result->getBlobs();
        }catch (ServiceException $exception){
            $this->logger->error('Fallo al obtener todos los blobs: ' . $exception->getCode() . ':' . $exception->getMessage());
            throw $exception;
        }
    }

    public function upload($file, $container = 'ohara-storage'){
        try {
            $content = file_get_contents($file['tmp_name']);
            $this->blobClient->createBlockBlob($container, $file['name'], $content);
        } catch (ServiceException $exception) {
            $this->logger->error('Fallo al subir el archivo: ' . $exception->getCode() . ':' . $exception->getMessage());
            throw $exception;
        }
    }

    public function delete($blobName, $container = "ohara-storage"){
        try{
            $this->blobClient->deleteBlob($container, $blobName);
        }catch(ServiceException $exception){
            $this->logger->error('Fallo al borrar el archivo: ' . $exception->getCode() . ':' . $exception->getMessage());
            throw $exception;
        }
    }
}
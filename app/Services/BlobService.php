<?php

require_once approot . '/Services/azure/vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use Psr\Log\LoggerInterface;

class BlobService {
    private $logger;
    private $blobClient;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
        $this->blobClient = BlobRestProxy::createBlobService($_SERVER['AZURE_CONNECTION_STRING']);
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

    public function allBlobs($container = 'imagenes'){
        try{
            $result = $this->blobClient->listBlobs($container);
            return $result->getBlobs();
        }catch (ServiceException $exception){
            $this->logger->error('Fallo al obtener todos los blobs: ' . $exception->getCode() . ':' . $exception->getMessage());
            throw $exception;
        }
    }

    public function upload($file, $container = 'imagenes'){
        try {
            $content = file_get_contents($file);
            $this->blobClient->createBlockBlob($container, $file->getClientOriginalNmae(), $content);
        } catch (ServiceException $exception) {
            $this->logger->error('Fallo al subir el archivo: ' . $exception->getCode() . ':' . $exception->getMessage());
            throw $exception;
        }
    }

    public function delete($blobName, $container = "imagenes"){
        try{
            $this->blobClient->deleteBlob($container, $blobName);
        }catch(ServiceException $exception){
            $this->logger->error('Fallo al borrar el archivo: ' . $exception->getCode() . ':' . $exception->getMessage());
            throw $exception;
        }
    }
}
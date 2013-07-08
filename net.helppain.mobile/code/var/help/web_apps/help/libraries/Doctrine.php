 <?php

use Doctrine\Common\ClassLoader,
       Doctrine\Common\Annotations\AnnotationReader,
       Doctrine\ODM\MongoDB\DocumentManager,
       Doctrine\ODM\MongoDB\Mongo,
       Doctrine\ODM\MongoDB\Configuration,
      Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

class Doctrine {

    public $dm = null;

    public function __construct()
    {

        require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';

        $doctrineClassLoader = new ClassLoader('Doctrine', APPPATH.'libraries');
        $doctrineClassLoader->register();
        $entitiesClassLoader = new ClassLoader('DW', APPPATH.'models');
        $entitiesClassLoader->register();
        $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
        $proxiesClassLoader->register();


        /**
        * MongoDB handler...
        */
        $configD = new Configuration();
        $configD->setProxyDir('<<PATH_TO_MONGODB_PROXIES>>');
        $configD->setProxyNamespace('Proxies');

        $readerD = new AnnotationReader();
        $readerD->setDefaultAnnotationNamespace('Doctrine\ODM\MongoDB\Mapping\\');
        $configD->setMetadataDriverImpl(new AnnotationDriver($readerD, APPPATH.'models/<<NAMESPACE>>'));

        try { $this->dm = DocumentManager::create(new Mongo("<<MONGODB_SERVER>>"), $configD); } catch (Exception $e) { var_dump($e->getMessage()); }

    }
}
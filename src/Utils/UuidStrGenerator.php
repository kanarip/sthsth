<?php

namespace App\Utils;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Ramsey\Uuid\Uuid;

class UuidStrGenerator extends AbstractIdGenerator
{
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        $class  = $em->getClassMetadata(get_class($entity));
        //var_dump($class, TRUE);
        $entityName = $class->getName();
        //var_dump($entityName, TRUE);

        do {
            // You can use uniqid(), http://php.net/manual/en/function.uniqid.php
            $uuid = strtolower(Uuid::uuid4());

        } while ($em->find($entityName, $uuid));


        return $uuid;
    }
}

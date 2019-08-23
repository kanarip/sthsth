<?php

namespace App\Utils;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Ramsey\Uuid\Uuid;

class UuidIntGenerator extends AbstractIdGenerator
{
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        $class  = $em->getClassMetadata(get_class($entity));
        //var_dump($class, TRUE);
        $entityName = $class->getName();
        //var_dump($entityName, TRUE);

        do {
            // You can use uniqid(), http://php.net/manual/en/function.uniqid.php
            $hex = Uuid::uuid4();
            $bin = pack('h*', str_replace('-', '', $hex));
            $ids = unpack('L', $bin);

            $id = array_shift($ids);

        } while ($em->find($entityName, $id));


        return $id;
    }
}

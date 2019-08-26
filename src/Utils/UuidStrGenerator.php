<?php
/**
    A custom ID generator for Doctrine, that returns a lower-case UUID string.

    PHP Version 7.1+

    @category  PHP
    @package   App_Utils
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch
 */
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

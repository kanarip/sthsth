<?php
/**
    A custom ID generator for Doctrine, that returns a UUID-based random integer.

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

/**
    {@inheritDoc}

    PHP Version 7.1+

    @category  PHP
    @package   App_Utils
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch
 */
class UuidIntGenerator extends AbstractIdGenerator
{
    /**
        {@inheritDoc}

        @param EntityManager $em     Entity manager
        @param string        $entity Entity

        @return int
     */
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        $class  = $em->getClassMetadata(get_class($entity));
        $entityName = $class->getName();

        do {
            $hex = Uuid::uuid4();
            $bin = pack('h*', str_replace('-', '', $hex));
            $ids = unpack('L', $bin);
            $id = array_shift($ids);
        } while ($em->find($entityName, $id));

        return $id;
    }
}

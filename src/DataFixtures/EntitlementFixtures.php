<?php
/**
    Entitlement fixtures

    PHP Version 7.1+

    @category  PHP
    @package   App_DataFixtures_EntlementFixtures
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch
 */
namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\DataFixtures\AccountFixtures;
use App\DataFixtures\WalletFixtures;

//use App\DataFixtures\SkuFixtures;

// phpcs:ignore
class EntitlementFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            AccountFixtures::class,
            WalletFixtures::class,
            //SkuFixtures::class
        ];
    }

    public function load(ObjectManager $manager)
    {
    }
}

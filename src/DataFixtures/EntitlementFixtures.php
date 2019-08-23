<?php
namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\DataFixtures\AccountFixtures;
use App\DataFixtures\WalletFixtures;
//use App\DataFixtures\SkuFixtures;

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

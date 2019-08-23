<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Account;
use App\Entity\Wallet;

class AccountFixtures extends Fixture
{
    private $accounts = [
        "John Doe",
        "Jane Doe",
        "Joe Sixpack",
        "Jack Daniels",
        "James Bond",
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->accounts as $name) {
            $account = new Account();
            $account->setDisplayName($name);
            $wallet = new Wallet();
            $wallet->credit(50.00);
            $manager->persist($wallet);

            $account->addWallet($wallet);
            $manager->persist($account);
        }

        $manager->flush();
    }
}

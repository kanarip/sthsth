<?php
/**
    Stock keeping unit fixtures for testing.

    PHP Version 7.1+

    @category  PHP
    @package   App_DataFixtures_SkuFixtures
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Sku;

class SkuFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $skus = [
            'domainaccount' => [
                'title' => 'Group Manager Account',
                'description' => implode(
                    "\n",
                    [
                        "<p>A purely administrative account that always goes together with an",
                        "existing domain under your control. This account will provide you with",
                        "an <i>admin@&lt;yourdomain&gt;</i> login that does not itself provide",
                        "access to any groupware services, it is purely used to administrate",
                        "users within a domain and may even be shared between financial and",
                        "technical administration in your business. If this is your personal",
                        "domain, you would then use the Group Manager Account to set up your",
                        "actual groupware account within the domain under your name, but you can",
                        "set up as many users as you wish.</p>",
                        "<p>Cost is incurred per user in a similar fashion to the individual",
                        "accounts. Group pricing may be available upon request.</p>"
                    ]
                ),
                'cost' => 9.99,
                'enabled' => true
            ],
            'useraccount' => [
                'title' => 'Individual Account',
                'description' => implode(
                    "\n",
                    [
                        "<p>An individual account for groupware as a hosted service with strong",
                        "privacy protection. This account will enable you to use the system",
                        "choosing from a set of available generic domains and collaborate with",
                        "others in the system by allowing each other access to your groupware",
                        "folders.</p>",
                        "<p>Choose this if you are just looking for a Gmail/Outlook.com",
                        "replacement.</p>"
                    ]
                ),
                'cost' => 9.99,
                'enabled' => true
            ]
        ];

        foreach ($skus as $sku => $attrs) {
            $sku = new Sku($attrs);
            $manager->persist($sku);
        }

        $manager->flush();
    }
}

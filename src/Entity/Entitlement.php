<?php
/**
    An entitlement is an SKU taken out by an account and billed to a wallet.

    PHP Version 7.1+

    @category  PHP
    @package   App_Entity
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
    ORM definition of an Entitlement.

    PHP Version 7.1+

    @category  PHP
    @package   App_DataFixtures_EntlementFixtures
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch

    @ORM\Entity(repositoryClass="App\Repository\EntitlementRepository")
 */
class Entitlement
{
    /**
        A unique ID.

        @ORM\Id()
        @ORM\GeneratedValue(strategy="CUSTOM")
        @ORM\Column(
            type="string",
            length=32,
            name="uuid"
        )

        @ORM\CustomIdGenerator(class="App\Utils\UuidStrGenerator")
     */
    private $_UUID;

    /**
        A short title for this entitlement.

        @ORM\Column(type="string", length=255)
     */
    private $_title;

    /**
        A longer description for this entitlement.

        @ORM\Column(type="string", length=255)
     */
    private $_description;

    /**
        The cost for this entitlement after discounts.

        @ORM\Column(type="float")
     */
    private $_cost = 0.00;

    /**
        The wallet to which this entitlement is billed.

        @ORM\ManyToOne(targetEntity="Wallet")
        @ORM\JoinColumn(
            name="wallet_uuid",
            referencedColumnName="uuid"
        )
     */
    private $_wallet;

    /**
        Get this entitlements UUID.

        @return string
     */
    public function getUUID()
    {
        return $this->_UUID;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function setTitle(string $title)
    {
        $this->_title = $title;

        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription(string $description)
    {
        $this->_description = $description;

        return $this;
    }

    public function getCost()
    {
        return $this->_cost;
    }

    public function setCost(float $cost)
    {
        $this->_cost = $cost;

        return $this;
    }
}

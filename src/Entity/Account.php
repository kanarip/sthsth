<?php
/**
    An account, representing anyone and anything eligible to log in.

    PHP Version 7.1

    @category  PHP
    @package   App_Entity_Account
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://kolabnow.com
 */
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
    ORM definition of an Account

    @category  PHP
    @package   App_Entity_Account
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://kolabnow.com

    @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
        The canonical and immutable reference to this account

        @var integer

        @ORM\Id()
        @ORM\GeneratedValue(strategy="CUSTOM")
        @ORM\Column(
            type="integer",
            name="uuid"
        )

        @ORM\CustomIdGenerator(class="App\Utils\UuidIntGenerator")
     */
    private $_UUID;

    /**
        The display name for an account.

        @var string

        @ORM\Column(type="string", length=255, name="display_name")
     */
    private $_displayName;

    /**
        A collection of entitlements associated with this account.

        @var Entitlement[]

        @ORM\OneToMany(targetEntity="Entitlement", mappedBy="account")
     */
    private $_entitlements;

    /**
        Any and all wallets associated with this account.

        @var Wallet[]

        @ORM\OneToMany(targetEntity="Wallet", mappedBy="owner")
        @ORM\JoinColumn(
            name="wallet_uuid",
            referencedColumnName="uuid"
        )
     */
    private $_wallets;

    /**
        Instantiate a new account.

        @return Account
     */
    public function __construct()
    {
        $this->_entitlements = new ArrayCollection();
        $this->_wallets = new ArrayCollection();
    }

    /**
        Get the unique identifier for the account.

        @return Integer
     */
    public function getUUID()
    {
        return $this->_UUID;
    }

    /**
        Obtain the current display name of this account.

        @return string
     */
    public function getDisplayName()
    {
        return $this->_displayName;
    }

    /**
        Set the display name for this account.

        @param String $displayName The new display name.

        @return self
     */
    public function setDisplayName($displayName)
    {
        $this->_displayName = $displayName;

        return $this;
    }

    /**
        A short description

        @return Collection|Entitlement[]
     */
    public function getEntitlements(): Collection
    {
        return $this->_entitlements;
    }


    /**
        Add an entitlement to the current list of entitlements.

        @param Entitlement $entitlement The entitlement to add

        @return self
     */
    public function addEntitlement(Entitlement $entitlement)
    {
        if (!$this->_entitlements->contains($entitlement)) {
            $this->_entitlements[] = $entitlement;
            $entitlement->setAccount($this);
        }

        return $this;
    }

    /**
        Remove an entitlement.

        @param Entitlement $entitlement The entitlement to remove

        @return self
     */
    public function removeEntitlement(Entitlement $entitlement)
    {
        if ($this->_entitlements->contains($entitlement)) {
            $this->_entitlements->removeElement($entitlement);
            // set the owning side to null (unless already changed)
            if ($entitlement->getAccount() === $this) {
                $entitlement->setAccount(null);
            }
        }

        return $this;
    }

    /**
        Obtain the wallets for this account.

        @return Collection|Wallet[]
     */
    public function getWallets()
    {
        return $this->_wallets;
    }

    /**
        Add another wallet to this account.

        @param Wallet $wallet The wallet to add

        @return self
     */
    public function addWallet(Wallet $wallet)
    {
        if (!$this->_wallets->contains($wallet)) {
            $this->_wallets[] = $wallet;
            $wallet->setOwner($this);
        }

        return $this;
    }

    /**
        Remove a wallet from this account.

        @param Wallet $wallet The wallet to remove

        @todo: a wallet with credit in it should have been transferred out.

        @todo: the last wallet of an account can not be removed.

        @return self
     */
    public function removeWallet(Wallet $wallet)
    {
        if ($this->_wallets->contains($wallet)) {
            $this->_wallets->removeElement($wallet);
            // set the owning side to null (unless already changed)
            if ($wallet->getOwner() === $this) {
                $wallet->setOwner(null);
            }
        }

        return $this;
    }
}

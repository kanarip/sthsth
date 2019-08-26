<?php
/**
    A wallet contains the credit for Accounts to consume SKU as entitlements.

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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
    ORM definition of a Wallet.

    @category  PHP
    @package   App_Entity
    @author    Jeroen van Meeuwen (Kolab Systems) <vanmeeuwen@kolabsys.com>
    @author    Christian Mollekopf (Kolab Systems) <mollekopf@kolabsys.com>
    @copyright 2019 Kolab Systems AG <contact@kolabsystems.com>
    @license   GPLv3 (https://www.gnu.org/licenses/gpl.txt)
    @link      https://pxts.ch

    @ORM\Entity(repositoryClass="App\Repository\WalletRepository")
 */
class Wallet
{
    /**
        A unique ID.

        @var \String(32)

        @ORM\Id()
        @ORM\GeneratedValue(strategy="CUSTOM")
        @ORM\Column(
            type="string",
            length=32
        )

        @ORM\CustomIdGenerator(class="App\Utils\UuidStrGenerator")
     */
    private $_UUID;

    /**
        A description for the wallet.

        @var \String(128)

        @ORM\Column(type="string", length=128, nullable=true)
     */
    private $_description = "This is a wallet";

    /**
        The current balance for the wallet.

        @var float

        @ORM\Column(type="float")
     */
    private $_balance = 0.00;

    /**
        The amount in the wallet that is refundable.

        @var float

        @ORM\Column(type="float")
     */
    private $_refundable = 0.00;

    /**
        The currency for the wallet.

        @var \String(3)

        @ORM\Column(type="string", length=3)
     */
    private $_currency = 'CHF';

    /**
        The owner of the wallet. Every wallet has one owner, but an owner may have multiple
        wallets.

        @ORM\ManyToOne(targetEntity="Account", cascade={"persist"})
        @ORM\JoinColumn(
            name="account_uuid",
            referencedColumnName="uuid"
        )
     */
    private $_owner;

    /**
        Decrease the amount in this wallet by $debit.

        @param float $debit The amount to decrease the wallet balance with.

        @return self
     */
    public function debit(float $debit)
    {
        $this->_balance -= $debit;

        return $this;
    }

    /**
        Increase the amount in this wallet by $credit.

        @param float $credit The amount to increase the wallet balance with.

        @return self
     */
    public function credit(float $credit)
    {
        $this->_balance += $credit;

        return $this;
    }

    /**
        Is any of the credit refundable?

        @return bool
     */
    public function isRefundable()
    {
        $now = new \DateTime();
        $then = $now->sub(new \DateInterval('P14D'));

        return ($this->_owner->getCreated() > $then);
    }

    /**
        The UUID

        @return int
     */
    public function getUUID()
    {
        return $this->_UUID;
    }

    /**
        The current balance for the wallet.

        @return float
     */
    public function getBalance()
    {
        return $this->_balance;
    }

    /**
        Set the balance in this wallet.

        @param float $balance The amount of credit to set the balance to.

        @return self
     */
    public function setBalance(float $balance)
    {
        $this->_balance = $balance;

        return $this;
    }

    /**
        Retrieve the currency for this wallet.

        Accounts may hold multiple wallets with different currencies.

        @return string The notation used in Open Exchange Rates
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
        Set the currency for this wallet.

        Probably should not be used on wallets with a balance.

        @param string $currency The new currency for this wallet.

        @return self
     */
    public function setCurrency(string $currency)
    {
        $this->_currency = $currency;

        return $this;
    }

    /**
        Retrieve the description for this wallet.

        @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
        Set the description for the wallet.

        @param string|null $description The description

        @return self
     */
    public function setDescription(string $description = null)
    {
        $this->_description = $description;

        return $this;
    }

    /**
        Get the owner of this wallet.

        @return Account
     */
    public function getOwner()
    {
        return $this->_owner;
    }

    /**
        Set the owner of this wallet.

        @param Account $owner The new owner.

        @return self
     */
    public function setOwner(Account $owner)
    {
        $this->_owner = $owner;

        return $this;
    }
}

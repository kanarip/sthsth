<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WalletRepository")
 */
class Wallet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="string", length=32)
     * @ORM\CustomIdGenerator(class="App\Utils\UuidStrGenerator")
     */
    private $UUID;

    /**
        A description for the wallet.

        @ORM\Column(type="string", length=128, nullable=true)
     */
    private $description = "This is a wallet";

    /**
        The current balance for the wallet.

        @ORM\Column(type="float")
     */
    private $balance = 0.00;

    /**
        The amount in the wallet that is refundable.

        @ORM\Column(type="float")
     */
    private $refundable = 0.00;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $currency = 'CHF';

    /**
        @ORM\ManyToOne(targetEntity="Account", cascade={"persist"})
        @ORM\JoinColumn(name="account_uuid", referencedColumnName="uuid")
     */
    private $owner;

    public function debit($total)
    {
        $this->balance -= $total;
    }

    public function credit($credit)
    {
        $this->balance += $credit;
    }

    public function isRefundable(): ?bool
    {
        $now = new \DateTime();
        $then = $now->sub(new \DateInterval('P14D'));

        return ($this->owner->getCreated() > $then);
    }

    public function getUUID(): ?int
    {
        return $this->UUID;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOwner(): ?Account
    {
        return $this->owner;
    }

    public function setOwner(?Account $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}

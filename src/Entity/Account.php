<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="integer")
     * @ORM\CustomIdGenerator(class="App\Utils\UuidIntGenerator")
     */
    private $UUID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $displayName;

    /**
     * @ORM\OneToMany(targetEntity="Entitlement", mappedBy="account")
     */
    private $entitlements;

    /**
        @ORM\OneToMany(targetEntity="Wallet", mappedBy="owner")
        @ORM\JoinColumn(name="wallet_uuid", referencedColumnName="uuid")
     */
    private $wallets;

    public function __construct()
    {
        $this->entitlements = new ArrayCollection();
        $this->wallets = new ArrayCollection();
    }

    public function getUUID(): ?int
    {
        return $this->UUID;
    }

    public function setUUID(int $UUID): self
    {
        $this->UUID = $UUID;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return Collection|Entitlement[]
     */
    public function getEntitlements(): Collection
    {
        return $this->entitlements;
    }

    public function addEntitlement(Entitlement $entitlement): self
    {
        if (!$this->entitlements->contains($entitlement)) {
            $this->entitlements[] = $entitlement;
            $entitlement->setAccount($this);
        }

        return $this;
    }

    public function removeEntitlement(Entitlement $entitlement): self
    {
        if ($this->entitlements->contains($entitlement)) {
            $this->entitlements->removeElement($entitlement);
            // set the owning side to null (unless already changed)
            if ($entitlement->getAccount() === $this) {
                $entitlement->setAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wallet[]
     */
    public function getWallets(): Collection
    {
        return $this->wallets;
    }

    public function addWallet(Wallet $wallet): self
    {
        if (!$this->wallets->contains($wallet)) {
            $this->wallets[] = $wallet;
            $wallet->setOwner($this);
        }

        return $this;
    }

    public function removeWallet(Wallet $wallet): self
    {
        if ($this->wallets->contains($wallet)) {
            $this->wallets->removeElement($wallet);
            // set the owning side to null (unless already changed)
            if ($wallet->getOwner() === $this) {
                $wallet->setOwner(null);
            }
        }

        return $this;
    }
}

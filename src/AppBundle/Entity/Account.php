<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=5)
     */
    private $currency;

    /**
     * @var Wallet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Wallet")
     * @ORM\JoinColumn(name="wallet_id", referencedColumnName="id")
     */
    protected $wallet;

    /**
     * @var Money
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Money")
     * @ORM\JoinColumn(name="money_id", referencedColumnName="id")
     */
    protected $money;

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Account
     */
    public function setCurrency($currency): Account
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Wallet
     */
    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    /**
     * @param Wallet $wallet
     */
    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }

    /**
     * @return Money
     */
    public function getMoney(): Money
    {
        return $this->money;
    }

    /**
     * @param Money $money
     */
    public function setMoney(Money $money): void
    {
        $this->money = $money;
    }
}
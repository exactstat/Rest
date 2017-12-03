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
     * @ORM\Column(name="number", type="string", length=20)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=5, nullable=true)
     */
    private $currency = Money::NO_CURRENCY;

    /**
     * @var Wallet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Wallet", inversedBy="accounts")
     * @ORM\JoinColumn(name="wallet_id", referencedColumnName="id", nullable=true)
     */
    protected $wallet;

    /**
     * @var Money
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Money", cascade={"all"})
     * @ORM\JoinColumn(name="money_id", referencedColumnName="id")
     */
    protected $money;

    /**
     * Account constructor.
     * @param string $number
     */
    public function __construct($number = null)
    {
        $this->money = new Money();
        $this->number = \is_string($number) && (\strlen($number) > 8 && \strlen($number) < 14)
            ? $number : self::getNewCardNumber();
    }

    /**
     * @return string
     */
    protected static function getNewCardNumber(): string
    {
        return (string)random_int(11111, 99999).(string)random_int(11110, 99990);
    }

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
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
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
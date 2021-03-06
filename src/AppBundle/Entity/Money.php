<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Exception\InvalidArgumentException;

/**
 * Money
 *
 * @ORM\Table(name="money")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoneyRepository")
 */
class Money
{
    public const USD_C = 'usd';
    public const UAH_C = 'uah';
    public const EUR_C = 'eur';
    public const NO_CURRENCY = null;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="cents", type="integer")
     */
    private $cents = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=5, nullable=true)
     */
    private $currency = Money::NO_CURRENCY;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Money
     */
    public function setAmount($amount)
    {
        if (is_int($amount)) {
            $this->amount = $amount;
        }

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set cents
     *
     * @param integer $cents
     *
     * @return Money
     */
    public function setCents($cents): Money
    {
        if (is_int($cents)) {
            $this->cents = $cents;
        }

        return $this;
    }

    /**
     * Get cents
     *
     * @return int
     */
    public function getCents()
    {
        return $this->cents;
    }

    /**
     * Set currency
     * @param string $currency
     *
     * @return Money
     * @throws \Symfony\Component\Form\Exception\InvalidArgumentException
     */
    public function setCurrency($currency): Money
    {
        $allowed = [self::EUR_C, self::USD_C, self::UAH_C, self::NO_CURRENCY];
        if ($currency === null) {
            return $this;
        }
        if (!\in_array($currency, $allowed, true)) {
            throw new InvalidArgumentException('This currency is not supported');
        }

        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function resetId(): Money
    {
        $this->id = null;

        return $this;
    }
}


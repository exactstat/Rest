<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 17:05
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="card_holds")
 * @ORM\Entity()
 */
class CHD
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=254)
     */
    protected $firstName;


    /**
     * @var string
     *
     * @ORM\Column(name="second_name", type="string", length=254)
     */
    protected $secondName;


    /**
     * @var string
     *
     * @ORM\Column(name="card_number", type="string", length=16)
     */
    protected $cardNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="exp_mon", type="string", length=2)
     */
    protected $expMon;

    /**
     * @var string
     *
     * @ORM\Column(name="exp_year", type="string", length=2)
     */
    protected $expYear;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=3)
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getExpMon(): string
    {
        return $this->expMon;
    }

    /**
     * @param string $expMon
     */
    public function setExpMon(string $expMon): void
    {
        $this->expMon = $expMon;
    }

    /**
     * @return string
     */
    public function getExpYear(): string
    {
        return $this->expYear;
    }

    /**
     * @param string $expYear
     */
    public function setExpYear(string $expYear): void
    {
        $this->expYear = $expYear;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

}
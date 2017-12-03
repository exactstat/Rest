<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 17:05
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Name is invalid.",
     *      maxMessage = "Name is too long. Please provide a shorter name"
     * )
     * @ORM\Column(name="first_name", type="string", length=30)
     */
    protected $firstName;


    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Surname is invalid.",
     *      maxMessage = "Surname is too long. Please provide a shorter surname"
     * )
     * @ORM\Column(name="second_name", type="string", length=30)
     */
    protected $secondName;


    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{16}/",
     *     match=true,
     *     message="invalid card number"
     * )
     * @ORM\Column(name="card_number", type="string", length=16)
     */
    protected $cardNumber;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{2}/",
     *     match=true,
     *     message="invalid month"
     * )
     * @ORM\Column(name="exp_mon", type="string", length=2)
     */
    protected $expMon;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{2}/",
     *     match=true,
     *     message="invalid year"
     * )
     * @ORM\Column(name="exp_year", type="string", length=2)
     */
    protected $expYear;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{3}/",
     *     match=true,
     *     message="invalid card security code"
     * )
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
    public function getFirstName(): ?string
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
    public function getSecondName(): ?string
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
    public function getCardNumber(): ?string
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
    public function getExpMon(): ?string
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
    public function getExpYear(): ?string
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
    public function getCode(): ?string
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
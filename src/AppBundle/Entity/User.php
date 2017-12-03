<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 14:13
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Class User
 * @package AppBundle\Entity
 * @author Roman Senchuk frspm.roman@gmail.com
 * @author Nazar Salo <salo.nazar@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\Length(max="63")
     * @ORM\Column(name="first_name", type="string", length=63, nullable=true)
     * @JMS\Type("string")
     */
    private $firstName;

    /**
     * @var string
     * @Assert\Length(max="63")
     * @ORM\Column(name="last_name", type="string", length=63, nullable=true)
     * @JMS\Type("string")
     */
    private $lastName;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="string", nullable=true, unique=true, length=30)
     * @JMS\Type("string")
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_id", type="string", nullable=true, unique=true, length=30)
     * @JMS\Type("string")
     */
    private $passportId;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", nullable=true, unique=true, length=128)
     * @JMS\Type("string")
     */
    private $address;

    /**
     * @var Wallet
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Wallet", mappedBy="user")
     */
    protected $wallet;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Wallet
     */
    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    /**
     * @param Wallet $wallet
     */
    public function setWallet(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(?string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(?string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(?string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getPhone(): ?int
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone(?int $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPassportId(): ?string
    {
        return $this->passportId;
    }

    /**
     * @param string $passportId
     */
    public function setPassportId(?string $passportId)
    {
        $this->passportId = $passportId;
    }



}
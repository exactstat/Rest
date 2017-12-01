<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Wallet
 *
 * @ORM\Table(name="wallet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WalletRepository")
 */
class Wallet
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
     * @var User
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="wallet")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Account", mappedBy="wallet")
     */
    protected $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Wallet
     */
    public function setUser(User $user): Wallet
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAccounts(): ArrayCollection
    {
        return $this->accounts;
    }

    /**
     * @param ArrayCollection $accounts
     * @return Wallet
     */
    public function setAccounts(ArrayCollection $accounts): Wallet
    {
        $this->accounts = $accounts;

        return $this;
    }

}


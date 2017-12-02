<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 14:13
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package AppBundle\Entity
 * @author Roman Senchuk frspm.roman@gmail.com
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

}
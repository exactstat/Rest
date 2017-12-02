<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 21:00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Transfer
 * @package AppBundle\Entity
 * @author Roman Senchuk frspm.roman@gmail.com
 * @ORM\Table(name="transfers")
 * @ORM\Entity()
 */
class Transfer
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
     * @ORM\Column(name="sender_account", type="string", length=20)
     */
    protected $senderAccount;

    /**
     * @ORM\Column(name="receiver_account", type="string", length=20)
     */
    protected $receiverAccount;

    /**
     * @ORM\Column(name="purpose", type="string")
     */
    protected $purpose;

    /**
     * @var CHD
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\CHD")
     * @ORM\JoinColumn(name="card", referencedColumnName="id")
     */
    protected $chd;

    /**
     * @var Money
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Money")
     * @ORM\JoinColumn(name="money_id", referencedColumnName="id")
     */
    protected $money;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
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

    /**
     * @return mixed
     */
    public function getSenderAccount()
    {
        return $this->senderAccount;
    }

    /**
     * @param mixed $senderAccount
     */
    public function setSenderAccount($senderAccount): void
    {
        $this->senderAccount = $senderAccount;
    }

    /**
     * @return mixed
     */
    public function getReceiverAccount()
    {
        return $this->receiverAccount;
    }

    /**
     * @param mixed $receiverAccount
     */
    public function setReceiverAccount($receiverAccount): void
    {
        $this->receiverAccount = $receiverAccount;
    }

    /**
     * @return mixed
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * @param mixed $purpose
     */
    public function setPurpose($purpose): void
    {
        $this->purpose = $purpose;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return CHD
     */
    public function getChd(): CHD
    {
        return $this->chd;
    }

    /**
     * @param CHD $chd
     */
    public function setChd(CHD $chd): void
    {
        $this->chd = $chd;
    }
}

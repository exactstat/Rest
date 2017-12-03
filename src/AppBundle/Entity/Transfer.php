<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 21:00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Transfer
 * @package AppBundle\Entity
 * @author Roman Senchuk frspm.roman@gmail.com
 * @ORM\Table(name="transfers")
 * @ORM\Entity()
 */
class Transfer
{
    public const PROCESSED_STATUS = 'processed';
    public const RECEIVED_STATUS = 'received';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Regex(
     *     pattern="/^\d+$/",
     *     match=true,
     *     message="Sender Account is invalid"
     * )
     * @Assert\Length(
     *      min = 8,
     *      max = 20,
     *      minMessage = "Sender Account is invalid. Lack some numbers",
     *      maxMessage = "Sender Account is invalid. Too much numbers"
     * )
     * @ORM\Column(name="sender_account", type="string", length=20, nullable=true)
     */
    protected $senderAccount;

    /**
     * @Assert\Regex(
     *     pattern="/^\d+$/",
     *     match=true,
     *     message="Receiver Account is invalid"
     * )
     * @Assert\Length(
     *      min = 8,
     *      max = 20,
     *      minMessage = "Receiver Account is invalid. Lack some numbers",
     *      maxMessage = "Receiver Account is invalid. Too much numbers"
     * )
     * @ORM\Column(name="receiver_account", type="string", length=20, nullable=true)
     */
    protected $receiverAccount;

    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 200,
     *      minMessage = "Purpose is invalid. Provide more details",
     *      maxMessage = "Purpose is invalid. Provide less characters"
     * )
     * @ORM\Column(name="purpose", type="string")
     */
    protected $purpose;

    /**
     * @var CHD
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\CHD")
     * @ORM\JoinColumn(name="card", referencedColumnName="id", nullable=true)
     */
    protected $chd;

    /**
     * @var Money
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Money", cascade={"all"})
     * @ORM\JoinColumn(name="money_id", referencedColumnName="id")
     */
    protected $money;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=20)
     */
    protected $status = self::RECEIVED_STATUS;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
        $this->money = new Money();
    }

    /**
     * @return Money
     */
    public function getMoney(): Money
    {
        return $this->money;
    }

    /**
     * @return Transfer
     */
    public function markProcessed(): Transfer
    {
        $this->status = self::PROCESSED_STATUS;

        return $this;
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
    public function getChd(): ?CHD
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

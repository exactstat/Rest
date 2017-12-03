<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 03.12.17 18:00
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Account;
use AppBundle\Entity\Money;
use AppBundle\Entity\Transfer;
use AppBundle\Event\TransferEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TransferSubscriber implements EventSubscriberInterface
{
    public const RATE = [
        Money::USD_C => 1,
        Money::UAH_C => 0.037,
        Money::EUR_C => 1.19,
    ];

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array('received' => 'onReceive');
    }

    public function onReceive(TransferEvent $event)
    {
        $transfer = $event->getTransfer();

        $receiver = $transfer->getReceiverAccount() ?? $this->getFromCard($transfer);
        $sender = $transfer->getSenderAccount() ?? $this->getFromCard($transfer);

        $scale = $this->currencyConvertion($sender, $receiver);
    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Defines the scale for currency exchange
     * @param Account $sender
     * @param Account $receiver
     * @return int
     */
    public function currencyConvertion(Account $sender, Account $receiver): int
    {
        $senderCurrency = $sender->getCurrency();
        $receiverCurrency = $receiver->getCurrency();
        $scale = 1;
        if ($senderCurrency == $receiverCurrency) {
            return $scale;
        }

        return self::RATE[$senderCurrency] * self::RATE[$receiverCurrency];
    }

    /**
     * Get account from card
     * @param Transfer $transfer
     * @return Account
     */
    protected function getFromCard(Transfer $transfer)
    {
        $chd = $transfer->getChd();

        // we send some where
        // and receive a real account
        // Agreed with Myhailo

        $fakeAccount = new Account();
        $fakeAccount->setCurrency('USD');
        $money = clone $transfer->getMoney();
        $fakeAccount->setMoney($money->resetId());

        $this->em->persist($fakeAccount);
        $this->em->flush();

        return $fakeAccount;
    }

}
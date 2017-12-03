<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 03.12.17 18:00
 */


namespace AppBundle\EventListener;


use AppBundle\Entity\Account;
use AppBundle\Entity\Transfer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TransferSubscriber  implements EventSubscriberInterface
{
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

    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Get account from card
     * @param Transfer $transfer
     * @return Account
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function getFromCard(Transfer $transfer)
    {
        $chd = $transfer->getChd();

        // we send some where
        // and receive a real account
        // Agreed with Myhailo

        $fakeAccount =  new Account();
        $fakeAccount->setCurrency('USD');
        $money = clone $transfer->getMoney();
        $fakeAccount->setMoney($money->resetId());

        $this->em->persist($fakeAccount);
        $this->em->flush();

        return $fakeAccount;
    }
}
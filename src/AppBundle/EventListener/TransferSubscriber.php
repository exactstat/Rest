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
use AppBundle\Service\TransactionService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\InvalidArgumentException;
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
     * @var Transfer $transfer
     */
    protected $transfer;

    /**
     * @var TransactionService
     */
    protected $transactionService;

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
        $this->transfer = $event->getTransfer();

        [$receiver, $sender] = $this->resolveAccounts();

        $this->transactionService->process(
            $receiver,
            $sender,
            $this->currencyConvertion($sender, $receiver)
        );
    }

    /**
     * TransferSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     * @param TransactionService $transactionService
     */
    public function __construct(EntityManagerInterface $entityManager, TransactionService $transactionService)
    {
        $this->em = $entityManager;
        $this->transactionService = $transactionService;
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
     * @return array
     */
    protected function resolveAccounts(): array
    {
        $receiver = $this->transfer->getReceiverAccount();
        $sender = $this->transfer->getSenderAccount();

        return [$this->getAccount($receiver), $this->getAccount($sender)];
    }

    /**
     * @param $account
     * @return Account|null|object
     */
    protected function getAccount($account)
    {
        if (\is_string($account)) {
            $account = $this->em->getRepository(Account::class)->findOneBy(['number' => $account]);
        }

        if (!$account instanceof Account) {
            $account = $this->getFromCard($this->transfer);
        }

        if (!$account instanceof Account) {
            throw new InvalidArgumentException('Account is wrong');
        }

        return $account;
    }

    /**
     * Get account from card
     * @param Transfer $transfer
     * @return Account
     */
    protected function getFromCard(Transfer $transfer): Account
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
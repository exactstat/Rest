<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 03.12.17 16:10
 */

namespace AppBundle\EventListener;

use AppBundle\AppEvents;
use AppBundle\Entity\Account;
use AppBundle\Entity\Money;
use AppBundle\Entity\User;
use FOS\UserBundle\Event\TransferEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserSubscriber
 * @package AppBundle\EventListener
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class UserSubscriber implements EventSubscriberInterface
{
    public function onUserRegister(TransferEvent $event, $eventName)
    {
        /** @var User $user */
        $user = $event->getUser();
        $wallet = $user->getWallet();

        $accountUSD = new Account();
        $accountUSD->setCurrency(Money::USD_C);
        $accountUSD->getMoney()->setCurrency(Money::USD_C);
        $accountUSD->getMoney()->setAmount(0);
        $wallet->addAccount($accountUSD);

        $accountEUR = new Account();
        $accountEUR->setCurrency(Money::EUR_C);
        $accountEUR->getMoney()->setCurrency(Money::EUR_C);
        $accountEUR->getMoney()->setAmount(0);
        $wallet->addAccount($accountEUR);

        $accountUAH = new Account();
        $accountUAH->setCurrency(Money::UAH_C);
        $accountUAH->getMoney()->setCurrency(Money::UAH_C);
        $accountUAH->getMoney()->setAmount(0);
        $wallet->addAccount($accountUAH);

        $accountBonus = new Account();
        $accountBonus->setCurrency(Money::NO_CURRENCY);
        $accountBonus->getMoney()->setCurrency(Money::NO_CURRENCY);
        $accountBonus->getMoney()->setAmount(0);
        $wallet->addAccount($accountBonus);
    }

    public function onUserDisable(TransferEvent $event, $eventName)
    {
        // @todo when disable user
    }

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
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return [
            AppEvents::USER_REGISTERED => 'onUserRegister',
            AppEvents::USER_DISABLED => 'onUserDisable'
        ];
    }

}
<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Event;

use AppBundle\Entity\Transfer;
use Symfony\Component\EventDispatcher\Event;

class TransferEvent extends Event
{
    protected $transfer;

    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * @return Transfer
     */
    public function getTransfer(): Transfer
    {
        return $this->transfer;
    }

}

<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 20:23
 */

namespace AppBundle\Entity\Security;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AuthCode
 * @package AppBundle\Entity\Security
 * @author Nazar Salo <salo.nazar@gmail.com>
 *
 * @ORM\Table(name="security_authcode")
 * @ORM\Entity()
 */
class AuthCode extends BaseAuthCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $user;
}
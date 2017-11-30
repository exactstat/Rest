<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 20:21
 */

namespace AppBundle\Entity\Security;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class RefreshToken
 * @package AppBundle\Entity\Security
 * @author Nazar Salo <salo.nazar@gmail.com>
 *
 * @ORM\Table(name="security_refresh_token")
 * @ORM\Entity()
 */
class RefreshToken extends BaseRefToken
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
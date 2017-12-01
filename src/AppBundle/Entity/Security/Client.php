<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 20:13
 */

namespace AppBundle\Entity\Security;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Client
 * @package AppBundle\Entity\Security
 * @author Nazar Salo <salo.nazar@gmail.com>
 *
 * @ORM\Table(name="security_client")
 * @ORM\Entity()
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
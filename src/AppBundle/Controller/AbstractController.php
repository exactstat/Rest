<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 21:31
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class AbstractController
 * @package AppBundle\Controller
 * @author Roman Senchuk frspm.roman@gmail.com
 */
class AbstractController extends FOSRestController
{

    /**
     * @return mixed
     */
    protected function getUser()
    {
        return $this->getEm()->getRepository(User::class)->find(1);
    }

    protected function getEm()
    {
        return $this->getDoctrine()->getManager();
    }
}
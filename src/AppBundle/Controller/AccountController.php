<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 30.11.17 19:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class StudyController
 * @package Proofpilot\StudyBundle\Controller
 * @author Roman Senchuk <frspm.roman@gmail.com>
 * @Rest\RouteResource("Account")
 */
class AccountController extends FOSRestController
{
    /**
     * Get the Study
     * @Get("/accounts/{entity}", requirements={"entity" = "\d+"})
     * @ApiDoc(resource=true, description="Get the Account")
     * @View()
     * @param Request $request
     * @param Account $entity
     * @return object
     */
    public function getAction(Request $request, Account $entity)
    {
        return $this->view(array('date' => $entity));
    }

    /**
     * Get the Study
     * @Get("/accounts")
     * @ApiDoc(resource=true, description="Get all Account")
     * @View()
     * @param Request $request
     * @return object
     */
    public function cgetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();
        $accounts = $em->getRepository(Account::class)->findBy([
            'wallet' => $user->getWallet()
        ]);

        return $this->view(array('date' => $accounts));
    }



}

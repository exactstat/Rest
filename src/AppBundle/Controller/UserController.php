<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 20:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @author Nazar Salo <salo.nazar@gmail.com>
 * @Rest\RouteResource("User")
 */
class UserController extends FOSRestController
{
    /**
     * @Route("/me")
     * @ApiDoc(resource=true, description="Get current logined user")
     * @Rest\View()
     * @param Request $request
     * @return object
     */
    public function meAction(Request $request)
    {
        $user = $this->getUser();
        return $this->view(array('data' => $user));
    }
}
<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 20:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Wallet;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @author Nazar Salo <salo.nazar@gmail.com>
 * @Rest\RouteResource("User")
 */
class UserController extends AbstractController
{
    /**
     * @Get("/me")
     * @ApiDoc(resource=true, description="Get current logined user")
     * @Rest\View()
     * @param Request $request
     * @return mixed
     */
    public function meAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $wallet = $em->getRepository(Wallet::class)->findBy(
            [
                'user' => $this->getUser(),
            ]
        );

        return $this->view(array('data' => $wallet));
    }
}
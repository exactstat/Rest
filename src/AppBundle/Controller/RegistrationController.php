<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 21:08
 */

namespace AppBundle\Controller;

use AppBundle\AppEvents;
use AppBundle\Entity\User;
use FOS\OAuthServerBundle\Controller\AuthorizeController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\UserBundle\Event\TransferEvent;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegistrationController
 * @package AppBundle\Controller
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class RegistrationController extends AuthorizeController
{
    /**
     * Register new user.
     * @ApiDoc(
     *   resource=true, description="User registration",
     *   parameters={
     *      {
     *          "name" = "client_id",
     *          "dataType" = "string",
     *          "required" = true,
     *          "description" = "OAuth. Client Id."
     *      },
     *      {
     *          "name" = "client_secret",
     *          "dataType" = "string",
     *          "required" = true,
     *          "description" = "OAuth. Client secret."
     *      },
     *      {
     *          "name" = "registration",
     *          "dataType" = "object",
     *          "required" = true,
     *          "description" = "Form object."
     *      },
     *      {
     *          "name" = "registration[username]",
     *          "dataType" = "string",
     *          "required" = true,
     *          "description" = "Username."
     *      },
     *      {
     *          "name" = "registration[plainPassword]",
     *          "dataType" = "string",
     *          "required" = true,
     *          "description" = "User password."
     *      },
     *      {
     *          "name" = "registration[email]",
     *          "dataType" = "string",
     *          "required" = true,
     *          "description" = "User email."
     *      },
     *   },
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Token lifetime not expired",
     *     403 = "Token not found!",
     *     500 = "Server error!"
     *   }
     * )
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return User
     * @throws \Exception
     */
    public function registerAction(Request $request)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $data = $request->request->all();

        /** @var User $user */
        $user = $userManager->createUser();
        $user->setUsername($data['registration']['username']);
        $user->setEmail($data['registration']['email']);
        $user->setPlainPassword($data['registration']['password']);
        $user->setEnabled(true);

        $dispatcher->dispatch(AppEvents::USER_REGISTERED, new TransferEvent($user, $request));

        $userManager->updateUser($user);

        return $user;
    }
}
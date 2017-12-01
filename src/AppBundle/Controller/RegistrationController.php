<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 21:08
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\RegistrationFormType;
use FOS\OAuthServerBundle\Controller\AuthorizeController;
use FOS\RestBundle\Controller\Annotations\View;
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
        $user = new User();

        $form = $this->container->get('form.factory')->create(RegistrationFormType::class);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (0 !== strlen($user->getPlainPassword())) {
                $encoder = $this->container->get('security.password_encoder');
                $user->setPassword($encoder->encodePassword($user, $user->getPlainPassword()));
                $user->eraseCredentials();
            }
            $entityManager = $this->container->get('doctrine.orm.entity_manager');
            $entityManager->persist($user);
            $entityManager->flush();

            return $user;
        }
    }
}
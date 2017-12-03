<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 01.12.17 20:06
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use AppBundle\Util\FormErrorsHelper;
use AppBundle\Entity\Wallet;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @author Nazar Salo <salo.nazar@gmail.com>
 * @Rest\RouteResource("User")
 */
class UserController extends AbstractController
{
    /**
     * @Rest\Get("/me")
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

    /**
     * Update User.
     * @Rest\Patch("/user")
     * @ApiDoc(
     *   resource=true, description="PATCH User",
     *   input="AppBundle\Form\Type\UserType",
     *   output={
     *      "class"="AppBundle\Entity\User"
     *   },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     500 = "Returned when not edited"
     *   }
     * )
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @return object
     */
    public function patchAction(Request $request)
    {
        $entity = $this->getUser();
        /** @var FormInterface $form */
        $form = $this->container->get('form.factory')->create(
            UserType::class,
            $entity,
            ['method' => 'PATCH', 'data' => $entity, 'data_class' => get_class($entity),]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();

            return $this->view(['data' => $object]);
        } else {
            return $this->view(['errors' => FormErrorsHelper::parse($form)], Response::HTTP_BAD_REQUEST);
        }
    }
}
<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 18:10
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Money;
use AppBundle\Form\Type\MoneyType;
use AppBundle\Util\FormErrorsHelper;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TransferController
 * @package AppBundle\Controller
 * @author Roman Senchuk frspm.roman@gmail.com
 * @Rest\RouteResource("Transfer")
 */
class TransferController extends FOSRestController
{
    /**
     * @param Request $request
     * @Rest\Post("/transfer")
     * @ApiDoc(description="Create Transfer")
     * @Rest\View()
     * @return mixed
     * @throws \Exception
     */
    public function postTransfer(Request $request)
    {
        $form = $this->createForm(MoneyType::class, new Money());
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->view(
                ['errors' => FormErrorsHelper::parse($form)],
                Response::HTTP_BAD_REQUEST
            );
        }

        $data = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return $this->view(['data' => $data]);
    }
}
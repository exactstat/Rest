<?php

/*
 * Created by Roman Senchuk.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 18:10
 */

namespace AppBundle\Controller;

use AppBundle\Entity\CHD;
use AppBundle\Entity\Transfer;
use AppBundle\Form\Type\TransferType;
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
        $form = $this->createFormTransfer($request);
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->view(
                ['errors' => FormErrorsHelper::parse($form)],
                Response::HTTP_BAD_REQUEST
            );
        }
        $data = $form->getData();

        if(!$this->cardOrAccountCheck($data)){
            return $this->view(['error' => 'Provide receiver and sender']);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        $this->get('event_dispatcher')->dispatch('received', new \AppBundle\Event\TransferEvent($data));

        return $this->view(['data' => $data]);
    }

    /**
     * @param Request $request
     * @return mixed|\Symfony\Component\Form\FormInterface
     */
    protected function createFormTransfer(Request $request)
    {
        $options = $request->request->get('chd') ? ['label' => 'chd'] : [];

        return $this->createForm(TransferType::class, new Transfer(), $options);
    }

    protected function cardOrAccountCheck($data)
    {
        /** @var Transfer $data */
        $ra = $data->getReceiverAccount();
        $sa = $data->getSenderAccount();

        if ($ra || $sa) {
            $card = $data->getChd();
            if (! $card instanceof CHD) {
                return false;
            }
        }

        return true;
    }
}
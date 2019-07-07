<?php

namespace ClientBundle\Controller;

use CoreBundle\Entity\Receipt;
use CoreBundle\Form\ReceiptForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReceiptController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function listAction()
    {
        $receipts = $this
            ->get('core.manager.receipt')
            ->getAll();

        $amount = $this
            ->get('core.manager.receipt')
            ->getAll();

        $totalAmount = 0;
        foreach($amount as $a) {
            $totalAmount += (float)$a->getAmount();
        }

        return $this->render('@Client/Pages/Receipt/list.html.twig',
            [
                'receipts' => $receipts,
                'amount' => $totalAmount
            ]
        );
    }

    /**
     * @param $slugId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function editAction($slugId) {

        $formEdit = $this->createForm(
            ReceiptForm::class,
            new Receipt()
        );

        $amount = $this
            ->get('core.manager.receipt')
            ->getAll();

        $totalAmount = 0;
        foreach($amount as $a) {
            $totalAmount += (float)$a->getAmount();
        }

        return $this->render('@Client/Pages/Receipt/edit.html.twig',
            [
                'formEdit' => $formEdit->createView(),
                'amount' => $totalAmount
            ]
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function insertAction()
    {
        $formCreate = $this->createForm(
            ReceiptForm::class,
            new Receipt()
        );

        $amount = $this
            ->get('core.manager.receipt')
            ->getAll();

        $totalAmount = 0;
        foreach($amount as $a) {
            $totalAmount += (float)$a->getAmount();
        }

        return $this->render('@Client/Pages/Receipt/insert.html.twig',
            [
                'formCreate' => $formCreate->createView(),
                'amount' => $totalAmount
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @throws \Exception
     */
    public function addAction(Request $request)
    {
        if($request->getMethod() === 'POST') {
            $receipt = new Receipt();

            $formCreate = $this->createForm(
                ReceiptForm::class,
                $receipt
            )->handleRequest($request);

            $amount = $this
                ->get('core.manager.receipt')
                ->getAll();

            $totalAmount = 0;
            foreach($amount as $a) {
                $totalAmount += (float)$a->getAmount();
            }

            if($formCreate->isSubmitted() && $formCreate->isValid()) {
                try {
                    $this
                        ->get('core.manager.receipt')
                        ->setReceipt($receipt)
                        ->create()
                        ->save();
                    $this->addFlash(
                        'success',
                        "You've successfully added a product."
                    );
                    $redirection = $this->redirectToRoute('client_receipt_insert');
                } catch(\Exception $e) {
                    $this->addFlash(
                        'error',
                        "There's an error occured."
                    );

                    $redirection = $this->redirectToRoute(
                        'client_receipt_insert'
                    );
                }

                return $redirection;
            }
            return $this->render(
                '@Client/Pages/Receipt/insert.html.twig',
                [
                    'formCreate' => $formCreate->createView(),
                    'amount' => $totalAmount
                ]
            );
        }
        return $this->createNotFoundException();
    }

    public function deleteAction($slugId) {

    }

    public function viewAction($slugId) {

    }
}

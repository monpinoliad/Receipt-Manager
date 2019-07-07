<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function dashboardAction()
    {

        $amount = $this
            ->get('core.manager.receipt')
            ->getAll();

        $totalAmount = 0;
        foreach($amount as $a) {
            $totalAmount += (float)$a->getAmount();
        }

        return $this->render('@Client/Pages/Dashboard/index.html.twig',
            [
                'amount' => $totalAmount
            ]
        );
    }
}

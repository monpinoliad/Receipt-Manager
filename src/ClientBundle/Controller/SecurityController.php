<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('client_dashboard'));
        }
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('@Client/Pages/Security/index.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    public function logoutAction()
    {
        $this->get('request')->getSession()->invalidate();
    }
}

<?php
namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {
        $response = parent::loginAction($request);
        return $response;
    }

    // if user is logged in, cannot access to login page !!!
    protected function renderLogin(array $data)
    {
        if (true === $this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            return new RedirectResponse($this->container->get('router')->generate('live'));
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Security:login.html.twig', $data);
    }
}
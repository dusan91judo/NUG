<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     */
    public function showAction()
    {
        return $this->render(
            'AppBundle:admin:index.html.twig'
        );
    }
}
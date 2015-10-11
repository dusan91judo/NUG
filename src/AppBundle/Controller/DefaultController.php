<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request)
    {
        return $this->render(
            'AppBundle:index:index.html.twig'
        );
    }

    /**
     * @Route("/live", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|fr"
     * })
     */
    public function indexAction(Request $request)
    {
        var_dump($this->get('request')->getLocale());
        $translated = $this->get('translator')->trans('symfony.is.great');
        var_dump($translated);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/trt", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|fr"
     * })
     */
    public function trtAction()
    {
        return $this->render(
            'AppBundle:trt:index.html.twig'
        );
    }


}

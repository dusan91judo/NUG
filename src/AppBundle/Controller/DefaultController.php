<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Test;
use AppBundle\Form\Type\TestType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     * @Method({"GET"})
     */
    public function homeAction(Request $request)
    {
        return $this->render(
            'AppBundle:index:index.html.twig'
        );
    }

    /**
     * @Route("/live", name="live", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
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
     *    "_locale": "en|sr"
     * })
     */
    public function trtAction()
    {
        return $this->render(
            'AppBundle:trt:index.html.twig'
        );
    }

    /**
     * @Route("/test/add", name="addTest", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     * @Method({"GET", "POST"})
     */
    public function addTestAction(Request $request)
    {
        $test = new Test();
        $testForm = $this->createForm(new TestType(), $test);

        if ($request->isMethod('POST'))
        {
            $testForm->submit($request->request->get($testForm->getName()));

            if($testForm->isValid())
            {
                $testFormData = $testForm->getData();
                var_dump($testFormData);
            }
        }

        return $this->render(
            'AppBundle:trt:addTest.html.twig', array(
                'form' => $testForm->createView(),
            )
        );
    }
}

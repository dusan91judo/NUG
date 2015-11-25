<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Topic;
use AppBundle\Form\Type\TopicType;
use Symfony\Component\HttpFoundation\Request;

class TopicController extends Controller
{
    public function showTopicAction(){}

    /**
     * @Route("/topic/add", name="addTopic", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     */
    public function addTopicAction(Request $request)
    {
        $topic = new Topic();
        $topicForm = $this->createForm(new TopicType(),$topic);

        if ($request->isMethod('POST'))
        {
            $topicForm->submit($request->request->get($topicForm->getName()));

            if ($topicForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($topic);
                $em->flush($topic);
            }
        }

        return $this->render(
            'AppBundle:Topic:addTopic.html.twig', array(
                'form' => $topicForm->createView(),
            )
        );
    }
}
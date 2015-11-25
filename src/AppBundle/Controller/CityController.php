<?php

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Form\Type\CityType;
use CoreBundle\Interfaces\IControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;


class CityController extends Controller implements IControllerInterface
{
    /**
     * @Route("/city/show", name="show_city", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     * @Method({"GET"})
     *
     */
    public function showAction(Request $request)
    {
        $doctrine = $this->getDoctrine();

        $id = $request->get('id');
        $name = $request->get('name');

        if($id != null && $name != null)
        {
            $city = $doctrine->getRepository('AppBundle:City')->findOneBy(array('id' => $id, 'name' => $name));
            $editUrl = $this->generateUrl('edit_city', array('id' => $id, 'name' => $name));
            $deleteUrl = $this->generateUrl('delete_city', array('id' => $id, 'name' => $name));

            return $this->render(
                'AppBundle:City:showCityByID.html.twig', array(
                    'city' => $city,
                    'editUrl' => $editUrl,
                    'deleteUrl' => $deleteUrl,
                )
            );
        }

//      if (filter_var($statusActive, FILTER_VALIDATE_BOOLEAN))
//          $statusActive = true;
//      else
//          $statusActive = false;

        //return new Response($city[0]); // mora $city[0] jer iz baze dobijam Array - __toString() method mi stampa ovaj objekat !!!
        $city = $doctrine->getRepository('AppBundle:City')->findByParams();

        return $this->render(
            'AppBundle:City:showCity.html.twig', array(
                'cities' => $city,
            )
        );
    }

    /**
     * @Route("/city/add", name="add_city", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $city = new City();
        $cityForm = $this->createForm(new CityType(), $city);

        if ($request->isMethod('POST'))
        {
            $cityForm->submit($request->request->get($cityForm->getName()));
            if($cityForm->isValid())
            {
                //$cityFormData = $cityForm->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($city);
                $em->flush($city);

                return $this->redirectToRoute('home');
            }
        }

        return $this->render(
            'AppBundle:City:addCity.html.twig', array(
                'form' => $cityForm->createView(),
            )
        );
    }

    /**
     * @Route("/city/edit", name="edit_city", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     * @Method({"GET", "PUT"})
     *
     */
    public function editAction(Request $request)
    {
        $doctrine = $this->getDoctrine();

        $id = $request->get('id');
        $name = $request->get('name');

        $city = $doctrine->getRepository('AppBundle:City')->findOneBy(array('id' => $id, 'name' => $name));

        if (!$city)
        {
            throw $this->createNotFoundException(
                'No city found for id '.$id
            );
        }

        $cityForm = $this->createForm(new CityType(), $city);

        if ($request->isMethod('PUT'))
        {
            $cityForm->submit($request->request->get($cityForm->getName()));
            if($cityForm->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('home');
            }
        }

        $editUrl = $this->generateUrl('edit_city', array('id' => $id, 'name' => $name));

        return $this->render(
            'AppBundle:City:editCityByID.html.twig', array(
                'form' => $cityForm->createView(),
                'editUrl' => $editUrl,
                'city' => $city,
            )
        );
    }

    public function hideAction(Request $request)
    {
        // TODO: Implement hideAction() method.
        // stavi da City ima status_active
    }

    /**
     * @Route("/city/delete", name="delete_city", defaults={"_locale": "sr"}, requirements={
     *    "_locale": "en|sr"
     * })
     * @Method({"GET"})
     */
    public function deleteAction(Request $request)
    {
        $doctrine = $this->getDoctrine();

        $id = $request->get('id');
        $name = $request->get('name');

        //$city = $doctrine->getRepository('AppBundle:City')->findOneBy(array('id' => $id, 'name' => $name));
        $em = $this->getDoctrine()->getManager();
        $city = $em->getRepository('AppBundle:City')->findOneBy(array('id' => $id, 'name' => $name));

        if (!$city)
        {
            throw $this->createNotFoundException(
                'No city found for id '.$id
            );
        }

        return $this->redirectToRoute('show_city');
    }
}
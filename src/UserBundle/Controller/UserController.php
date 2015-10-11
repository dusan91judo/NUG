<?php
namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController{

    public function loginAction(Request $request)
    {
        $response = parent::loginAction($request);
        var_dump("DUSAN MARKOVIC");
        return $response;
    }

}
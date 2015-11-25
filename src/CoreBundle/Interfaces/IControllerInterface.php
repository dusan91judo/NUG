<?php

namespace CoreBundle\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface IControllerInterface {

    public function showAction(Request $request);

    public function addAction(Request $request);

    public function editAction(Request $request);

    public function hideAction(Request $request);

    public function deleteAction(Request $request);

}
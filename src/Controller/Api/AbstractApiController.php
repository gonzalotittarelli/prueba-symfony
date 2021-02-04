<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;


abstract class AbstractApiController extends AbstractFOSRestController
{
    protected function buildForm(string $type, $data = null, array $options = []) : FormInterface
    {
        $options = array_merge($options, [
             'csrf_protection' => false
        ]);
        return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
    }

    protected function response($data, int $status_code = Response::HTTP_OK): Response
    {
        return $this->handleView($this->view($data, $status_code));
    }
}

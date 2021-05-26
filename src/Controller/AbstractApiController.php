<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

abstract class AbstractApiController extends AbstractController
{
   protected function buildForm(string $type, $data = null, array $options = []):FormInterface
   {
       $options = array_merge($options, [
           'csrf_protection'=> false,
       ]);
       return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
   }
}

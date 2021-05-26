<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\CustomerType;
use Illuminate\Support\Facades\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractApiController
{

    public function indexAction(Request $request): Response
    {
        $customers = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->json($customers);
    }
    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(CustomerType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid())
        {
            //throw exeption
            print 'Error';
            exit;
        }
        /** @var User $customer */
        $customer = $form->getData();

        $this->getDoctrine()->getManager()->persist($customer);
        $this->getDoctrine()->getManager()->flush();


        return $this->json('');
    }
}

<?php


namespace App\Controller;

use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/api/login", name="app_json_login", methods={"POST"})
     */
    public function login(Request $request): \Symfony\Component\HttpFoundation\JsonResponse

        {
            return $this->json([

                    'user' => $this->getUser() ? $this->getUser()->getId() : null
                ]
            );
        }
       # $user = $this->getUser();

       # return $this->json([
            #'username' => $user->getUsername(),
          #  'roles' => $user->getRoles(),
          #  'name' => $user->getName()
      #  ]);


}
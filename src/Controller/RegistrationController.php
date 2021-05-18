<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\LoginFormAutenticatorAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    private $serializer;
    private $userRepository;

    public function __construct(
     UserRepository $userRepository,
     Security $security,
     SerializerInterface $serializer
  )
    {

  }
    /**
     * @Route("/register", name="app_register")
     */
    public function app(Request $request) : \Symfony\Component\HttpFoundation\JsonResponse
    {
        $jsonData = json_decode($request->getContent());
        $user = $this->userRepository->create($jsonData);

        return new JsonResponse([
            'user' => $this->serializer->serialize($user, 'json')
        ], 201);
    }
}

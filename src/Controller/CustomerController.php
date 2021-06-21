<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class CustomerController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/api/register", name="register", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function newCustomer(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        // list all the input in form
        $name = $request->get('name');
        $lastname = $request->get('lastName');
        $email = $request->get('email');
        $phoneNumber = $request->get('phoneNumber');
        $password = $request->get('password');
// set the condition - unique email
        $user = $this->userRepository->findOneBy([
            'email' => $email,
        ]);
// set an error
        if (!is_null($user)) {
            return $this->json([
                'message' => 'User already exists'
            ], \Symfony\Component\HttpFoundation\Response::HTTP_CONFLICT);
        }
// create new user
        $user = new User();
        $user->setName($name);
        $user->setLastName(($lastname));
        $user->setEmail($email);
        $user->setPhoneNumber($phoneNumber);
        // encode the password
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $password)
        );
// connect to the database and post
        $this->entityManager->persist($user);
        $this->entityManager->flush();
// return json + message
        return $this->json([ 'message' => 'Thank you for registration', 'user' => $name]);

}}

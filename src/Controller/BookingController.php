<?php
// php bin/console make:controller booking
namespace App\Controller;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BookingController extends AbstractController
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @Route("/booking", name="booking", methods={"POST"})
     * @param BookingRepository $bookingRepository
     * @param EntityManagerInterface $entityManager
     */

    public function __construct(BookingRepository $bookingRepository, EntityManagerInterface $entityManager)
    {
        $this->bookingRepository = $bookingRepository;
        $this->entityManager = $entityManager;
    }
    public function newBooking(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $date = $request->get('date');
        $user = $request->get('user');
        $service = $request->get('service');

        $booking = new Booking();
        $booking->setDate($date);
        $booking->setUser(($user));
        $booking->setService($service);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json([ 'message' => 'Thank you for booking', 'date' => $date]);
    }
}

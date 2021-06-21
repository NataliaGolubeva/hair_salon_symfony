<?php

namespace App\Controller;

use App\Entity\ServiceList;
use App\Repository\ServiceListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceListController extends AbstractController
{
    /**
     * @Route("/service/list", name="service_list")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(ServiceList::class);
        $services = $repository->findService();
        return $this->json( $services, $status = 200, $headers = [], $context = [] );
    }
}

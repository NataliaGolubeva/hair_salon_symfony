<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Appointments::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appointment_id;

    /**
     * @ORM\ManyToOne(targetEntity=ServiceList::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service_id;

    /**
     * @ORM\ManyToOne(targetEntity=Calendar::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $slot_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppointmentId(): ?Appointments
    {
        return $this->appointment_id;
    }

    public function setAppointmentId(?Appointments $appointment_id): self
    {
        $this->appointment_id = $appointment_id;

        return $this;
    }

    public function getServiceId(): ?ServiceList
    {
        return $this->service_id;
    }

    public function setServiceId(?ServiceList $service_id): self
    {
        $this->service_id = $service_id;

        return $this;
    }

    public function getSlotId(): ?Calendar
    {
        return $this->slot_id;
    }

    public function setSlotId(?Calendar $slot_id): self
    {
        $this->slot_id = $slot_id;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AttributionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AttributionRepository::class)
 */
class Attribution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"show_product", "attribution"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"show_product", "attribution"})
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"show_product", "attribution"})
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Computer::class, inversedBy="attributions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $computer;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="attributions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"show_product", "attribution"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getComputer(): ?Computer
    {
        return $this->computer;
    }

    public function setComputer(?Computer $computer): self
    {
        $this->computer = $computer;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }


    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}

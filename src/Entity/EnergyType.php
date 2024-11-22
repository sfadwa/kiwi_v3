<?php

namespace App\Entity;

use App\Repository\EnergyTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnergyTypeRepository::class)]
class EnergyType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $abbreviation = null;

    /**
     * @var Collection<int, DataEnergy>
     */
    #[ORM\OneToMany(targetEntity: DataEnergy::class, mappedBy: 'energy')]
    private Collection $dataEnergies;

    public function __construct()
    {
        $this->dataEnergies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): static
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @return Collection<int, DataEnergy>
     */
    public function getDataEnergies(): Collection
    {
        return $this->dataEnergies;
    }

    public function addDataEnergy(DataEnergy $dataEnergy): static
    {
        if (!$this->dataEnergies->contains($dataEnergy)) {
            $this->dataEnergies->add($dataEnergy);
            $dataEnergy->setEnergy($this);
        }

        return $this;
    }

    public function removeDataEnergy(DataEnergy $dataEnergy): static
    {
        if ($this->dataEnergies->removeElement($dataEnergy)) {
            // set the owning side to null (unless already changed)
            if ($dataEnergy->getEnergy() === $this) {
                $dataEnergy->setEnergy(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\PresentationTypeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PresentationTypeRepository::class)]
class PresentationType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['label'])]
    private $slug;

    /**
     * @var \DateTime
     */
    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created', type: Types::DATE_MUTABLE)]
    private $created;

    /**
     * @var \DateTime
     */
    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable]
    private $updated;

    /**
     * @var \DateTime
     */
    #[ORM\Column(name: 'content_changed', type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Gedmo\Timestampable(on: 'change', field: ['label'])]
    private $contentChanged;

    #[ORM\ManyToMany(targetEntity: PresentationSchedule::class, mappedBy: 'presentationType')]
    private Collection $presentationSchedules;

    public function __construct()
    {
        $this->presentationSchedules = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getCreated(): ?DateTime
    {
        return $this->created;
    }

    public function getUpdated(): ?DateTime
    {
        return $this->updated;
    }

    public function getContentChanged(): ?DateTime
    {
        return $this->contentChanged;
    }

    /**
     * @return Collection<int, PresentationSchedule>
     */
    public function getPresentationSchedules(): Collection
    {
        return $this->presentationSchedules;
    }

    public function addPresentationSchedule(PresentationSchedule $presentationSchedule): self
    {
        if (!$this->presentationSchedules->contains($presentationSchedule)) {
            $this->presentationSchedules->add($presentationSchedule);
            $presentationSchedule->addPresentationType($this);
        }

        return $this;
    }

    public function removePresentationSchedule(PresentationSchedule $presentationSchedule): self
    {
        if ($this->presentationSchedules->removeElement($presentationSchedule)) {
            $presentationSchedule->removePresentationType($this);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\PresentationScheduleRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PresentationScheduleRepository::class)]
class PresentationSchedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'presentationSchedulesByMainSubject')]
    private ?Subject $mainSubject = null;

    #[ORM\ManyToOne(inversedBy: 'presentationSchedulesByReferenceSubject')]
    private ?Subject $referenceSubject = null;

    #[ORM\ManyToOne(inversedBy: 'presentationSchedules')]
    private ?PresentationSubject $presentationSubject = null;

    #[ORM\ManyToMany(targetEntity: PresentationType::class, inversedBy: 'presentationSchedules')]
    private Collection $presentationType;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'presentationSchedules')]
    private Collection $tags;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $held = null;

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
    #[Gedmo\Timestampable(on: 'change', field: ['mainSubject','referenceSubject','presentationSubject'])]
    private $contentChanged;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    public function __construct()
    {
        $this->presentationType = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainSubject(): ?Subject
    {
        return $this->mainSubject;
    }

    public function setMainSubject(?Subject $mainSubject): self
    {
        $this->mainSubject = $mainSubject;

        return $this;
    }

    public function getReferenceSubject(): ?Subject
    {
        return $this->referenceSubject;
    }

    public function setReferenceSubject(?Subject $referenceSubject): self
    {
        $this->referenceSubject = $referenceSubject;

        return $this;
    }

    public function getPresentationSubject(): ?presentationSubject
    {
        return $this->presentationSubject;
    }

    public function setPresentationSubject(?presentationSubject $presentationSubject): self
    {
        $this->presentationSubject = $presentationSubject;

        return $this;
    }

    /**
     * @return Collection<int, PresentationType>
     */
    public function getPresentationType(): Collection
    {
        return $this->presentationType;
    }

    public function addPresentationType(PresentationType $presentationType): self
    {
        if (!$this->presentationType->contains($presentationType)) {
            $this->presentationType->add($presentationType);
        }

        return $this;
    }

    public function removePresentationType(PresentationType $presentationType): self
    {
        $this->presentationType->removeElement($presentationType);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getHeld(): ?\DateTimeInterface
    {
        return $this->held;
    }

    public function setHeld(\DateTimeInterface $held): self
    {
        $this->held = $held;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}

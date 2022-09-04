<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: SubjectType::class, inversedBy: 'subjects')]
    private Collection $subjectType;

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

    private int $countPresentationSubjects;

    #[ORM\OneToMany(mappedBy: 'mainSubject', targetEntity: PresentationSchedule::class)]
    private Collection $presentationSchedulesByMainSubject;

    #[ORM\OneToMany(mappedBy: 'referenceSubject', targetEntity: PresentationSchedule::class)]
    private Collection $presentationSchedulesByReferenceSubject;

    public function __construct()
    {
        $this->subjectType = new ArrayCollection();
        $this->presentationSchedulesByMainSubject = new ArrayCollection();
        $this->presentationSchedulesByReferenceSubject = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->label;
    }

    public function getCountPresentationSubjects(bool $isReference = false): int
    {
        if ($isReference){
            $count = $this->getPresentationSchedulesByReferenceSubject()->count();
        } else {
            $count = $this->getPresentationSchedulesByMainSubject()->count();
        }
        return $count;
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

    /**
     * @return Collection<int, SubjectType>
     */
    public function getSubjectType(): Collection
    {
        return $this->subjectType;
    }

    public function addSubjectType(SubjectType $subjectType): self
    {
        if (!$this->subjectType->contains($subjectType)) {
            $this->subjectType->add($subjectType);
        }

        return $this;
    }

    public function removeSubjectType(SubjectType $subjectType): self
    {
        $this->subjectType->removeElement($subjectType);

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
    public function getPresentationSchedulesByMainSubject(): Collection
    {
        return $this->presentationSchedulesByMainSubject;
    }

    public function addPresentationSchedulesByMainSubject(PresentationSchedule $presentationSchedulesByMainSubject): self
    {
        if (!$this->presentationSchedulesByMainSubject->contains($presentationSchedulesByMainSubject)) {
            $this->presentationSchedulesByMainSubject->add($presentationSchedulesByMainSubject);
            $presentationSchedulesByMainSubject->setMainSubject($this);
        }

        return $this;
    }

    public function removePresentationSchedulesByMainSubject(PresentationSchedule $presentationSchedulesByMainSubject): self
    {
        if ($this->presentationSchedulesByMainSubject->removeElement($presentationSchedulesByMainSubject)) {
            // set the owning side to null (unless already changed)
            if ($presentationSchedulesByMainSubject->getMainSubject() === $this) {
                $presentationSchedulesByMainSubject->setMainSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PresentationSchedule>
     */
    public function getPresentationSchedulesByReferenceSubject(): Collection
    {
        return $this->presentationSchedulesByReferenceSubject;
    }

    public function addPresentationSchedulesByReferenceSubject(PresentationSchedule $presentationSchedulesByReferenceSubject): self
    {
        if (!$this->presentationSchedulesByReferenceSubject->contains($presentationSchedulesByReferenceSubject)) {
            $this->presentationSchedulesByReferenceSubject->add($presentationSchedulesByReferenceSubject);
            $presentationSchedulesByReferenceSubject->setReferenceSubject($this);
        }

        return $this;
    }

    public function removePresentationSchedulesByReferenceSubject(PresentationSchedule $presentationSchedulesByReferenceSubject): self
    {
        if ($this->presentationSchedulesByReferenceSubject->removeElement($presentationSchedulesByReferenceSubject)) {
            // set the owning side to null (unless already changed)
            if ($presentationSchedulesByReferenceSubject->getReferenceSubject() === $this) {
                $presentationSchedulesByReferenceSubject->setReferenceSubject(null);
            }
        }

        return $this;
    }
}

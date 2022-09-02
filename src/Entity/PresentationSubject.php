<?php

namespace App\Entity;

use App\Repository\PresentationSubjectRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PresentationSubjectRepository::class)]
class PresentationSubject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

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

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'presentationSubject')]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'presentationSubject', targetEntity: PresentationSchedule::class)]
    private Collection $presentationSchedules;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $tag->addPresentationSubject($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removePresentationSubject($this);
        }

        return $this;
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
            $presentationSchedule->setPresentationSubject($this);
        }

        return $this;
    }

    public function removePresentationSchedule(PresentationSchedule $presentationSchedule): self
    {
        if ($this->presentationSchedules->removeElement($presentationSchedule)) {
            // set the owning side to null (unless already changed)
            if ($presentationSchedule->getPresentationSubject() === $this) {
                $presentationSchedule->setPresentationSubject(null);
            }
        }

        return $this;
    }

}

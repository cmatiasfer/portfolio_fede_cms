<?php

namespace App\Zard\CoreBundle\Entity;

use App\Zard\CoreBundle\Entity\ProjectsGallery;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Zard\CoreBundle\Entity\ProjectsRepository")
 */
class Projects
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text",nullable=true )
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $color;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $listingOrder;

    /**
     * @var projects[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="\App\Zard\CoreBundle\Entity\ProjectsGallery", mappedBy="project", cascade={"persist","remove"})
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getListingOrder(): ?string
    {
        return $this->listingOrder;
    }

    public function setListingOrder(string $listingOrder): self
    {
        $this->listingOrder = $listingOrder;

        return $this;
    }

   

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }
    
    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection|ProjectsGallery[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(ProjectsGallery $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setProject($this);
        }

        return $this;
    }

    public function removeProject(ProjectsGallery $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getProject() === $this) {
                $project->setProject(null);
            }
        }

        return $this;
    }
}
<?php

namespace App\Zard\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Zard\CoreBundle\Entity\Projects;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Zard\CoreBundle\Entity\ProjectsGalleryRepository")
 * @Vich\Uploadable
 */
class ProjectsGallery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="\App\Zard\CoreBundle\Entity\Projects", inversedBy="images")
     */
    private $projects;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainImage;

    /**
     * @Assert\File(
     *      mimeTypesMessage = "Please upload a valid format (jpg/.png)",
     *      maxSize = "30720k"
     * )
     * @Vich\UploadableField(mapping="projects_gallery", fileNameProperty="mainImage")
     * @var File
     */
    private $mainImageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageMobile;

    /**
     * @Assert\File(
     *      maxSize = "4048k"
     * )
     * @Vich\UploadableField(mapping="projects_gallery", fileNameProperty="imageMobile")
     * @var File
     */
    private $imageMobileFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $seoURL;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    private $seoDESC;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $seoTITLE;

    /**
     * @ORM\Column(type="smallint" )
     */
    private $listingOrder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isMobile;

    

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * MAIN IMAGE
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $mainImageFile
     */
    public function setMainImageFile(?File $mainImageFile = null): void
    {
        $this->mainImageFile = $mainImageFile;

        if (null !== $mainImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getMainImageFile(): ?File
    {
        return $this->mainImageFile;
    }

    public function setMainImage(?string $mainImage): void
    {
        $this->mainImage = $mainImage;
    }

    public function getMainImage(): ?string
    {
        return $this->mainImage;
    }
    
    
    public function getListingOrder(): ?int
    {
        return $this->listingOrder;
    }

    public function setListingOrder(int $listingOrder): self
    {
        $this->listingOrder = $listingOrder;

        return $this;
    }

    /**
     * COVER IMAGE
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageMobileFile
    */
    public function setImageMobileFile(?File $imageMobileFile = null): void
    {
        $this->imageMobileFile = $imageMobileFile;

        if (null !== $imageMobileFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageMobileFile(): ?File
    {
        return $this->imageMobileFile;
    }

    public function setImageMobile(?string $imageMobile): void
    {
        $this->imageMobile = $imageMobile;
    }

    public function getImageMobile(): ?string
    {
        return $this->imageMobile;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSeoURL(): ?string
    {
        return $this->seoURL;
    }

    public function setSeoURL(string $seoURL): self
    {
        $this->seoURL = $seoURL;

        return $this;
    }

    public function getSeoDESC(): ?string
    {
        return $this->seoDESC;
    }

    public function setSeoDESC(string $seoDESC): self
    {
        $this->seoDESC = $seoDESC;

        return $this;
    }

    public function getSeoTITLE(): ?string
    {
        return $this->seoTITLE;
    }

    public function setSeoTITLE(string $seoTITLE): self
    {
        $this->seoTITLE = $seoTITLE;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }
    public function getIsMobile(): ?bool
    {
        return $this->isMobile;
    }

    public function setIsMobile(bool $isMobile): self
    {
        $this->isMobile = $isMobile;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getProjects(): ?Projects
    {
        return $this->projects;
    }

    public function setProjects(?Projects $projects): self
    {
        $this->projects = $projects;

        return $this;
    }
}

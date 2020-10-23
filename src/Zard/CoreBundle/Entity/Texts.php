<?php

namespace App\Zard\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Zard\CoreBundle\Entity\TextsRepository")
 */
class Texts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120 , nullable=true)
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=120 , nullable=true)
     */
    private $variable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleEN;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    private $textEN;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleES;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    private $textES;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $seoTitle;

    /**
     * @ORM\Column(type="text", nullable=true, nullable=true)
     */
    private $seoDesc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getVariable(): ?string
    {
        return $this->variable;
    }

    public function setVariable(string $variable): self
    {
        $this->variable = $variable;

        return $this;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function setSeoTitle(?string $seoTitle): self
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    public function getSeoDesc(): ?string
    {
        return $this->seoDesc;
    }

    public function setSeoDesc(?string $seoDesc): self
    {
        $this->seoDesc = $seoDesc;

        return $this;
    }

    public function getTitleEN(): ?string
    {
        return $this->titleEN;
    }

    public function setTitleEN(?string $titleEN): self
    {
        $this->titleEN = $titleEN;

        return $this;
    }

    public function getTextEN(): ?string
    {
        return $this->textEN;
    }

    public function setTextEN(?string $textEN): self
    {
        $this->textEN = $textEN;

        return $this;
    }

    public function getTitleES(): ?string
    {
        return $this->titleES;
    }

    public function setTitleES(?string $titleES): self
    {
        $this->titleES = $titleES;

        return $this;
    }

    public function getTextES(): ?string
    {
        return $this->textES;
    }

    public function setTextES(?string $textES): self
    {
        $this->textES = $textES;

        return $this;
    }

   
}
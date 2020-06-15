<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="file")
 */
class File {

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     *  do not trust filename provided by user!!!
     */
    private $generatedName;


    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="files", fetch="EAGER")
     */
    private $project;

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    public function __construct($name)
    {
        $this->generatedName = uniqid();
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGeneratedName(): string
    {
        return $this->generatedName;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getRelPath() {
        return $this->project->getId(). $this->getName();
    }
}
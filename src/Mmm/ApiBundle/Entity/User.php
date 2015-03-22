<?php

namespace Mmm\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="createdBy", cascade={"persist"} , orphanRemoval=true)
     */
    private $createdTasks;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="assignee", cascade={"persist"} , orphanRemoval=true)
     */
    private $assignedTasks;

    /**
     * @ORM\OneToMany(targetEntity="Place", mappedBy="createdBy", cascade={"persist"} , orphanRemoval=true)
     */
    private $createdPlaces;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->createdAt = new \DateTime();
        $this->createdTasks = new ArrayCollection();
        $this->assignedTasks = new ArrayCollection();
        $this->createdPlaces = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }


    /**
     * Add createdTasks
     *
     * @param Task $createdTasks
     * @return User
     */
    public function addCreatedTask(Task $createdTasks)
    {
        $this->createdTasks[] = $createdTasks;

        return $this;
    }

    /**
     * Remove createdTasks
     *
     * @param Task $createdTasks
     */
    public function removeCreatedTask(Task $createdTasks)
    {
        $this->createdTasks->removeElement($createdTasks);
    }

    /**
     * Get createdTasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedTasks()
    {
        return $this->createdTasks;
    }

    /**
     * Add assignedTasks
     *
     * @param Task $assignedTasks
     * @return User
     */
    public function addAssignedTask(Task $assignedTasks)
    {
        $this->assignedTasks[] = $assignedTasks;

        return $this;
    }

    /**
     * Remove assignedTasks
     *
     * @param Task $assignedTasks
     */
    public function removeAssignedTask(Task $assignedTasks)
    {
        $this->assignedTasks->removeElement($assignedTasks);
    }

    /**
     * Get assignedTasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssignedTasks()
    {
        return $this->assignedTasks;
    }

    /**
     * Add createdPlaces
     *
     * @param Place $createdPlaces
     * @return User
     */
    public function addCreatedPlace(Place $createdPlaces)
    {
        $this->createdPlaces[] = $createdPlaces;

        return $this;
    }

    /**
     * Remove createdPlaces
     *
     * @param Place $createdPlaces
     */
    public function removeCreatedPlace(Place $createdPlaces)
    {
        $this->createdPlaces->removeElement($createdPlaces);
    }

    /**
     * Get createdPlaces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedPlaces()
    {
        return $this->createdPlaces;
    }
}

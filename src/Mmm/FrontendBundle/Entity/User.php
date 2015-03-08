<?php

namespace Mmm\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Mmm\FrontendBundle\Repository\UserRepository")
 * @ORM\Table(name="User")
 */
class User
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
     * @ORM\Column(name="email", type="string", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     * @Assert\NotBlank()
     *
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

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
     * @ORM\OneToMany(targetEntity="Category", mappedBy="createdBy", cascade={"persist"} , orphanRemoval=true)
     */
    private $createdCategories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->createdTasks = new ArrayCollection();
        $this->assignedTasks = new ArrayCollection();
        $this->createdCategories = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
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
     * @param \Mmm\FrontendBundle\Entity\Task $createdTasks
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
     * @param \Mmm\FrontendBundle\Entity\Task $createdTasks
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
     * @param \Mmm\FrontendBundle\Entity\Task $assignedTasks
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
     * @param \Mmm\FrontendBundle\Entity\Task $assignedTasks
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
     * Add createdCategories
     *
     * @param \Mmm\FrontendBundle\Entity\Category $createdCategories
     * @return User
     */
    public function addCreatedCategory(Category $createdCategories)
    {
        $this->createdCategories[] = $createdCategories;

        return $this;
    }

    /**
     * Remove createdCategories
     *
     * @param \Mmm\FrontendBundle\Entity\Category $createdCategories
     */
    public function removeCreatedCategory(Category $createdCategories)
    {
        $this->createdCategories->removeElement($createdCategories);
    }

    /**
     * Get createdCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatedCategories()
    {
        return $this->createdCategories;
    }
}

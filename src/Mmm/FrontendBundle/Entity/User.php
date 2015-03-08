<?php

namespace Mmm\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mmm\FrontendBundle\Entity\Task;
use Mmm\FrontendBundle\Entity\Category;

/**
 * @ORM\Entity(repositoryClass="Mmm\FrontendBundle\Repository\UserRepository")
 * @ORM\Table(name="User")
 */
class User {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string" , nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string" , nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string" , nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime" , nullable=true)
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
     * @ORM\OneToMany(targetEntity="Category", mappedBy="user", cascade={"persist"} , orphanRemoval=true)
     */
    private $createdCategories;

    public function __construct() {
        $this->createdAt = new \DateTime();
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
    public function setCreatedAt($createdAt) {
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

}

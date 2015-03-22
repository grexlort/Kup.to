<?php

namespace Mmm\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Mmm\ApiBundle\Repository\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task implements AuthorInterface
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
     * @ORM\Column(name="content", type="string" , nullable=true)
     */
    private $content;

    /**
     * @var \DateType
     * @ORM\Column(name="due_date", type="date", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $dueDate;

    /**
     * @var boolean
     * @ORM\Column(name="done", type="boolean", nullable=false)
     * @Assert\Choice(choices = {false, true})
     */
    private $done;

    /**
     * @var string
     * @ORM\Column(name="priority", type="string", nullable=false)
     * @Assert\Choice(choices = {false, true})
     */
    private $priority;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdTasks", cascade={"persist"})
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id", nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assignedTasks", cascade={"persist"})
     * @ORM\JoinColumn(name="assignee", referencedColumnName="id", nullable=false)
     */
    private $assignee;

    /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="tasks", cascade={"persist"})
     * @ORM\JoinColumn(name="place", referencedColumnName="id", nullable=false)
     */
    private $place;

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
     * Set content
     *
     * @param string $content
     * @return Task
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Task
     */
    public function setDueDate(\DateTime $dueDate) {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate() {
        return $this->dueDate;
    }

    /**
     * Set done
     *
     * @param boolean $done
     * @return Task
     */
    public function setDone($done) {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean 
     */
    public function getDone() {
        return $this->done;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Task
     */
    public function setPriority($priority) {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Task
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
     * {@inheritdoc}
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set assignee
     *
     * @param User $assignee
     * @return Task
     */
    public function setAssignee(User $assignee = null)
    {
        $this->assignee = $assignee;

        return $this;
    }

    /**
     * Get assignee
     *
     * @return User
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * Set place
     *
     * @param Place $place
     * @return Task
     */
    public function setPlace(Place $place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return Place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Is the given User the author of this Task
     *
     * @param User $user
     *
     * @return bool
     */
    public function isAuthor(User $user = null)
    {
        return $user && $user == $this->getCreatedBy();
    }
}

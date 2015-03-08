<?php

namespace Mmm\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mmm\FrontendBundle\Repository\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task {

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
     * @var date
     * @ORM\Column(name="due_date", type="date", nullable=false)
     */
    private $dueDate;

    /**
     * @var boolean
     * @ORM\Column(name="done", type="boolean", nullable=false)
     */
    private $done;

    /**
     * @var integer
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority;

    /**
     * @var date
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }
}

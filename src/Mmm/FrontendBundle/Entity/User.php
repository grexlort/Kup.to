<?php

namespace Mmm\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    public function __construct() {
        $this->createdAt = new \DateTime();
    }

}

<?php

namespace Mmm\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Mmm\FrontendBundle\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string" , nullable=true)
     */
    private $name;
}

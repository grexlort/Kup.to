<?php

namespace Mmm\ApiBundle\Entity;

interface AuthorInterface
{
    /**
     * Set createdBy
     *
     * @param \Mmm\ApiBundle\Entity\User $createdBy
     *
     * @return $this
     */
    public function setCreatedBy(User $createdBy);
}
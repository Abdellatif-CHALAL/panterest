<?php

namespace App\Entity\Traits;

/**
 * 
 */
trait Timestampable
{
    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $updateAt;
}

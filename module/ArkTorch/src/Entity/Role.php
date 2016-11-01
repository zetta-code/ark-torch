<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity;

use Doctrine\ORM\Mapping as ORM;
use TSS\Authentication\Entity\AbstractRole;

/**
 * Role
 *
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role extends AbstractRole
{
    const ADMIN = 1;
    const MEMBER = 2;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->active = true;
    }
}
<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity;

use Doctrine\ORM\Mapping as ORM;
use TSS\Authentication\Entity\AbstractCredential;

/**
 * Credential
 *
 * @ORM\Entity
 * @ORM\Table(name="credentials")
 */
class Credential extends AbstractCredential
{
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="credentials")
     * @ORM\JoinColumn(nullable=false)
     **/
    protected $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->active = true;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
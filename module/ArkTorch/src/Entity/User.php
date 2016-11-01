<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TSS\Authentication\Entity\AbstractUser;
use TSS\Authentication\Entity\CredentialInterface;
use TSS\Authentication\Entity\UserInterface;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends AbstractUser
{
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 2;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Credential", mappedBy="user", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    protected $credentials;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $role;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Inhabitant", inversedBy="users", cascade={"all"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="inhabitants_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="inhabitant_id", referencedColumnName="id")}
     *      )
     */
    protected $inhabitants;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->credentials = new ArrayCollection();
        $this->inhabitants = new ArrayCollection();
        $this->status = self::STATUS_ACTIVE;
        $this->active = true;
        $this->confirmedEmail = false;
    }

    /**
     * @return ArrayCollection
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Add credential to credentials
     *
     * @param Credential $credential
     */
    public function addCredential($credential)
    {
        $this->credentials->add($credential);
    }

    /**
     * Remove credential to credentials
     *
     * @param Credential $credential
     */
    public function removeCredential($credential)
    {
        $this->credentials->removeElement($credential);
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return ArrayCollection
     */
    public function getInhabitants()
    {
        return $this->inhabitants;
    }

    /**
     * Add inhabitant to inhabitants
     *
     * @param Inhabitant $inhabitant
     */
    public function addInhabitant($inhabitant)
    {
        $this->inhabitants->add($inhabitant);
    }

    /**
     * Remove inhabitant to inhabitants
     *
     * @param Inhabitant $inhabitant
     */
    public function removeInhabitant($inhabitant)
    {
        $this->inhabitants->removeElement($inhabitant);
    }

    /**
     * @return string
     */
    public function getRoleName()
    {
        if (!is_null($this->getRole())) {
            return $this->getRole()->getName();
        }

        return '';
    }

    public static function checkPassword(UserInterface $user, CredentialInterface $credential) {
        if ($user->getId() == $credential->getUser()->getId() && $user->isSignAllowed()) {
            return true;
        }

        return false;
    }
}
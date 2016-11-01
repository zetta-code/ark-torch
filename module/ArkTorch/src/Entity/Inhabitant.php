<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TSS\DoctrineUtil\Entity\AbstractEntity;

/**
 * Inhabitant
 *
 * @ORM\Entity(repositoryClass="ArkTorch\Entity\Repository\InhabitantRepository")
 * @ORM\Table(name="inhabitants")
 */
class Inhabitant extends AbstractEntity
{
    const TYPE_DEMIGOD = 1;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="inhabitants", fetch="EXTRA_LAZY")
     */
    protected $users;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="InhabitantStat", mappedBy="inhabitant", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    protected $inhabitantStats;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * Inhabitant constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->inhabitantStats = new ArrayCollection();
        $this->active = true;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add user to users
     *
     * @param User $user
     */
    public function addUser($user)
    {
        $this->users->add($user);
    }

    /**
     * Remove user to users
     *
     * @param User $user
     */
    public function removeUser($user)
    {
        $this->users->removeElement($user);
    }

    /**
     * @return ArrayCollection
     */
    public function getInhabitantStats()
    {
        return $this->inhabitantStats;
    }

    /**
     * Add inhabitantStat to inhabitantStats
     *
     * @param InhabitantStat $inhabitantStat
     */
    public function addInhabitant($inhabitantStat)
    {
        $this->inhabitantStats->add($inhabitantStat);
    }

    /**
     * Remove inhabitantStat to inhabitantStats
     *
     * @param InhabitantStat $inhabitantStat
     */
    public function removeInhabitantStat($inhabitantStat)
    {
        $this->inhabitantStats->removeElement($inhabitantStat);
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
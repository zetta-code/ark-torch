<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity;

use Doctrine\ORM\Mapping as ORM;
use TSS\DoctrineUtil\Entity\AbstractEntity;

/**
 * Stat
 *
 * @ORM\Entity
 * @ORM\Table(name="stats")
 */
class Stat extends AbstractEntity
{
    const TYPE_INT    = 0;
    const TYPE_BOOL   = 1;
    const TYPE_FLOAT  = 2;
    const TYPE_DOUBLE = 3;
    const TYPE_STRING = 4;

    const STAT_MAX_HP = 1;
    const STAT_HP = 2;
    const STAT_MAX_MANA = 3;
    const STAT_MANA = 4;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", nullable=false)
     */
    protected $shortName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * Configuracao constructor.
     */
    public function __construct()
    {
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
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
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
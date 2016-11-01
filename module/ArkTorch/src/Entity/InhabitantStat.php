<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity;

use Doctrine\ORM\Mapping as ORM;
use TSS\DoctrineUtil\Entity\AbstractEntity;

/**
 * InhabitantStat
 *
 * @ORM\Entity(repositoryClass="ArkTorch\Entity\Repository\InhabitantStatRepository")
 * @ORM\Table(name="inhabitant_stats")
 */
class InhabitantStat extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Inhabitant
     *
     * @ORM\ManyToOne(targetEntity="Inhabitant", inversedBy="inhabitantStats")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $inhabitant;

    /**
     * @var Stat
     *
     * @ORM\ManyToOne(targetEntity="Stat")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $stat;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $value;

    /**
     * Configuracao constructor.
     */
    public function __construct()
    {
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
     * @return Inhabitant
     */
    public function getInhabitant()
    {
        return $this->inhabitant;
    }

    /**
     * @param Inhabitant $inhabitant
     */
    public function setInhabitant($inhabitant)
    {
        $this->inhabitant = $inhabitant;
    }

    /**
     * @return Stat
     */
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * @param Stat $stat
     */
    public function setStat($stat)
    {
        $this->stat = $stat;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool|int|null|string
     */
    public function value()
    {
        switch ($this->stat->getType()) {
            case Stat::TYPE_INT:
                return intval($this->value);
                break;
            case Stat::TYPE_BOOL:
                return $this->value !== 'false';
                break;
            case Stat::TYPE_FLOAT:
                return floatval($this->value);
                break;
            case Stat::TYPE_DOUBLE:
                return doubleval($this->value);
                break;
            case Stat::TYPE_STRING:
                return $this->value;
                break;
            default:
                return null;
        }
    }
}
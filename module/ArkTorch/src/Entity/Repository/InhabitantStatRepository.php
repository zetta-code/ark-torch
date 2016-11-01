<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity\Repository;

use ArkTorch\Entity\Inhabitant;
use ArkTorch\Entity\InhabitantStat;
use ArkTorch\Entity\Stat;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityRepository;

class InhabitantStatRepository extends EntityRepository
{
    /**
     * @param Inhabitant $inhabitant
     * @param int $statId
     * @return mixed
     */
    public function get($inhabitant, $statId)
    {
        $inhabitantStat = $this->getInhabitantStat($inhabitant, $statId);

        if(!is_null($inhabitantStat)) {
            return $inhabitantStat->value();
        } else {
            return null;
        }
    }

    /**
     * @param Inhabitant $inhabitant
     * @param int $statId
     * @param mixed $value
     */
    public function put($inhabitant, $statId, $value)
    {
        $inhabitantStat = $this->getInhabitantStat($inhabitant, $statId);

        if(!is_null($inhabitantStat)) {
            $inhabitantStat->setValue($value);
        }
    }

    /**
     * @param Inhabitant $inhabitant
     * @param int $statId
     * @return InhabitantStat
     */
    public function getInhabitantStat($inhabitant, $statId)
    {
        $qb = $this->getEntityManager()->getRepository(Stat::class)->createQueryBuilder('s');
        $qb->where('s = :id AND s.active = :active');
        $qb->setParameters([
            'id' => $statId,
            'active' => true
        ]);
        $stat = $qb->getQuery()->getOneOrNullResult();

        if (!is_null($stat)) {
            $qb = $this->createQueryBuilder('es');
            $qb->where('es.stat = :stat AND es.inhabitant = :inhabitant');
            $qb->setParameters([
                'inhabitant' => $inhabitant,
                'stat' => $stat
            ]);
            $inhabitantStat = $qb->getQuery()->getOneOrNullResult();

            if (is_null($inhabitantStat)) {
                $inhabitantStat = new InhabitantStat();
                $inhabitantStat->setInhabitant($inhabitant);
                $inhabitantStat->setStat($stat);
                $this->getEntityManager()->persist($inhabitantStat);
            }
        } else {
            $inhabitantStat = null;
        }

        return $inhabitantStat;
    }

    /**
     * @param Inhabitant $inhabitant
     * @param array $stats
     * @return InhabitantStat[]
     */
    public function getInhabitantStats($inhabitant, $stats)
    {
        $qb = $this->createQueryBuilder('ist');
        $qb->where('ist.inhabitant = :inhabitant AND ist.stat IN(:stats)');
        $qb->setParameters([
            'inhabitant' => $inhabitant,
            'stats' => $stats
        ]);
        $inhabitantStats = $qb->getQuery()->getResult();

        $a = [];
        foreach ($inhabitantStats as $inhabitantStat) {
            $a[$inhabitantStat->getStat()->getId()] = $inhabitantStat;
        }

        return $a;
    }
}
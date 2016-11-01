<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Entity\Repository;

use ArkTorch\Entity\Inhabitant;
use ArkTorch\Entity\User;
use Doctrine\ORM\EntityRepository;

class InhabitantRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return Inhabitant
     */
    public function getDemigod($user)
    {
        $qb = $this->createQueryBuilder('i');
        $qb->join('i.users', 'u');
        $qb->where('u = :user AND i.type = :type AND i.active = :active');
        $qb->setParameters([
            'user' => $user,
            'type' => Inhabitant::TYPE_DEMIGOD,
            'active' => true
        ]);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
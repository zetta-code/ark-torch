<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

use ArkTorch\Entity\Stat;

return [
    'arkTorch' => [
        'stats' => [
            [
                'id' => Stat::STAT_MAX_HP,
                'type' => Stat::TYPE_INT,
                'short_name' => 'MAX_HP',
                'name' => 'Max Healing Points'
            ],
            [
                'id' => Stat::STAT_HP,
                'type' => Stat::TYPE_INT,
                'short_name' => 'HP',
                'name' => 'Healing Points'
            ],
            [
                'id' => Stat::STAT_MAX_MANA,
                'type' => Stat::TYPE_INT,
                'short_name' => 'MAX_MANA',
                'name' => 'Max Mana Points'
            ],
            [
                'id' => Stat::STAT_MANA,
                'type' => Stat::TYPE_INT,
                'short_name' => 'MANA',
                'name' => 'MANA Points'
            ],
        ]
    ]
];
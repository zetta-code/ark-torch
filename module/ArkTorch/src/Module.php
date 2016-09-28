<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}

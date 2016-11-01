<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Filter;

use ArkTorch\Filter\Fieldset\InhabitantFieldsetFilter;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\InputFilter;

class DemigodFilter extends InputFilter
{
    public function __construct(EntityManager $em, $name = 'demigod', $options = null)
    {
        $inhabitantFieldsetFilter = new InhabitantFieldsetFilter($em, $options);
        $inhabitantFieldsetFilter->get('type')->setRequired(false);
        $this->add($inhabitantFieldsetFilter, $name);
    }
}
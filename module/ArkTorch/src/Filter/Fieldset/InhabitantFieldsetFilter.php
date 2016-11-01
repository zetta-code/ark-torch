<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Filter\Fieldset;

use Doctrine\ORM\EntityManager;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Filter\ToNull;
use Zend\InputFilter\InputFilter;

class InhabitantFieldsetFilter extends InputFilter
{
    public function __construct(EntityManager $em, $name = 'inhabitant', $options = null)
    {
        $this->add([
            'name'     => 'id',
            'required' => true,
            'filters'  => [
                ['name' => ToInt::class],
            ],
        ]);

        $this->add([
            'name'     => 'type',
            'required' => true,
        ]);

        $this->add([
            'name'     => 'name',
            'required' => true,
            'filters'  => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
                ['name' => ToNull::class],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 255,
                    ],
                ],
            ]
        ]);
    }
}
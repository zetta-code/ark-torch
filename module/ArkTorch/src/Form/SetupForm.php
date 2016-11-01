<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Form;

use ArkTorch\Filter\DemigodFilter;
use ArkTorch\Form\Fieldset\InhabitantFieldset;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class SetupForm extends Form
{
    public function __construct(EntityManager $em, $name = 'setup', $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setInputFilter(new InputFilter());

        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => _('Setup'),
                'id' => $name . '-submit',
            ),
        ));

    }
}
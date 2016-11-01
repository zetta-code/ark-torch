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

class DemigodForm extends Form
{
    public function __construct(EntityManager $em, $name = 'demigod', $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form');
        $this->setInputFilter(new DemigodFilter($em, $name, $options));

        $demigodsFieldset = new InhabitantFieldset($em, $name, $options);
        $demigodsFieldset->setUseAsBaseFieldset(true);
        $this->add($demigodsFieldset);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'class' => 'btn btn-primary',
                'value' => _('Submit'),
                'id' => $name . '-submit',
            ),
        ));

    }
}
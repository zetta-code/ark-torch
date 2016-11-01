<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch\Form\Fieldset;

use ArkTorch\Entity\Inhabitant;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Fieldset;

class InhabitantFieldset extends Fieldset
{
    /**
     * DemigodFieldset constructor.
     * @param EntityManager $em
     * @param string $name
     * @param array $options
     */
    public function __construct(EntityManager $em, $name = 'inhabitant', $options = [])
    {
        parent::__construct($name, $options);

        $hidrator = new DoctrineObject($em);
        $this->setHydrator($hidrator);
        $this->setObject(new Inhabitant());

        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'name' => 'type',
            'type' => 'select',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options' => [
                'label' => _('Type'),
                'label_attributes' => ['class' => 'control-label'],
                'div' => ['class' => 'form-group', 'class_error' => 'has-error'],
                'value_options' => [
                    Inhabitant::TYPE_DEMIGOD => _('Demigod'),
                ]
            ]
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'text',
            'attributes' => [
                'class' => 'form-control',
                'placeholder' => _('Name')
            ],
            'options' => [
                'label' => _('Name'),
                'label_attributes' => ['class' => 'control-label'],
                'div' => ['class' => 'form-group', 'class_error' => 'has-error']
            ]
        ]);
    }
}
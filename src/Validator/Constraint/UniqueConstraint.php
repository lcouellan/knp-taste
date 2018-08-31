<?php


namespace App\Validator\Constraint;

use App\Validator\UniqueValidator;
use Symfony\Component\Validator\Constraint;

class UniqueConstraint extends Constraint
{
    public $field;
    public $entity;
    public $message = 'This value is already used';

    public function __construct(array $options = null)
    {
        parent::__construct($options);

        if(!array_key_exists('field', $options)) {
            throw new \InvalidArgumentException("You must provide an entity name.");
        }

        if(!array_key_exists('entity', $options)) {
            throw new \InvalidArgumentException("You must provide an entity name.");
        }

        $this->field = $options['field'];
        $this->entity = $options['entity'];
    }

    public function validatedBy()
    {
        return UniqueValidator::class;
    }
}
<?php

namespace App\Validator;

use App\Validator\Constraint\UniqueConstraint;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $value
     * @param UniqueConstraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $repository = $this->entityManager->getRepository($constraint->entity);

        if($repository->findOneBy([
            $constraint->field => $value
        ])) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
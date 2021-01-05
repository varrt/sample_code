<?php
declare(strict_types=1);

namespace App\Infrastructure\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class AdditionalSalary extends Constraint
{
    public string $message = 'For type `%s` field `%s` must be filled.';
}

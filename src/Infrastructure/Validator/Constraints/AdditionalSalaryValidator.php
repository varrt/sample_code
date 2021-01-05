<?php
declare(strict_types=1);

namespace App\Infrastructure\Validator\Constraints;

use App\Domain\ValueObject\AdditionalSalaryType;
use App\UI\Form\DTO\EmployeeDTO;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AdditionalSalaryValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): bool
    {
        /** @var EmployeeDTO $data */
        $data = $this->context->getRoot()->getData();

        if ($value == AdditionalSalaryType::CONST_TYPE && empty($data->additionAmountValue)) {
            $this->context->addViolation(sprintf($constraint->message, $value, 'additionAmountValue'));
        }

        if ($value == AdditionalSalaryType::PERCENT_TYPE && empty($data->additionPercentValue)) {
            $this->context->addViolation(sprintf($constraint->message, $value, 'additionPercentValue'));
        }

        return true;
    }
}

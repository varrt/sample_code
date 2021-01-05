<?php
declare(strict_types=1);

namespace App\Application\Projection\SalaryReport;

use App\Domain\Employee\Employee;

class ProjectionBuilder
{
    private SalaryReportProjectionRepositoryInterface $repository;

    public function __construct(SalaryReportProjectionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Employee $employee): void
    {
        $additionalAmount = $employee->getAdditionalSalary()->getAmountValue();
        if ($employee->getAdditionalSalary()->isPercent()) {
            $additionalAmount = $employee
                ->getBaseSalary()
                ->percent($employee->getAdditionalSalary()->getPercentValue());
        }
        $totalSalary = $employee->getBaseSalary()->add($additionalAmount);

        $projection = new SalaryReport(
            $employee->getId(),
            $employee->getFirstName(),
            $employee->getLastName(),
            $employee->getDepartment()->getName(),
            $employee->getBaseSalary()->getValue(),
            $employee->getAdditionalSalary()->getType()->getType(),
            $additionalAmount->getValue(),
            $totalSalary->getValue()
        );

        $this->repository->save($projection);
    }
}

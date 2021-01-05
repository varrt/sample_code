<?php
declare(strict_types=1);

namespace App\Application\Projection\SalaryReport;

interface SalaryReportProjectionRepositoryInterface
{
    public function save(SalaryReport $projection): void;
}

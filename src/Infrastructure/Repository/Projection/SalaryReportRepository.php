<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository\Projection;

use App\Application\Projection\SalaryReport\SalaryReport;
use App\Application\Projection\SalaryReport\SalaryReportProjectionRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class SalaryReportRepository extends EntityRepository implements SalaryReportProjectionRepositoryInterface
{
    public function save(SalaryReport $projection): void
    {
        $this->_em->persist($projection);
        $this->_em->flush();
    }
}

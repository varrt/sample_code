<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Employee\Employee;
use App\Domain\Employee\Repository\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class EmployeeRepository extends EntityRepository implements EmployeeRepositoryInterface
{
    public function save(Employee $employee): void
    {
        $this->_em->persist($employee);
        $this->_em->flush();
    }
}

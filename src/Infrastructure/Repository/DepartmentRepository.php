<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Department\Department;
use App\Domain\Department\Repository\DepartmentRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;

class DepartmentRepository extends EntityRepository implements DepartmentRepositoryInterface
{
    public function save(Department $department): void
    {
        $this->_em->persist($department);
        $this->_em->flush();
    }

    public function findById(UuidInterface $id): ?Department
    {
        return $this->find($id);
    }
}

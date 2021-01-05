<?php
declare(strict_types=1);

namespace App\Domain\Department\Repository;

use App\Domain\Department\Department;
use Ramsey\Uuid\UuidInterface;

interface DepartmentRepositoryInterface
{
    public function save(Department $department): void;

    public function findById(UuidInterface $id): ?Department;
}

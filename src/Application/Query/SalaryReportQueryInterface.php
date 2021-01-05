<?php
declare(strict_types=1);

namespace App\Application\Query;

interface SalaryReportQueryInterface
{
    public function list(array $filters, int $page, int $itemsPerPage, array $order = []): array;

    public function count(array $filters): int;
}

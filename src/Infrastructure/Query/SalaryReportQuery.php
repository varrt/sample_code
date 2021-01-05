<?php
declare(strict_types=1);

namespace App\Infrastructure\Query;

use App\Application\Projection\SalaryReport\SalaryReport;
use App\Application\Query\SalaryReportQueryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class SalaryReportQuery implements SalaryReportQueryInterface
{
    private EntityManagerInterface $em;

    private array $orderedFields = [
        'firstName',
        'lastName',
        'department',
        'baseSalary',
        'additionType',
        'additionalAmount',
        'totalSalary'
    ];

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function list(array $filters, int $page, int $maxPerPage, array $order = []): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('r')
            ->from(SalaryReport::class, 'r');

        $qb = $this->applyFilters($qb, $filters);

        $qb->setFirstResult(($page - 1) * $maxPerPage)
            ->setMaxResults($maxPerPage);

        if ($this->validOrder($order)) {
            $qb->orderBy("r.".$order[0], $order[1]);
        }

        return $qb->getQuery()->getArrayResult();
    }

    public function count(array $filters): int
    {
        $qb = $this->em->createQueryBuilder()
            ->select('COUNT(r.id) as total')
            ->from(SalaryReport::class, 'r');

        $qb = $this->applyFilters($qb, $filters);

        return (int)$qb->getQuery()->getSingleScalarResult();
    }

    private function applyFilters(QueryBuilder $qb, array $filters): QueryBuilder
    {
        if (isset($filters['department'])) {
            $qb->where('r.department like :department')
                ->setParameter('department', "%".$filters['department']."%");
        }
        if (isset($filters['first_name'])) {
            $qb->andWhere('r.firstName like :first_name')
                ->setParameter('first_name', "%".$filters['first_name']."%");
        }
        if (isset($filters['last_name'])) {
            $qb->andWhere('r.lastName like :last_name')
                ->setParameter('last_name', "%".$filters['last_name']."%");
        }

        return $qb;
    }

    private function validOrder(array $order): bool
    {
        return count($order) === 2 && in_array($order[0], $this->orderedFields) && in_array($order[1], ["ASC", "DESC"]);
    }
}

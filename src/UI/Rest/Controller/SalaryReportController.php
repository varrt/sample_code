<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Application\Query\SalaryReportQueryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SalaryReportController extends AbstractController
{
    /**
     * @Route("/rest/salary-report", name="app_rest_salary_report", methods={"GET"})
     */
    public function createEmployeeAction(Request $request, SalaryReportQueryInterface $query): JsonResponse
    {
        $filters = $request->get('filters', []);
        $maxPerPage = (int)$request->get('max_per_page', 10);
        $page = (int)$request->get('page', 1);
        $order = $request->get('order', []);
        
        return JsonResponse::create([
            'list' => $query->list($filters, $page, $maxPerPage, $order),
            'totalItems' => $query->count($filters)
        ]);
    }
}
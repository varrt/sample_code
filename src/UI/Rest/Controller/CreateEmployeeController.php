<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Application\Command\CreateEmployeeCommand;
use App\Domain\Exception\DepartmentNotFoundException;
use App\Domain\ValueObject\AdditionalSalary;
use App\Domain\ValueObject\AdditionalSalaryType;
use App\Domain\ValueObject\Money;
use App\UI\Form\DTO\EmployeeDTO;
use App\UI\Form\EmployeeType;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateEmployeeController extends AbstractController
{
    /**
     * @Route("/rest/create-employee", name="app_rest_create_employee", methods={"POST"})
     */
    public function createEmployeeAction(Request $request, CommandBus $commandBus): JsonResponse
    {
        $model = new EmployeeDTO();
        $form = $this->createForm(EmployeeType::class, $model);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            try {
                $commandBus->handle(new CreateEmployeeCommand(
                    Uuid::uuid4(),
                    $model->firstName,
                    $model->lastName,
                    Uuid::fromString($model->departmentId),
                    Money::create($model->baseSalary),
                    AdditionalSalary::create(
                        AdditionalSalaryType::fromString($model->additionalType),
                        Money::create($model->additionAmountValue ?? 0),
                        $model->additionPercentValue
                    )
                ));
            } catch (DepartmentNotFoundException $e) {
                return JsonResponse::create([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 422);
            }

            return JsonResponse::create(['success' => true], 201);
        }

        return JsonResponse::create([
            'success' => false,
            'errors' => $this->transformErrorsToArray($form->getErrors(true, false), [$form->getName()])
        ], 422);
    }
}

<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller;

use App\Application\Command\CreateDepartmentCommand;
use App\UI\Form\DepartmentType;
use App\UI\Form\DTO\DepartmentDTO;
use InvalidArgumentException;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateDepartmentController extends AbstractController
{
    /**
     * @Route("/rest/create-department", name="app_rest_create_department", methods={"POST"})
     */
    public function createEmployeeAction(Request $request, CommandBus $commandBus): JsonResponse
    {
        $model = new DepartmentDTO();
        $form = $this->createForm(DepartmentType::class, $model);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $commandBus->handle(new CreateDepartmentCommand(Uuid::uuid4(), $model->name));
            return JsonResponse::create(['success' => true], 201);
        }

        return JsonResponse::create([
            'success' => false,
            'errors' => $this->transformErrorsToArray($form->getErrors(true, false), [$form->getName()])
        ], 422);
    }
}
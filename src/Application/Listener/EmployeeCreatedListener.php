<?php
declare(strict_types=1);

namespace App\Application\Listener;

use App\Application\Event\EmployeeCreatedEvent;
use App\Application\Projection\SalaryReport\ProjectionBuilder;

class EmployeeCreatedListener
{
    private ProjectionBuilder $projectionBuilder;

    public function __construct(ProjectionBuilder $projectionBuilder)
    {
        $this->projectionBuilder = $projectionBuilder;
    }

    public function onEmployeeCreated(EmployeeCreatedEvent $event): void
    {
        $this->projectionBuilder->create($event->getEmployee());
    }
}

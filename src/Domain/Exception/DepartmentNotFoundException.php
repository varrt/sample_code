<?php
declare(strict_types=1);

namespace App\Domain\Exception;

use Exception;

class DepartmentNotFoundException extends Exception
{
    public function __construct(string $id)
    {
        $this->message = sprintf("Department with id `%s` not found", $id);
    }
}

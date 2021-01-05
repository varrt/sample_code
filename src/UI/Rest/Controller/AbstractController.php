<?php
declare(strict_types=1);

namespace App\UI\Rest\Controller;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormErrorIterator;

abstract class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function transformErrorsToArray(FormErrorIterator $errorIterator, array $prefixes = []): array
    {
        $errors = [];
        foreach ($errorIterator as $formError) {
            if ($formError instanceof FormErrorIterator) {
                $errors = array_merge($errors, $this->transformErrorsToArray($formError, [$formError->getForm()->getName()]));
            } elseif ($formError instanceof FormError) {
                $errors[implode('_', $prefixes)][] = $formError->getMessage();
            }
        }
        return $errors;
    }
}

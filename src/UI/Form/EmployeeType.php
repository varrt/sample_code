<?php
declare(strict_types=1);

namespace App\UI\Form;

use App\Domain\ValueObject\AdditionalSalaryType;
use App\Infrastructure\Validator\Constraints\AdditionalSalary;
use App\UI\Form\DTO\EmployeeDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Uuid;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('firstName', TextType::class, [
            'constraints' => [
                new NotBlank(),
            ],
        ]);
        $builder->add('lastName', TextType::class, [
            'constraints' => [
                new NotBlank(),
            ],
        ]);
        $builder->add('departmentId', TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Uuid()
            ],
        ]);
        $builder->add('baseSalary', IntegerType::class, [
            'constraints' => [
                new NotBlank(),
                new GreaterThanOrEqual(0)
            ],
        ]);
        $builder->add('additionPercentValue', IntegerType::class, [
            'constraints' => [
                new GreaterThanOrEqual(0),
                new LessThanOrEqual(100)
            ],
        ]);
        $builder->add('additionAmountValue', IntegerType::class, [
            'constraints' => [
                new GreaterThanOrEqual(0),
            ],
        ]);
        $builder->add('additionalType', ChoiceType::class, [
            'choices' => AdditionalSalaryType::toArray(),
            'constraints' => [
                new NotBlank(),
                new AdditionalSalary()
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeDTO::class,
            'csrf_protection' => false,
        ]);
    }
}

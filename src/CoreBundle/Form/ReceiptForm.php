<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReceiptForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'receipt_number',
                TextType::class
            )
            ->add(
                'amount',
                TextType::class
            )
            ->add(
                'shop',
                TextType::class
            )
            ->add(
                'date_issued',
                DateType::class
            )
            ->add(
                'input_by',
                TextType::class
            )
            ->add(
                'add',
                SubmitType::class
            );
    }
}
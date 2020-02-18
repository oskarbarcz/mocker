<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\Resource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourceType extends AbstractType
{
    /** @inheritDoc */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'forms.fields.label.name',
                    'help'  => 'forms.fields.help.name',
                ]
            )
            ->add(
                'slug',
                TextareaType::class,
                [
                    'required' => false,
                    'label'    => 'forms.fields.label.slug',
                    'help'     => 'forms.fields.help.slug',
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'required' => false,
                    'label'    => 'forms.fields.label.description',
                    'help'     => 'forms.fields.help.description',

                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'required' => false,
                    'label'    => 'forms.fields.label.content',
                    'help'     => 'forms.fields.help.content',
                ]
            );
    }

    /** @inheritDoc */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class'         => Resource::class,
                'translation_domain' => 'forms',
            ]
        );
    }
}

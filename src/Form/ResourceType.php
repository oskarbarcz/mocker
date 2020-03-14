<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\Resource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{TextareaType, TextType};
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
                    'label' => 'forms.fields.name.label',
                    'help'  => 'forms.fields.name.help',
                ]
            )
            ->add(
                'slug',
                TextareaType::class,
                [
                    'required' => false,
                    'label'    => 'forms.fields.slug.label',
                    'help'     => 'forms.fields.slug.help',
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'required' => false,
                    'label'    => 'forms.fields.description.label',
                    'help'     => 'forms.fields.description.help',

                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'required' => false,
                    'label'    => 'forms.fields.content.label',
                    'help'     => 'forms.fields.content.help',
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

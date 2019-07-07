<?php

namespace Crevillo\EzTinyMCEHtml\FieldType\Mapper;

use Crevillo\EzTinyMCEHtml\Form\Type\FieldType\TinyMCEHtmlBlockFieldType;
use EzSystems\RepositoryForms\Data\Content\FieldData;
use EzSystems\RepositoryForms\FieldType\Mapper\TextBlockFormMapper;
use Symfony\Component\Form\FormInterface;

class TinyMCEHtmlBlockFormMapper extends TextBlockFormMapper
{
    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $fieldDefinition = $data->fieldDefinition;
        $formConfig = $fieldForm->getConfig();

        $fieldForm
            ->add(
                $formConfig->getFormFactory()->createBuilder()
                    ->create(
                        'value',
                        TinyMCEHtmlBlockFieldType::class,
                        [
                            'required' => $fieldDefinition->isRequired,
                            'label' => $fieldDefinition->getName(),
                            'rows' => $data->fieldDefinition->fieldSettings['textRows'],
                        ]
                    )
                    ->setAutoInitialize(false)
                    ->getForm()
            );
    }
}

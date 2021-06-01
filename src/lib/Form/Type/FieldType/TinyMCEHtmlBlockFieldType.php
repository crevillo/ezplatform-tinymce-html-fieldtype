<?php

namespace Crevillo\EzTinyMCEHtml\Form\Type\FieldType;

use EzSystems\EzPlatformContentForms\FieldType\DataTransformer\FieldValueTransformer;
use EzSystems\EzPlatformContentForms\Form\Type\FieldType\TextBlockFieldType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class TinyMCEHtmlBlockFieldType extends TextBlockFieldType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new FieldValueTransformer($this->fieldTypeService->getFieldType('eztinymcehtmlblock')));
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (null !== $options['rows']) {
            $view->vars['attr'] = array_merge($view->vars['attr'], ['rows' => $options['rows']]);
        }
    }
}

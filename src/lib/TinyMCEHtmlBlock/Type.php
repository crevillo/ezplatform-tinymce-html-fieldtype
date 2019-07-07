<?php

declare(strict_types=1);

namespace Crevillo\EzTinyMCEHtml\FieldType\TinyMCEHtmlBlock;

use eZ\Publish\Core\FieldType\TextBlock\Type as TextBlockType;

class Type extends TextBlockType
{
    public function getFieldTypeIdentifier()
    {
        return 'ezhtmlblock';
    }

    /**
     * Returns the fallback default value of field type when no such default
     * value is provided in the field definition in content types.
     *
     * @return \eZ\Publish\Core\FieldType\TextBlock\Value
     */
    public function getEmptyValue()
    {
        return new Value();
    }


    /**
     * Inspects given $inputValue and potentially converts it into a dedicated value object.
     *
     * @param string|\eZ\Publish\Core\FieldType\TextBlock\Value $inputValue
     *
     * @return \eZ\Publish\Core\FieldType\TextBlock\Value The potentially converted and structurally plausible value.
     */
    protected function createValueFromInput($inputValue)
    {
        if (is_string($inputValue)) {
            $inputValue = new Value($inputValue);
        }

        return $inputValue;
    }

    /**
     * Converts an $hash to the Value defined by the field type.
     *
     * @param mixed $hash
     *
     * @return \eZ\Publish\Core\FieldType\TextBlock\Value $value
     */
    public function fromHash($hash)
    {
        if ($hash === null) {
            return $this->getEmptyValue();
        }

        return new Value($hash);
    }
}

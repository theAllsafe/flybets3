<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentIDTypeRule implements Rule
{
    private $document_type;
    private $value;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($document_type)
    {
        $this->document_type = $document_type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = $value;
        if ($this->document_type == 'national_id' && strlen($value) == 12 && is_numeric($value)) {
            return true;
        } elseif ($this->document_type == 'passport' && strlen($value) == 8) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {

        if ($this->document_type == 'national_id' && strlen($this->value) < 12)
            return 'The National ID Should have 12 digits.';
        elseif ($this->document_type == 'national_id' && strlen($this->value) < 12 && is_numeric($this->value))
            return 'The National ID Should have only numeric values.';
        return 'Passport should have 8 digits.';

    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotRecreational implements Rule
{

    private $type_of_intended_operation;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type_of_intended_operation)
    {
        $this->type_of_intended_operation = $type_of_intended_operation;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $values
     * @return bool
     */
    public function passes($attribute, $value)
    {
//        File
        if ($attribute == 'ssm_certificate')
            dd('fuck');
        if ($this->type_of_intended_operation == 1)
            return true;
        elseif ($this->type_of_intended_operation != 1 && $value != null)
            return true;
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The field can not be empty.';
    }
}

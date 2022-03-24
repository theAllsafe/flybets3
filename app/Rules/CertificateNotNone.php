<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CertificateNotNone implements Rule
{

    private $certification;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($certification)
    {
        $this->certification = $certification;
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


        if ($this->certification == 0)
            return true;
        elseif ($this->certification != 0 && $value != null)
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
        return 'The validation error message.';
    }
}

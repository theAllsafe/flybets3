<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasFile implements Rule
{

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
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
        dd($this->file);
        dd('asdasd');
        dd($this->file != null);
        if ($this->file != null)
            return true;
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

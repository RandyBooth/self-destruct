<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class NotePassword implements Rule
{
    public $password;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($password = null)
    {
        $this->password = $password;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, $this->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is incorrect. Try again.';
    }
}

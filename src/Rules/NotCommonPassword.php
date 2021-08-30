<?php

namespace Crumbls\CommonPasswords\Rules;

use Crumbls\CommonPasswords\Models\Password;
use Illuminate\Contracts\Validation\Rule;

class NotCommonPassword implements Rule {
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        if (!is_string($value)) {
            return false;
        }
        if (!$value) {
            return false;
        }

        $model = Password::class;
        $table = with(new $model)->getTable();

        return !\DB::table($table)->where('password', $value)->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute can not be a commonly used password.';
    }
}


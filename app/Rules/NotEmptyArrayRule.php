<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotEmptyArrayRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private string $key;
    private string $value;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // remove null items from collection.
        $arr = collect($value)->filter();

        return $arr->isNotEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('lang.at_least_one_selected',['type' => $this->type]);
    }
}

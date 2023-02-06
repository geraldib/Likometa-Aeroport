<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StartDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $date2 = strtotime($value);
        $date1 = strtotime(date("Y-m-d"));
        if($date2 < $date1){
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Data qe keni zgjedhur ka kaluar!';
    }
}

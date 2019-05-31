<?php 
namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;
/**
* Class ShapesJSONValid
* 
* ShapesJSONValid Class validates a shapes json type whether if valid or not .  
* @package App\Rules
*/
class ShapesJSONValid implements ImplicitRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $json_value = json_decode($value);
        //checks if the value is a valid json string that has shapes.   
        if((json_last_error() != JSON_ERROR_NONE) || !isset($json_value->shapes)) {
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
        return trans('forms.validation.ShapesJSONValid');
    }
}
?>
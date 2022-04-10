<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckLocationLevelsStatus implements Rule
{
    
    
    

    protected $checkingType;
    
    

    /*
    * $checkingType  1 : check active 0: check not active
    */
    
    public function __construct($checkingType = 1)
    {
        $this->checkingType = $checkingType;
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
        $object = $this->model::find($value);
        if($object)
            if($this->checkingType)
                return $object->{$this->column} == $this->active;
            else
                return $object->{$this->column} == $this->notActive;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $msg = 'the status of :attribute must be ';
        if($this->checkingType)
            $msg .= " active";
        else
            $msg .= " not active";
        return $msg;
    }
}

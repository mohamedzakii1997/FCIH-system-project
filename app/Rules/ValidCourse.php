<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class ValidCourse implements Rule
{
    protected $teacherId;
    protected $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($teacherId,$type)
    {
        $this->teacherId=$teacherId;
        $this->type=$type;
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
        if($this->type)
            return DB::table('assistant_course')->where('assistantId',$this->teacherId)->where('courseId',$value)->count()==1;
        else
            return DB::table('course_professor')->where('professorId',$this->teacherId)->where('courseId',$value)->count()==1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Teacher Did not Assigned To That Course' ;
    }
}

<?php

namespace CodeProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator {

    protected $rules = [
        'name' => 'required',
        'project_id' => 'required|integer',
        'start_date' => 'required',
        'due_date' => 'required',
        'status' => 'required|integer'
    ];

}
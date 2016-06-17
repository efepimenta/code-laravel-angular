<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'file' => 'required|mimes:jpg,jpeg,pdf,png,zip',
        'description' => 'required',
        'project_id' => 'required',
    ];
}
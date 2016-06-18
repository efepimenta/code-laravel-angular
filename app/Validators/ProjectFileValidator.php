<?php

namespace CodeProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'file' => 'required|mimes:jpg,jpeg,pdf,png,zip',
        'description' => 'required',
        'project_id' => 'required',
//        ValidatorInterface::RULE_CREATE => [
//            'name' => 'required',
//            'file' => 'required|mimes:jpg,jpeg,pdf,png,zip',
//            'description' => 'required',
//            'project_id' => 'required',
//        ],
//        ValidatorInterface::RULE_UPDATE => [
//            'name' => 'required',
//            'description' => 'required',
//            'project_id' => 'required',
//        ]
    ];
}
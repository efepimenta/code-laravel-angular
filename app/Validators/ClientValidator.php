<?php
/**
 * Created by PhpStorm.
 * User: suporte09
 * Date: 16/05/16
 * Time: 15:33
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
    ];

}
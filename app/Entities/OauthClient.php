<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $fillable = [
        'id',
        'secret',
        'name',
    ];
    
}

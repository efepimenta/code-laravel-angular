<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{

    protected $table = 'project_members';

    protected $fillable = [
        'project_id',
        'member_id',
    ];

}

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

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function member(){
        return $this->belongsTo(Client::class);
    }

}

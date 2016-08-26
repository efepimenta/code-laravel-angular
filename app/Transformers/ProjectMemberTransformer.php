<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

//    protected $defaultIncludes = ['project'];

    public function transform(ProjectMember $member)
    {
        return [
            'member_id' => $member->member_id,
            'project_id' => $member->project_id,
            'name' => $member->member->name
        ];
    }

//    public function includeProject(ProjectMember $member){
//        return $this->collection($member->project, new ProjectTransformer());
//    }
}
<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(ProjectMember $member)
    {
        return [
            'member_id' => $member->member_id
        ];
    }
}
<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members', 'client', 'notes', 'tasks', 'files'];

    public function transform(Project $project)
    {
        return $project;
    }

    public function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeNotes(Project $project)
    {
        return $this->collection($project->notes, new ProjectNoteTransformer());
    }

    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new ProjectTaskTransformer());
    }

    public function includeFiles(Project $project)
    {
        return $this->collection($project->files, new ProjectFileTransformer());
    }
}
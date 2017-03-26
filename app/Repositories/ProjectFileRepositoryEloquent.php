<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectFile;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    public function model()
    {
        return ProjectFile::class;
    }

}
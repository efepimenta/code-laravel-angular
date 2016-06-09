<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
    public function transform(ProjectFile $files)
    {
        return $files;
    }
}
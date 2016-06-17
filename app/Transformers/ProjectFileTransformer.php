<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectFile;
use League\Fractal\TransformerAbstract;

class ProjectFileTransformer extends TransformerAbstract
{
    public function transform(ProjectFile $file)
    {
        return [
            'id' => $file->id,
            'name' => $file->name,
            'description' => $file->description,
            'extension' => $file->extension,
        ];
    }
}
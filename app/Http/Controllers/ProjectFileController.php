<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Validators\ProjectFileValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;
    /**
     * @var ProjectFileValidator
     */
    private $validator;

    public function __construct(ProjectRepository $repository, ProjectService $service, ProjectFileValidator $validator)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->validator = $validator;
    }

    public function store(Request $request, $project_id)
    {
        $file = $request->file('file');
        if ($file->getError()) {
            return [
                'error' => true,
                'message' => $file->getErrorMessage(),
            ];
        }
        $extension = $file->getClientOriginalExtension();
        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $project_id;
        $data['description'] = $request->description;

        try {
            $this->validator->with($data)->passesOrFail();
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag(),
            ];
        }

        $valid = ['png', 'jpg', 'pdf'];
        if (!in_array($data['extension'], $valid)) {
            return [
                'error' => true,
                'message' => 'Tipo de arqivo não permitido',
                'aceitos' => $valid,
            ];
        }
        if ($this->service->createFile($data)) {
            return [
                'success' => true,
                'message' => 'Envio de arquivo completo'
            ];
        }
        return [
            'error' => true,
            'message' => 'Falha no Envio de arquivo'
        ];
    }

    public function destroy(Request $request, $project_id)
    {
        $data['name'] = $request->name;
        $data['project_id'] = $project_id;
        $data['extension'] = $request->extension;
        if ($this->service->deleteFile($data)) {
            return [
                'success' => true,
                'message' => 'Remoção de arquivo completo'
            ];
        }
        return [
            'error' => true,
            'message' => 'Falha na remoção de arquivo ou arquivo não encontrado'
        ];
    }

}

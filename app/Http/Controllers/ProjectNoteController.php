<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{

    /**
     * @var NoteProjectRepository
     */
    protected $repository;

    /**
     * @var NoteProjectService
     */
    protected $service;


    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function index($id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        } catch (ModelNotFoundException $e) {
            return ['Nada foi encontrado'];
        }
    }

    public function show($id, $noteId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
        } catch (ModelNotFoundException $e) {
            return ['Pesquisa não retornou resultado'];
        }
    }

    public function create(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function delete($id)
    {
        $this->service->delete($id);
    }
}

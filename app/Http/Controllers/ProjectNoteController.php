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
        $this->service  = $service;
    }


    public function index()
    {
        try {
            return $this->repository->with(['project'])->all();
        } catch (ModelNotFoundException $e) {
            return ['Nada foi encontrado'];
        }
    }

    public function show($id)
    {
        try {
            return $this->repository->with(['project'])->find($id);
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

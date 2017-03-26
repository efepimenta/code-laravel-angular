<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        try {
            return $this->repository->with(['client', 'owner', 'notes'])->all();
        } catch (ModelNotFoundException $e) {
            return ['Nada foi encontrado'];
        }
    }

    public function show($id)
    {
        try {
            return $this->repository->with(['client', 'owner', 'notes'])->find($id);
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

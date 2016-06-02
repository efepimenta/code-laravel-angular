<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

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
            return $this->repository->with(['client', 'owner', 'notes', 'tasks'])->findWhere(['owner_id' => Authorizer::getResourceOwnerId()]);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'Este projeto não existe.'
            ];
        }
    }

    public function show($id)
    {
        if (!$this->checkPermission($id)) {
            return [
                'Error' => 'Access forbidden',
            ];
        }
        try {
            return $this->repository->with(['client', 'owner', 'notes', 'tasks', 'members'])->find($id);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'Este projeto não existe.'
            ];
        }
    }

    private function checkPermission($id)
    {
        if ($this->checkProjectOwner($id) || $this->checkProjectMember($id)) {
            return true;
        }
        return false;
    }

    private function checkProjectOwner($id)
    {
        if ($this->repository->isOwner($id, Authorizer::getResourceOwnerId())) {
            return true;
        }
        return false;
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
        if (!$this->checkPermission($id)) {
            return [
                'Error' => 'Access forbidden',
            ];
        }
        return $this->service->delete($id);
    }

    public function addMember(Request $request, $project_id)
    {
        return $this->service->addMember($request->all(), $project_id);
    }

    public function removeMember($project_id, $user_id)
    {
        return $this->service->removeMember($project_id, $user_id);
    }

    private function checkProjectMember($id)
    {
        if ($this->repository->hasMember($id, Authorizer::getResourceOwnerId())) {
            return true;
        }
        return false;
    }
}

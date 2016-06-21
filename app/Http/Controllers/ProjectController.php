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
        $this->middleware('check.project.owner', ['except' => ['index', 'store', 'show']]);
        $this->middleware('check.project.permission', ['except' => ['index', 'store', 'update', 'destroy']]);
    }

    public function index()
    {
        try {
            $data = $this->repository->findWithOwnerAndMember(Authorizer::getResourceOwnerId());
            if (isset($data['data'])) {
                return [
                    'data' => $data['data']
                ];
            }
            return [
                'error' => true,
                'message' => 'nenhum projeto para este usuário.'
            ];
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
        if (!$this->service->checkPermission($id)) {
            return [
                'Error' => 'Access forbidden',
            ];
        }
        try {
            $data = $this->repository->find($id);
            if (isset($data['data'])) {
                return [
                    'data' => $data['data']
                ];
            }
            return [
                'error' => true,
                'message' => 'Projeto não pertence ao usuário.'
            ];
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

    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function addMember(Request $request, $projectId)
    {
        return $this->service->addMember($request->all(), $projectId);
    }

    public function removeMember($projectId, $memberId)
    {
        return $this->service->removeMember($projectId, $memberId);
    }

}

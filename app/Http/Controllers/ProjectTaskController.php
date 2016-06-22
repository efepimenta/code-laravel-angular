<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Http\Requests;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepository
     */
    protected $repository;

    /**
     * @var ProjectTaskService
     */
    protected $service;


    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    public function index($project_id)
    {
        try {
            $notes = $this->repository->findWhere(['project_id' => $project_id]);
            if (count($notes) > 0) {
                return $notes;
            }
            return [
                'error' => true,
                'message' => 'Tarefa não encontrada'
            ];
        } catch (ModelNotFoundException $e) {
            return ['Nada foi encontrado'];
        } catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'Esta tarefa não existe.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function show($project_id, $task_id)
    {
        try {
            $tasks = $this->repository->findWhere(['project_id' => $project_id, 'id' => $task_id]);
            if (isset($tasks['data']) && count($tasks['data']) === 1) {
                return [
                    'data' => $tasks['data'][0]
                ];
            }
            return [
                'error' => true,
                'message' => 'Tarefa não encontrada'
            ];
        } catch (ModelNotFoundException $e) {
            return ['Pesquisa não retornou resultado'];
        } catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto/tarefa não existe(em).'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function create(Request $request, $project_id)
    {
        return $this->service->create($request->all(), $project_id);
    }

    public function update(Request $request, $project_id, $task_id)
    {
        return $this->service->update($request->all(), $project_id, $task_id);
    }

    public function delete($project_id, $task_id)
    {
        return $this->service->delete($project_id, $task_id);
    }
}

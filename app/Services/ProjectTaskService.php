<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{
    /**
     * @var ProjectTaskRepository
     */
    protected $repository;
    /**
     * @var ProjectTaskValidator
     */
    protected $validator;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data, $project_id)
    {
        try {
            if (count($this->repository->findWhere(['name' => $data['name']])) > 0){
                return [
                    'error' => true,
                    'message' => 'Tarefa já existe'
                ];
            }
            $data['project_id'] = $project_id;
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto/tarefa não encontrado'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function update(array $data, $project_id, $task_id)
    {
        try {
            $data['project_id'] = $project_id;
            $this->validator->with($data)->passesOrFail();
            $this->repository->update($data, $task_id);
            return json_encode(['Message' => "Project task {$data['name']} has updated"]);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
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

    public function delete($project_id, $task_id)
    {
        try {
            $note = $this->repository->findWhere(['project_id' => $project_id, 'id' => $task_id]);
            if (count($note) > 0){
                $this->repository->delete($task_id);
                return [
                    'message' => 'Tarefa excluída'
                ];
            }
            return [
                'error' => true,
                'message' => "Este projeto/tarefa não existe(em)."
            ];

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
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
}
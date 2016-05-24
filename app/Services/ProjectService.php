<?php

namespace CodeProject\Services;

use CodeProject\Entities\Project;
use CodeProject\Entities\ProjectMember;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    protected $validator;

    /**
     * @var ProjectMemberRepository
     */
    protected $member_repository;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $member_repository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->member_repository = $member_repository;
    }

    public function create(array $data)
    {
        try {
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
                'message' => 'Projeto não encontrado'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $this->repository->update($data, $id);
            return json_encode(['Message' => "Project {$data['name']} has updated"]);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        try {
            $cli = $this->repository->find($id);
            $message = "Project {$cli['original']['name']} has deleted";
            $cli->delete();
            echo json_encode(['Message' => $message]);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Projeto não encontrado'
            ];
        } catch (QueryException $e){
            return [
                'error' => true,
                'message' => 'Projeto não pode ser excluído. Existem notas para esse projeto?'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function addMember($data, $project_id){
        try {
            if (!$this->isMember($project_id, $data['user_id'])) {
                ProjectMember::create(['project_id' => $project_id, 'user_id' => $data['user_id']]);
                return ['Message' => 'Membro agora faz parte deste projeto'];
            }
            return ['Message' => 'Membro já faz parte deste projeto'];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function removeMember($project_id, $user_id)
    {
        try {
            if ($this->isMember($project_id, $user_id)) {
                $cli = ProjectMember::where(['project_id' => $project_id, 'user_id' => $user_id])->delete();
                if ($cli > 0) {
                    return ['Message' => 'Membro removido'];
                }
                return ['Message' => 'Membro não foi removido'];
            }
            return ['Message' => 'Membro não existe ou faz parte deste projeto'];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    private function isMember($project_id, $user_id){
        $member = $this->member_repository->findWhere(['project_id' => $project_id, 'user_id' => $user_id]);
        return count($member) > 0;
    }
}
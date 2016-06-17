<?php

namespace CodeProject\Services;

use CodeProject\Entities\ProjectMember;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Filesystem\Filesystem;
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
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;
    /**
     * @var ProjectFileRepository
     */
    private $file_repository;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberRepository $member_repository,
                                ProjectFileRepository $file_repository, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->member_repository = $member_repository;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
        $this->file_repository = $file_repository;
    }

    public function store(array $data)
    {
        $proje = $this->repository->skipPresenter()->findWhere(['name' => $data['name']]);
        try {
            if (count($proje) > 0) {
                return [
                    'error' => true,
                    'message' => 'Projeto já existe'
                ];
            }
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
            $this->repository->skipPresenter()->update($data, $id);
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

    public function destroy($id)
    {
        try {
            $cli = $this->repository->skipPresenter()->find($id);
            $message = "Project {$cli['original']['name']} has deleted";
            $cli->delete();
            return [
                'success' => true,
                'message' => 'Projeto excuído com sucesso'
            ];
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
        } catch (QueryException $e) {
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

    public function addMember($data, $projectId)
    {
        try {
            if (!$this->isMember($projectId, $data['member_id'])) {
                ProjectMember::create(['project_id' => $projectId, 'member_id' => $data['member_id']]);
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

    private function isMember($projectId, $memberId)
    {
        $member = $this->member_repository->findWhere(['project_id' => $projectId, 'member_id' => $memberId]);
        return count($member) > 0;
    }

    public function removeMember($projectId, $memberId)
    {
        try {
            if ($this->isMember($projectId, $memberId)) {
                $cli = ProjectMember::where(['project_id' => $projectId, 'member_id' => $memberId])->delete();
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

    public function createFile(array $data)
    {
        try {
            $project = $this->repository->skipPresenter()->find($data['project_id']);
            $project_file = $project->files()->create($data);
            $this->storage->put($project_file->id . '.' . $data['extension'], $this->filesystem->get($data['file']));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return true;
    }

    public function deleteFile(array $data)
    {
        try {
            $file = $this->file_repository->findWhere(['project_id' => $data['project_id'], 'name' => $data['name']]);
            if (count($file) > 0) {
                foreach ($file as $item) {
                    $this->file_repository->delete($item->id);
                    $this->storage->delete($item->id . '.' . $item->extension);
                }
            } else {
                return false;
            }
        } catch (ValidatorException $e) {
            return false;
        }
        return true;
    }

    public function updateFile(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}
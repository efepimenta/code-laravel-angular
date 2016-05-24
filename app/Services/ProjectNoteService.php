<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data, $project_id)
    {
        try {
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
                'message' => 'Projeto/nota não encontrado'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function update(array $data, $project_id, $note_id)
    {
        try {
            $data['project_id'] = $project_id;
            $this->validator->with($data)->passesOrFail();
            $this->repository->update($data, $note_id);
            return json_encode(['Message' => "Project note {$data['title']} has updated"]);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto/nota não existe(em).'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete($project_id, $note_id)
    {
        try {
            $note = $this->repository->findWhere(['project_id' => $project_id, 'id' => $note_id]);
            if (count($note) > 0){
                $this->repository->delete($note_id);
                return [
                    'message' => 'Nota excluída'
                ];
            }
            return [
                'error' => true,
                'message' => "Este projeto/nota não existe(em)."
            ];

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto/nota não existe(em).'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}
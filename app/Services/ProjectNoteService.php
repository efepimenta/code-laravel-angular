<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
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
            return $e->getMessage();
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
            return $e->getMessage();
        }
    }

    public function delete($project_id, $note_id)
    {
        try {
            $note = $this->repository->findWhere(['project_id' => $project_id, 'id' => $note_id]);
            if (count($note) > 0){
                $this->repository->delete($note_id);
                $message = "Note deleted";
                return json_encode(['Message' => $message]);
            }
            $message = "Note not found";
            return json_encode(['Message' => $message]);

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }
}
<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->service = $service;
    }


    public function index($project_id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $project_id]);
        } catch (ModelNotFoundException $e) {
            return ['Nada foi encontrado'];
        }catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto não existe.'
            ];
        }
    }

    public function show($project_id, $noteId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $project_id, 'id' => $noteId]);
        } catch (ModelNotFoundException $e) {
            return ['Pesquisa não retornou resultado'];
        }catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto não existe.'
            ];
        }
    }

    public function create(Request $request, $project_id)
    {
        return $this->service->create($request->all(), $project_id);
    }

    public function update(Request $request, $project_id, $note_id)
    {
        return $this->service->update($request->all(), $project_id, $note_id);
    }

    public function delete($project_id, $note_id)
    {
        return $this->service->delete($project_id, $note_id);
    }
}

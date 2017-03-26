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
            $notes = $this->repository->findWhere(['project_id' => $project_id]);
            if (isset($notes['data'])) {
                return [
                    'data' => $notes['data']
                ];
            }
            return [
                'error' => true,
                'message' => 'Projeto não encontrado'
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Nada foi encontrado'
            ];
        } catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto não existe.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function show($project_id, $noteId)
    {
        try {
            $notes = $this->repository->findWhere(['project_id' => $project_id, 'id' => $noteId]);
            if (isset($notes['data']) && count($notes['data']) === 1) {
                return [
                    'data' => $notes['data'][0]
                ];
            }
            return [
                'error' => true,
                'message' => 'Projeto / nota não encontrado(s)'
            ];
        } catch (ModelNotFoundException $e) {
            return ['Pesquisa não retornou resultado'];
        } catch (NotFoundHttpException $e) {
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

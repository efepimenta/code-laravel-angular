<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Services\ProjectMemberService;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;

class ProjectMemberController extends Controller
{

    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    /**
     * @var ProjectMemberService
     */
    protected $service;


    public function __construct(ProjectMemberRepository $repository, ProjectMemberService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function show($project_id)
    {
        try {
            $members = $this->repository->with(['user'])->findWhere(['project_id' => $project_id]);
            if (count($members) > 0) {
                return $members;
            }
            return [
                'error' => true,
                'message' => 'Projeto / membros não encontrado(s)'
            ];
        } catch (ModelNotFoundException $e) {
            return ['Pesquisa não retornou resultado'];
        } catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'Este projeto/menbro não existe(em).'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

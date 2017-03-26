<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Http\Requests;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Services\ProjectMemberService;

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

    public function index($project_id)
    {
        try {
            $members = $this->repository->findWhere(['project_id' => $project_id]);
            if (isset($members['data'])) {
                return [
                    'data' => array_reverse($members['data'])
                ];
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

    public function show($project_id, $member_id)
    {
        try {
            $members = $this->repository->findWhere(['project_id' => $project_id, 'member_id'=> $member_id]);
            if (isset($members['data'])) {
                return [
                    'data' => $members['data']
                ];
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

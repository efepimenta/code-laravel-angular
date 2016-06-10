<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientService
     */
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        try {
            return $this->repository->skipPresenter()->all();
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Cliente não encontrado'
            ];
        } catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'nenhum cliente existente.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function show($id)
    {
        try {
            $data = $this->repository->skipPresenter()->findWhere(['id' => $id]);
            if (count($data) === 1) {
                return json_encode($data[0]);
            }
            return [
                'error' => true,
                'message' => 'Cliente não encontrado'
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'Cliente não encontrado'
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

    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}

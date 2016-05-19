<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;

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

    public function index(){
        return $this->repository->all();
    }

    public function show($id){
        return $this->repository->find($id);
    }

    public function create(Request $request){
        return $this->service->create($request->all());
    }

    public function update(Request $request, $id){
        try {
            $cli = Client::find($id);
            if (is_null($cli)) {
                return json_encode(["message" => "Id incorreto"]);
            }
            if ($cli->update($request->all())) {
                return json_encode(["message" => "Client {$cli['original']['name']} foi atualizado"]);
            }
        } catch (\Exception $e){
            return json_encode(["message" => "Erro deletando Client"]);
        }
    }
    public function destroy($id)
    {
        try {
            $cli = Client::find($id);
            if (is_null($cli)){
                return json_encode(["message" => "Id incorreto"]);
            }
            $mess = $cli['name'];
            if ($cli->delete()) {
                return json_encode(["message" => "Client {$mess} foi removido"]);
            }
        } catch (\Exception $e){
            return json_encode(["message" => "Erro deletando Client"]);
        }
    }
}

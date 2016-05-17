<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Client;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;

class ClientController extends Controller
{
    public function index(){
        return Client::all();
    }

    public function show($id){
        return Client::find($id);
    }

    public function store(Request $request){
        return Client::create($request->all());
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

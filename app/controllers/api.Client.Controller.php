<?php   

require_once './app/models/client-Model.php';
require_once './app/views/json.view.php';
class ClientApiController {

    private $view;
    private $model;

        function __construct() { 
            $this->view = new JSONview();
            $this->model = new clientModel();
        }


    public function getClients() {
        //obtengo los clientes del modelo
        $clients = $this->model->getClients();

        return $this->view->response($clients);
    }
    public function getClient($req,$res) {
        //obtengo el parametro de la url
        $id = $req->params->id;
        //obtengo el cliente del modelo
        $client = $this->model->getClientById($id);

        if(!$client){
            return $this->view->response("El cliente con el id=$id no existe", 404);
        }

        return $this->view->response($client);
        
    }
}
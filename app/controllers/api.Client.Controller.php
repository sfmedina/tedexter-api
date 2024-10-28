<?php   
class ClientApiController {

    private $view;
    private $model;

        public function __construct($res) { 
            $this->view = new JSONview();
            $this->model = new userModel();
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

        return $this->view->response($client);
        
    }
}
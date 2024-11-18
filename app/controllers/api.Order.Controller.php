<?php

require_once './app/models/order-model.php';
require_once './app/views/json.view.php';
require_once './app/models/client-model.php';

class OrderApiController
{

    private $view;
    private $model;
    private $modelClient;

    function __construct()
    {
        $this->view = new JSONview();
        $this->model = new orderModel();
        $this->modelClient = new clientModel();
    }


    public function getOrders($req, $res)
    {           
        
        //obtengo todos los pedidos por estado
            $orders= [];

            if (isset($req->query->status) && $req->query->status == "entregado") {
                $orders = $this->model->getByStatus($req->query->status);                
    
            } else if (isset($req->query->status) && $req->query->status == "pendiente") {
                $orders = $this->model->getByStatus($req->query->status);
            } else if (isset($req->query->status) && $req->query->status == "en camino") {
                $orders = $this->model->getByStatus($req->query->status);
            } else if (isset($req->query->status) && $req->query->status == "en preparacion") {
                $orders = $this->model->getByStatus($req->query->status);

        }
        else{
            $orders = $this->model->getOrders();
            
        }
        return $this->view->response($orders);
    }
        public function getOrdersByDate($req,$res){
//obtener todos los datos ordeanados por fecha  en forma ascedente o descendente 
        if (isset($req->query->date) && $req->query->date == "ASC") {
            $orders = $this->model->getOrdersByDateAsc();
        }
        if (isset($req->query->date) && $req->query->date == "DESC") {
            $orders = $this->model->getOrdersByDateDesc();
        }
        //se establece por defecto que si no recibe un parametro de ordenamiento el mismo sea Ascendente 
        if(isset($req->query->date)){
            $orders = $this->model->getOrdersByDateAsc();           

        }

        return $this->view->response($orders);
    }





    public function getOrder($req, $res)
    {
        //obtengo el parametro de la url
        $id = $req->params->id;
        //obtengo el cliente del modelo
        $order = $this->model->getOrderById($id);

        if (!$order) {
            return $this->view->response("El Pedido con el id=$id no existe", 404);
        }   
        
            
        


            
        

        return $this->view->response($order);
    }
    public function deleteOrder($req, $res)
    {
        $id = $req->params->id;

        $order = $this->model->getOrderById($id);

        if (!$order) {
            return $this->view->response("El Pedido con el id=$id no existe", 404);
        }
        $this->model->deleteOrder($id);
        return $this->view->response("El Pedido con el id=$id fue eliminado", 200);
    }
    public function createOrder($req, $res)
    {
        $body = $req->body;
        $date = $body->date;
        $status = $body->status;
        $id_client = $body->id_client;

        if ($this->modelClient->getClientById($id_client) == null) {
            return $this->view->response("El Cliente con el id=$id_client no existe", 404);
        }

        if (empty($date) || empty($status)) {
            return $this->view->response("Faltan datos obligatorios", 400);
        }

        $lastId = $this->model->createOrder($date, $status, $id_client);
        if (!$lastId) {
            return $this->view->response("Error al crear el pedido", 500);
        } else {
            $order = $this->model->getOrderById($lastId);
            return $this->view->response(["El pedido  número $lastId ha sido creado exitosamente", $order], 201);
        }
    }

    public function updateOrder($req, $res)
    {
        //verifico que el pedido exista
        if ($this->model->getOrderById($req->params->id) == null) {
            return $this->view->response("El pedido con el id= $req->params->id no existe", 404);
        }
        $id_client = $req->body->id_client;
        //verifico que si se actualiza el cliente, este exista
        if (!$this->modelClient->getClientById($id_client)) {
            return $this->view->response("El Cliente con el id=$id_client no existe", 404);
        }

        $id = $req->params->id;
        $date = $req->body->date;
        $status = $req->body->status;

        $this->model->updateOrder($id, $date, $status, $id_client);
        $order = $this->model->getOrderById($id);

        if (!$order) {
            return $this->view->response("Error al actualizar el pedido", 500);
        } else {

            return $this->view->response(["El pedido  número $id ha sido actualizado exitosamente", $order], 201);
        }
    }
}

<?php
require_once './config.php';

class orderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }




    public function showOrders()
    {      

        $query = $this->db->prepare('SELECT * FROM `command`');
        $query->execute();

        $commands = $query->fetchAll(PDO::FETCH_OBJ);

        return $commands;
    }

    public function showOrderById($id)
    {

        //SELECT * FROM `order` WHERE 

        $query = $this->db->prepare('SELECT * FROM `command` WHERE `id_order` = ? ORDER BY `id_order` ASC');
        $query->execute([$id]);

        $commands = $query->fetchAll(PDO::FETCH_OBJ);

        return $commands;
    }



    public function deleteOrder($id)
    {       

        $query = $this->db->prepare("DELETE FROM command WHERE `command`.`id_order` = ?");
        $query->execute([$id]);

        $orders = $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    
    public function createCommand($date, $status, $id_client)
    {

        $query = $this->db->prepare("INSERT INTO command(date, status, id_client) VALUES (?,?,?)");
        $query->execute([$date, $status, $id_client]);
      
        
    }

    public function updateCommand($id_order, $date, $status, $id_client)
    {
        $query = $this->db->prepare("UPDATE command SET date = ?, status = ?, id_client = ? WHERE id_order = ?");
        $query->execute([$date, $status, $id_client, $id_order]);  
    }
}
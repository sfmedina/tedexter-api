<?php
require_once './config.php';

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
                ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );

        $this->_deploy();
    }
    private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<SQL
                CREATE TABLE IF NOT EXISTS users (
                    id_user INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(50) NOT NULL,
                    password VARCHAR(255) NOT NULL
                );
                
                CREATE TABLE IF NOT EXISTS clients (
                    id_client INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL
                );
                
                CREATE TABLE IF NOT EXISTS orders (
                    id_order INT AUTO_INCREMENT PRIMARY KEY,
                    date DATE NOT NULL,
                    status VARCHAR(50) NOT NULL,
                    id_client INT,
                    FOREIGN KEY (id_client) REFERENCES clients(id_client)
                );
                INSERT INTO `command` (`id_order`, `date`, `status`, `id_client`) VALUES
                    (22, '2022-02-09', 'en camino', 12),
                    (23, '2024-10-23', 'pendiente', 6),
                    (25, '2024-10-17', 'en camino', 6),
                    (26, '2024-10-15', 'en camino', 6),
                    (27, '2024-10-20', 'pendiente', 12),
                    (29, '2024-10-24', 'en camino', 12),
                    (30, '2024-10-16', 'pendiente', 1),
                    (31, '2024-11-04', 'entregado', 12),
                    (32, '2024-10-30', 'en preparacion', 8),
                    (33, '2024-10-01', 'en preparacion', 2);

                    INSERT INTO `client` (`id_client`, `name`, `email`, `addres`, `phone`, `image`) VALUES
                        (1, 'Federico Medina', 'sfmedina@gmail.com', 'Colon 1575', 2494665523, 'image/users/6713ea04001a9.jpg'),
                        (2, 'Giuliana', 'giugmail.com', 'siempre viva 123', 2494007979, ''),
                        (6, 'Santino Lanzini', 'sant@yahoo.com.ar', 'Alem 1129', 2494551943, ''),
                        (8, 'Eugenia Lanzini Aguilera', 'tandilcopan@hotmail.com', 'Montevideo 1261', 2494551943, ''),
                        (10, 'Federico Medina', 'smedina@alumnos.exa.unicen.edu', 'garibaldi 1054', 2494665523, ''),
                        (11, 'Sebastián Federico Medina', 'sfmedina@gmail.com', 'Alem 1129', 2494665523, ''),
                        (12, 'Carlitos', 'car@car.com.ar', 'siempre viva 16512', 249412554, 'image/users/6713ea1122fad.jpg');

                        INSERT INTO `user` (`username`, `password`) VALUES
                        ('webadmin', '$2y$10$Nem9YT.KGLe2uF9.uIs2SeEriJlpeuZONlqV7uXvjYvguS./vKZI.');


SQL;;
            $this->db->query($sql);
        }
    }
}

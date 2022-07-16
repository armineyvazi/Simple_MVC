<?php
class m002_initial
{
    public function up(){

       $db=app\core\Application::$app->db;

       $SQL="CREATE TABLE posts (

                id INT AUTO_INCREMENT PRIMARY KEY,

                title VARCHAR(255) NOT NULL,

                body VARCHAR(255) NOT NULL, 
                
                deleted BOOLEAN DEFAULT 0,

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )  ENGINE=INNODB;";
            
       $db->pdo->exec($SQL);
    }
    public function down(){

        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE posts;";
        $db->pdo->exec($SQL);
    }
}

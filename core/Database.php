<?php

namespace app\core;


use PDO;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn=$config['dsn'] ?? '';
        $user=$config['user'] ?? '';
        $password=$config['password'] ?? '';

        $this->pdo=new PDO($dsn,$user,$password);

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(){


        $this->createMigrationsTable();

        $newMigrations=[];
        $appliedMigrations=$this->getAppliedMigrations();

        $files=scandir(Application::$ROOT_DIR.'/migrations');



        $toApplyMigrations=array_diff($files,$appliedMigrations);


        foreach($toApplyMigrations as $migration) {

            if($migration==='.' || $migration==='..'){

                continue;
            }



        require_once  Application::$ROOT_DIR.'/migrations/'.$migration;

        $className=pathinfo($migration,PATHINFO_FILENAME);


        $instance= new $className();

        $this->log("Applyin migration $migration");

        $instance->up();

        $this->log("Applied migration $migration");

        $newMigrations[]=$migration;

        }

        if(!empty($newMigrations)){

            $this->saveMigrations($newMigrations);
        }
        else{

            $this->log('All migrations  are applied');
        }


    }
    public function createMigrationsTable(){

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (

            id INT AUTO_INCREMENT PRIMARY KEY,

            migration VARCHAR(255),

            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP



         )ENGINE=INNODB;");
    }
    public function getAppliedMigrations(){

        $statement=$this->pdo->prepare("SELECT migration FROM migrations");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations){

        $str=implode(",",array_map(fn($m)=>"('$m')",$migrations));



        $statment=$this->pdo->prepare("INSERT INTO migrations (migration) VALUES

            $str

        ");

        $statment->execute();
    }

    protected function log($message){
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }
    public function paginate()
    {

        $page=isset($_GET['page']) ? (int)($_GET['page']):1;
        $perPage=isset($_GET['per-page']) || $_GET['per-page']<=50 ?(int)($_GET['per-page']):5;

        $start=($page > 1 ) ? ($page*$perPage) - $perPage : 0 ;
        $article=$this->pdo->prepare("
                SELECT SQL_CALC_FOUND_ROWS id,title,body
                FROM posts
                LIMIT {$start},{$perPage}


        ");
        $article->execute();
        $article=$article->fetchAll(\PDO::FETCH_ASSOC);
        $total=$this->pdo->query("SELECT FOUND_ROWS()")->fetch();
        ;
        $page=ceil($total[0]/$perPage);
        $article['page']=$page;
        $article['per-page']=$perPage;

        return $article;
    }

    public function find($id)
    {
        $string=$this->pdo->prepare("SELECT * FROM posts WHERE  id = ?");

        $string->execute(array($id));

        $string=$string->fetchAll(\PDO::FETCH_ASSOC);


        return $string;
    }
    public function update($id,$title,$body)
    {
        $string="UPDATE posts SET title = :title, body = :body WHERE id = :id";
        $stmt=$this->pdo->prepare($string);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':body', $body, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data=$stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function search($text)
    {
        $text=htmlspecialchars($text);
        $get_name =$this->pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$text%' OR body LIKE '%$text%'");
        $get_name->execute();
        $get_name=$get_name->fetch(\PDO::FETCH_ASSOC);

       return $get_name;

    }
    public function delete($id)
    {
        $sql = "DELETE FROM posts WHERE id=?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }


}

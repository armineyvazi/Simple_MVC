<?php

namespace app\core\service;

use app\core\Application;
use app\core\service;

class PostsService
{
    /**
     *
     * @var \app\core\Application $app
     *
     * @var \app\core\database\Database $db
     *
     *
     */
    public function edit($id)
    {
        $id=array_keys($id);

        return Application::$app->db->find((int)$id[0]);

    }
    /**
     *
     * @var \app\core\Application $app
     *
     * @var \app\core\Database $db
     *
     */
    public function update($data)
    {
        $id=(int)$data['id'];
        $title=$data['title'];
        $body=$data['body'];

        Application::$app->db->update($id,$title,$body);
    }
    /**
     * @var \app\core\Application $app
     *
     * @var \app\core\Database $db
     */
    public function delete($id)
    {
        $id=array_keys($id);
        Application::$app->db->delete($id[0]);

    }
    /**
     * @var \app\core\Application $app
     *
     * @var \app\core\Database $db
     */
    public function search($text)
    {
        return Application::$app->db->search($text);
    }

}

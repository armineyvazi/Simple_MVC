<?php



namespace app\controllers;

use app\core\service\PostsService;
use App\core\Application;
use app\core\Request;
use app\models\Posts;
use PDO;


class PostsController
{
    /**
     * @var app\models\PostsService
     *
     */
    protected $post_Service;
    /**
     * @var __construct post_Service
     *
     * @return void
     */
    public function __construct()
    {
        $this->post_Service=new PostsService;
    }
    /**
     *
     * @param mixed views
     *
     * @return array
     */
    public function index()
    {
        $data=Application::$app->db->paginate();
        return views('posts.posts',compact('data'));
    }
     /**
     * @param mixed views
     */
    public function create()
    {
        return views('posts.addpost');
    }
    /**
     *
     * stores the post in the database
     *
     * @param Request $request
     *
     * @return void
     *
     */
    public function store(Request $request)
    {
        $post=new Posts;
        $post->loadData($request->getBody());

        if($post->validate() and $post->create())
        {
            Application::$app->session->setSession('success','your posts is add succsess fully');

            return views('posts.addpost');
        }
        return views('posts.addpost',['model'=>$post]);
    }
    /**
     *
     * Edit posts from the Database.
     *
     * @param Request $request
     *
     */
    public function edit(Request $request)
    {
        $id=$request->getBody();

        $data=$this->post_Service->edit($id);

        return views('posts.editposts',compact('data'));

    }
    /**
     *
     * Update posts from the Database.
     *
     * @param Request $request
     *
     * @return void
     *
     */
    public function update(Request $request)
    {
        $data=$request->getBody();

        $this->post_Service->update($data);

        return redirect("/posts?page=1&per-page=3");
    }
    /**
     *
     * Delete posts from the Database.
     *
     * @param Request $request
     *
     * @return void
     *
     */
    public function delete(Request $request)
    {
        $id=$request->getBody();

        $this->post_Service->delete($id);

        return redirect("/posts?page=1&per-page=3");

    }
    /**
     *
     * @param mixed views
     *
     * @return array
     *
     */
    public function search(Request $request)
    {
        $text=$request->getBody()['name'];

        $ajax=$this->post_Service->search($text);

        return views('posts.posts',compact('ajax'));
    }




}

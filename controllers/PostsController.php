<?php



namespace app\controllers;

use App\core\Application;

use app\core\Controller;

use app\core\Request;
use app\models\Posts;

class PostsController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $this->setLayout('main');
        return $this->render('posts');
    }
     /**
     * 
     * @return void
     */
    public function create()
    {

        $this->setLayout('main');
        return $this->render('addpost');
    }
    /**
     * 
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $post=new Posts;
        $post->loadData($request->getBody());
        $post->validate();
        $post->create();
        Application::$app->session->setSession('success','your posts is add succsess fully');
        return $this->render('posts');
        
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
   



}
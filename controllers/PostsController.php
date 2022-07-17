<?php



namespace app\controllers;

use App\core\Application;

use app\core\Controller;
use app\core\Database;
use app\core\Request;
use app\models\Posts;
use PDO;

class PostsController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $data=Application::$app->db->page();
        $this->setLayout('main');
        return $this->render('posts',compact('data'));
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
       
        if($post->validate() and $post->create())
        {
            Application::$app->session->setSession('success','your posts is add succsess fully');
            

            return $this->render('addpost');
        }
        // $this->setLayout('main');

        return $this->render('addpost',['model'=>$post]);
        
    }

    public function edit(Request $request)
    {
        $id=$request->getBody();
        $id=array_keys($id);
    
        $data=Application::$app->db->find((int)$id[0]);

       return $this->render('editposts',compact('data'));
      
    }
    public function update(Request $request)
    {
        $data=$request->getBody();
        $id=(int)$data['id'];
        $title=$data['title'];
        $body=$data['body'];

        Application::$app->db->update($id,$title,$body);

        return $this->redirect("/posts?page=1&per-page=3");

    }

    public function delete(Request $request)
    {
        $id=$request->getBody();
        $id=array_keys($id);

        Application::$app->db->delete($id[0]);
       
        return $this->redirect("/posts?page=1&per-page=3");

    }
   



}
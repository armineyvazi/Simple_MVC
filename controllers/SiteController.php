<?php



namespace app\controllers;

use App\core\Application;

use app\core\Controller;

use app\core\Request;

class SiteController extends Controller
{

    public function home()
    {
        $params=[

            'name'=>'The codeholic'

        ];

        return $this->render('home',$params);
        
    }

    public function handeContact(Request $request)
    {
        $body=$request->getBody();
       
        return 'Handeling submitted data';

    }
    public function contact()
    {
        return $this->render('contact');
        
    }
    public function search(Request $request)
    {
     
        dd('a');
        
        $text=$request->getBody()['name'];
        $get_name=Application::$app->db->search($text);
       
        while($names = $get_name->fetch(\PDO::FETCH_ASSOC)){
            // show each user as a link
            echo '<a href="">'.$names['name'].'</a>';
            
        }

        return $names;
    }
    




}
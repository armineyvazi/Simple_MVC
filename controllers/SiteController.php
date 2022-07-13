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




}
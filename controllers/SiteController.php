<?php



namespace app\controllers;

use App\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController
{
    /**
     * @param mixed view
     *
     * @return string|array
     */
    public function home()
    {
        $params=[
            'name'=>'The codeholic'
        ];

        return views('home.home',$params);
    }
    /**
     * @param mixed views
     *
     */
    public function contact()
    {
        return views('contact.contact');

    }






}

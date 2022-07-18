<?php



namespace app\controllers;

use app\core\Controller;

use app\core\Request;

use app\models\User;

class AuthController
{
    /**
     * @param mixed view
     *
     */
    public function login()
    {
        return views('access.login');
    }
    /**
     *
     * @param mixed views
     *
     * @return array
     *
     */
    public function register(Request $request)
    {
        $user=new User;
        if($request->isPost())
        {
            $user->loadData($request->getBody());

            if($user->validate() && $user->save()){
                return "Success";
            }

            return views('access.register',[
                'model'=>$user
            ]);
        }

        return views('access.register',['model'=>$user]);
    }

}

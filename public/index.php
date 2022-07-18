<?php



use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\PostsController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv =Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],

    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);


$app->router->get('/contact', [SiteController::class, 'contact']);
/**
 * route login
 */
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
/**
 * route register
 */
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
/**
 *
 * route posts
 *
 */
$app->router->get('/addposts',[PostsController::class,'create']);
$app->router->post('/addposts',[PostsController::class,'store']);
$app->router->get('/posts',[PostsController::class,'index']);
/**
 * route posts Edite
 */
$app->router->get('/posts/edit',[PostsController::class,'edit']);
/**
 * route post for update
 */
$app->router->post('/posts/update',[PostsController::class,'update']);
/**
 * route post for delet
 */
$app->router->get('/posts/delete',[PostsController::class,'delete']);
$app->router->post('/search', [PostsController::class, 'search']);


$app->run();

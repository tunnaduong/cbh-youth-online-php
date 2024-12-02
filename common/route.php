<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use Phroute\Phroute\RouteCollector;
use App\Controllers\PostVoteController;
use App\Controllers\SavePostController;
use App\Controllers\CommentVoteController;
use App\Controllers\FacebookController;
use App\Controllers\FollowController;
use App\Controllers\ForumController;
use App\Controllers\GoogleController;
use App\Controllers\ProfileController;
use App\Controllers\RecordingController;
use App\Controllers\ReportController;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];
try {
    $router = new RouteCollector();


    // khu vực cần quan tâm -----------
    // bắt đầu định nghĩa ra các đường dẫn
    // $router->get('/', function () {
    //     return "trang chủ";
    // });



    // khu vực cần quan tâm -----------
    $router->any('/login', [AuthController::class, 'login']);
    $router->any('/register', [AuthController::class, 'register']);
    $router->get('/logout', [AuthController::class, 'logout']);
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/{username}/posts/{postId}', [PostController::class, 'postDetail']);
    $router->post('/{username}/posts/{postId}', [PostController::class, 'addNewComment']);
    $router->post('/', [PostController::class, 'addNewPost']);
    $router->get('/report', [ReportController::class, 'showReportForm']);
    $router->get('/report/class/success', [ReportController::class, 'submitReport']);
    $router->get('/report/class/confirm', [ReportController::class, 'confirmReport']);
    $router->get('/report/class', [ReportController::class, 'showReportForm']);
    $router->get('/report/student', [HomeController::class, 'report']);
    $router->get('/lookup', [HomeController::class, 'lookup']);
    $router->get('/explore', [HomeController::class, 'explore']);
    $router->get('/saved', [HomeController::class, 'saved']);
    $router->get('/api/vote', [PostVoteController::class, 'handleVote']);
    $router->get('/api/comment/vote', [CommentVoteController::class, 'handleVote']);
    $router->get('/api/posts/{postId}/toggle-save', [SavePostController::class, 'toggleSavePost']);
    $router->get('/api/posts/{postId}/increment-view', [PostController::class, 'incrementView']);
    $router->get('/api/toggle-follow', [FollowController::class, 'handleToggleFollowAndUnfollow']);
    $router->get('/email/verify/{token}', [AuthController::class, 'verifyEmail']);
    // $router->get('/email/resend', [AuthController::class, 'resendVerificationEmail']);
    $router->any('/password/reset', [AuthController::class, 'forgotPassword']);
    $router->any('/password/reset/{token}', [AuthController::class, 'resetPassword']);
    $router->get('/login/google', [GoogleController::class, 'redirectToProvider']);
    $router->get('/login/google/callback', [GoogleController::class, 'handleProviderCallback']);
    $router->get('/login/facebook', [FacebookController::class, 'redirectToProvider']);
    $router->get('/login/facebook/callback', [FacebookController::class, 'handleProviderCallback']);
    $router->get('/forum', [ForumController::class, 'index']);
    $router->get('/forum/{mainCategorySlug}', [ForumController::class, 'category']);
    $router->get('/forum/{mainCategorySlug}/{subforumSlug}', [ForumController::class, 'subforum']);
    $router->get('/recordings', [RecordingController::class, 'index']);
    $router->get("/admin", [AdminController::class, 'index']);

    // username should be the last route
    $router->get('/{username}', [ProfileController::class, 'index']);
    // $router->get('/test/{email}/{token}', [AuthController::class, 'sendVerificationEmail']);
    # NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

    // Print out the value returned from the dispatched function
    echo $response;
} catch (Exception $e) {
    // var_dump($e->getMessage());
    return (new HomeController())->error404($e->getMessage());
    // die;
}

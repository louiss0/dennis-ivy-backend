<?php



namespace Src\Types\Interfaces;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Src\Utils\Classes\View;

interface IAuthController
{

    public const SIGN_UP = "signUp";
    public const SIGN_IN = "signIn";
    public const FORGOT_PASSWORD = "forgotPassword";
    public const RESET_PASSWORD = "resetPassword";
    public const UPDATE_MY_PASSWORD = "updateMyPassword";


    public function signUp(View $view, ServerRequest $request, Response $response): Response;


    public function signIn(ServerRequest $request, Response $response): Response;

    public function forgotPassword(View $view,  ServerRequest $request, Response $response): Response;

    public function resetPassword(ServerRequest $request, Response $response, string $token): Response;

    public function updateMyPassword(ServerRequest $request, Response $response): Response;
}

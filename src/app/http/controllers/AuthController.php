<?php


namespace Src\App\Http\Controllers;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Http\ServerRequest;
use Slim\Http\Response;
use Slim\Routing\RouteContext;
use Src\Types\Enums\CommonHTTPStatusCodes;
use Src\Types\Enums\Paths;
use Src\Types\Enums\RouteNamesEnum;
use Src\Types\Interfaces\IAuthController;
use Src\App\Http\Middleware\Attributes\EmailAndPasswordValidationMiddleware;
use Src\App\Http\Middleware\Attributes\EmailValidationMiddleware;
use Src\App\Http\Middleware\Attributes\NameEmailAndPasswordValidationMiddleware;
use Src\App\Http\Middleware\Attributes\PasswordAndPasswordConfirmValidationMiddleware;
use Src\App\Http\Middleware\Attributes\PasswordCurrentPasswordAndPasswordConfirmValidationMiddleware;
use Src\App\Http\Middleware\Attributes\RouteRestrictionMiddleware;
use Src\App\Http\Middleware\Attributes\TokenAuthMiddleware;
use Src\App\Repositories\UserRepository;
use Src\App\Services\EmailService;
use Src\App\Services\TokenAuthService;
use Louiss0\SlimRouteRegistry\Attributes\Post;
use Louiss0\SlimRouteRegistry\Attributes\Patch;
use Src\Utils\Classes\CookieSender;
use Src\Utils\Classes\View;

class AuthController implements IAuthController
{


    public function __construct(
        private TokenAuthService $tokenAuthService,
        private UserRepository $userRepository,

    ) {
    }

    #[
        Post(Paths::SIGN_IN, RouteNamesEnum::SIGN_IN,),
        EmailAndPasswordValidationMiddleware
    ]
    function signIn(ServerRequest $request, Response $response): Response
    {

        $body = $request->getParsedBody();


        list("email" => $email, "password" => $password) = $body;

        $user = $this->userRepository->getUserByEmail($email);


        throw_if(
            condition: $user,
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "You aren't signed up to this site please sign up "
        );


        list("password" => $user_password) = $user;


        throw_unless(
            password_verify($password, $user_password),
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "Invalid credentials "
        );


        $token = $this->tokenAuthService->encode90DayToken(
            $this->userRepository->getOne($user->getId())->toArray(),
        );


        CookieSender::sendJwtCookieThatExpiresIn90Days($token);

        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "You are signed up",
                "data" => compact("user"),
                "token" => $token
            ]
        );
    }

    #[
        Post(Paths::SIGN_UP, RouteNamesEnum::SIGN_UP,),
        NameEmailAndPasswordValidationMiddleware
    ]
    function signUp(View $view, ServerRequest $request, Response $response): Response
    {


        $uri = $request->getUri();

        list($host, $protocol, $body) = [
            $uri->getHost(),
            $uri->getScheme(),
            $request->getParsedBody(),
        ];


        list(
            "email" => $email,
            "password" => $password,
        ) = $body;


        $user = $this->userRepository->getUserByEmail($email);

        throw_if(
            condition: $user,
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "You already signed up "
        );



        $user = $this->userRepository->createOne(
            array_merge(
                $body,
                [
                    "password" => password_hash($password, PASSWORD_ARGON2I)
                ]
            )
        );


        $token = $this->tokenAuthService->encode90DayToken(
            $user
        );

        CookieSender::sendJwtCookieThatExpiresIn90Days($token);


        $email_service = new  EmailService(
            user: $user,
            url: "{$protocol}://{$host}/me",
            from: env("EMAIL_SELF"),
            view: $view
        );

        $email_service->sendWelcome($request);




        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "You are Signed Up",
                "data" => compact("user"),
                "token" => $token,
            ],
            status: CommonHTTPStatusCodes::CREATED
        );
    }

    #[
        Post(Paths::FORGOT_PASSWORD, RouteNamesEnum::FORGOT_PASSWORD,),
        EmailValidationMiddleware
    ]
    public function forgotPassword(View $view, ServerRequest $request, Response $response): Response

    {

        $body = $request->getParsedBody();

        list("email" => $email) = $body;

        $route_context =
            RouteContext::fromRequest($request);
        $route_context = RouteContext::fromRequest($request);


        $user = $this->userRepository->getUserByEmail($email);


        throw_unless(
            condition: $user,
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "You aren't signed up to this site please sign up "
        );

        $date_format = (new DateTimeImmutable())
            ->modify("+10 min")
            ->format(DateTimeInterface::RFC3339_EXTENDED);

        $reset_token = $user->createResetToken($email);

        $user->setResetToken($reset_token)
            ->setPasswordResetExpires($date_format)
            ->saveChanges();

        $reset_token_url = $route_context
            ->getRouteParser()
            ->fullUrlFor(
                uri: $request->getUri(),
                routeName: RouteNamesEnum::RESET_PASSWORD,
                data: ["token" => "{$reset_token}"]
            );


        $email_service = new EmailService(
            user: $this->userRepository->getOne($user->getId()),
            url: $reset_token_url,
            from: env("EMAIL_FROM"),
            view: $view,
        );


        $email_service->sendResetPassword($request);



        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Token sent to mail",
            ]
        );
    }


    #[
        Patch(
            Paths::UPDATE_MY_PASSWORD,
            RouteNamesEnum::UPDATE_MY_PASSWORD,
        ),
        RouteRestrictionMiddleware(["user",]),
        TokenAuthMiddleware,
        PasswordCurrentPasswordAndPasswordConfirmValidationMiddleware
    ]
    function updateMyPassword(ServerRequest $request, Response $response): Response
    {

        list(
            "password" => $password,
            "password-current" => $password_current
        ) = $request->getParsedBody();

        list("email" => $email) = $request->getAttribute("claims");


        $user = $this->userRepository->getUserByEmail($email);


        throw_unless(
            condition: password_verify($user->getPassword(), $password_current),
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "Invalid credentials "
        );

        $user->setPassword($password)->saveChanges();

        $token = $this->tokenAuthService->encode90DayToken(
            $this->userRepository->getOne($user->getId())->toArray(),
        );

        CookieSender::sendJwtCookieThatExpiresIn90Days($token);

        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Password Updated",
                "token" => $token

            ]
        );
    }


    #[
        Post(Paths::RESET_PASSWORD, RouteNamesEnum::RESET_PASSWORD,),
        PasswordAndPasswordConfirmValidationMiddleware
    ]
    function resetPassword(ServerRequest $request, Response $response, string $token): Response
    {
        $body = $request->getParsedBody();


        list("password-confirm" => $password_confirm) = $body;


        $user = $this->userRepository->getUserByResetToken($token);

        throw_unless(
            condition: $user,
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "You aren't signed up to this site please sign up "
        );




        throw_if(
            condition: $user->checkIfTokenExpirationIsGreaterThanNow(new DateTime()),
            exception: HttpUnauthorizedException::class,
            request: $request,
            message: "Your password  reset token has expired please get a new one",
        );

        $user->setPassword($password_confirm)->saveChanges();


        return $response->withJson(
            data: [
                "status" => "success",
                "message" => "Your password was reset",
            ]
        );
    }
}

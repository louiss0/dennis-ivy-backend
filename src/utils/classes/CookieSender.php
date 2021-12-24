<?php


namespace Src\Utils\Classes;

final class CookieSender
{

    const JWT = "jwt";

    const NINETY = 90;

    /** 

@param string $name  
@param string $token  

@param int $number_of_days  

@param string $php_env  The php env variable either development or production  

     */
    private static function send_secure_cookie(
        string $name,
        string $token,
        int $number_of_days,
        string $php_env,
    ) {

        $one_day = 24 * 60 ** 2 * 1000;

        $expires = time()  + $one_day * $number_of_days;

        $cookieOptions = [
            "secure" => false,
            "httpOnly" => true,
            "expires" => $expires,
        ];

        if ($php_env === "production") {

            $cookieOptions = array_merge(
                $cookieOptions,
                ["secure" => true]
            );

            return setcookie(
                $name,
                $token,
                $cookieOptions
            );
        }

        setcookie($name, $token, $cookieOptions);
    }

    public static function sendJwtCookieThatExpiresIn90Days(string $token): void
    {
        # code...

        self::sendJwtCookie($token,  self::NINETY);
    }

    static public function sendJwtCookie(
        string $token,
        int $number_of_days,
    ): void {
        # code...
        list("PHP_ENV" => $php_env) = $_ENV;

        self::send_secure_cookie(self::JWT, $token, $number_of_days, $php_env);
    }
}

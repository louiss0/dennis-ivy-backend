<?php

namespace Src\App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Html2Text\Html2Text;
use Psr\Http\Message\ServerRequestInterface;
use SendGrid;
use SendGrid\Mail\Mail;
use Slim\Exception\HttpInternalServerErrorException;
use Src\Utils\Classes\View;

final class EmailService
{


    const ZERO = 0;

    public  function __construct(
        private mixed $user,
        private string $url,
        private string $from,
        private View $view

    ) {
    }

    private function phpMailerSend(
        string $template,
        string $subject,
        array $data
    ) {
        # code...

        $body = $this->view->render($template, $data);

        $mailer = new PHPMailer(true);


        $html_2_text = new Html2Text($body);

        list("email" => $email) = $this->user;

        $mailer->isSMTP();

        $mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        $mailer->SMTPAuth = true;
        $mailer->Host = env("EMAIL_HOST");
        $mailer->Username = env("EMAIL_USERNAME");
        $mailer->Password = env("EMAIL_PASSWORD");
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port = intval(env("EMAIL_PORT"));

        $mailer->setFrom($this->from);
        $mailer->addAddress($email);
        $mailer->isHTML();
        $mailer->Subject = $subject;
        $mailer->Body = $body;
        $mailer->AltBody = $html_2_text->getText();
        $mailer->addCC($email);
        $mailer->addBCC($email);
        $mailer->send();
    }


    private function sendGridSend(
        string $template,
        string $subject,
        array $data
    ) {
        # code...

        $body = $this->view->__invoke($template, $data);

        $email = new Mail();

        $email->setFrom($this->from);
        $email->addTo($this->user["email"]);
        $email->setSubject($subject);
        $email->addContent("text/html", $body);
        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

        $response = $sendgrid->send($email);
    }

    public function send(
        string $template,
        string $subject,
        array $data = [],
    ) {
        # code...

        if (env("PHP_ENV") === "development") {
            # code...

            return $this->phpMailerSend($template, $subject, $data);
        }

        return $this->sendGridSend($template, $subject, $data);
    }

    public function sendWelcome(ServerRequestInterface $request): void
    {

        try {

            $data = [
                "name" => "Shelton Louis",
                "url" => $this->url,
                "blog" => "Web Blog",
                "email" => $this->user["email"],
            ];
            $this->send("email.welcome", "Welcome to My Blog", $data);
        } catch (Exception $e) {

            throw new HttpInternalServerErrorException(
                request: $request,
                message: "Email not sent please try again later",
                previous: $e
            );
        }
    }

    public function sendResetPassword(ServerRequestInterface $request): void
    {
        try {

            $data = [
                "url" => $this->url,
                "name" => $this->user["name"]
            ];

            $this->send("email.reset-password", "The Reset Password", $data);
        } catch (Exception $e) {

            throw new HttpInternalServerErrorException(
                request: $request,
                message: "Email not sent please try again later",
                previous: $e
            );
        }
    }
}

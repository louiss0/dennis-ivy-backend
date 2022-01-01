<?php

namespace Src\App\Services;

use DateTimeImmutable;
use DateTimeInterface;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpUnauthorizedException;

class TokenAuthService
{

    private Configuration $configuration;

    public function __construct()
    {

        $key = InMemory::base64Encoded(env("LCOUBUCCI_KEY"));

        $signer = new Sha256();

        $config = Configuration::forSymmetricSigner(
            $signer,
            $key

        );

        $config->setValidationConstraints(
            new SignedWith($signer, $key),
            new IssuedBy(env("JWT_SECRET", ""))
        );

        $this->configuration = $config;
    }
    function encode(
        array $claims,
        DateTimeInterface $now,
        DateTimeInterface $expires_in,
    ): string {
        # code...



        [$signingKey, $signer, $builder,] = [
            $this->configuration->signingKey(),
            $this->configuration->signer(),
            $this->configuration->builder(),
        ];


        array_walk(
            callback: fn (mixed $value,  string $key) =>
            $builder->withClaim($key, $value),
            array: $claims
        );

        return $builder
            ->issuedAt($now)
            ->issuedBy(env("JWT_SECRET"))
            ->expiresAt($expires_in)
            ->getToken($signer, $signingKey)
            ->toString();
    }
    function encode90DayToken(array $claims): string
    {

        $now = new DateTimeImmutable();

        return $this->encode($claims, $now, $now->modify("+90 days"));
    }


    public  function decodeToken(string $token): UnencryptedToken
    {

        $parsed_token = $this->configuration
            ->parser()
            ->parse($token);

        return $parsed_token;
    }

    public function verifyToken(ServerRequestInterface $request, string $token): self
    {

        $config = $this->configuration;
        assert($config instanceof Configuration);

        $token = $config->parser()->parse($token);

        assert($token instanceof UnencryptedToken);

        $constraints = $config->validationConstraints();

        try {
            $config->validator()->assert($token, ...$constraints);
        } catch (RequiredConstraintsViolated $e) {

            // list of constraints violation exceptions:
            throw new HttpUnauthorizedException($request, json_encode($e->violations()), $e);
        } finally {

            return $this;
        }
    }


    public function checkIfTokenIsExpired(
        ServerRequestInterface $request,
        string $token
    ) {



        $parsed_token = $this->decodeToken($token);


        $exp = $parsed_token->claims()->get("exp");

        $date = new DateTimeImmutable();

        $difference_in_exp_days = $date->diff($exp)->days;


        $difference_in_exp_days_is_zero =
            $difference_in_exp_days === 0;


        throw_if(
            $difference_in_exp_days_is_zero,
            HttpUnauthorizedException::class,
            $request,
            "You are signed in please sign in or sign up"
        );
    }


    public function getClaimsFromToken(string $token)
    {
        # code...

        $parsed_token = $this->decodeToken($token);


        return $parsed_token->claims()->all();
    }

    public function getRoleFromToken(string $token): string
    {
        # code...

        $parsed_token = $this->decodeToken($token);


        $role = $parsed_token->claims()->get("role");


        return $role;
    }
}

<?php

declare(strict_types=1);

namespace Src\App\Models;

use DateTime;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class User extends Model
{


    use SoftDeletes;


    const ID = "id";
    const NAME = "name";
    const EMAIL = "email";
    const PASSWORD = "password";
    // TODO: Remember to put admin, staff, and user to the roles 
    const ROLE = "role";


    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
        self::ROLE,
    ];

    protected $guarded = [self::ID];


    protected $hidden = [self::PASSWORD];



    public function getId(): int
    {
        # code...

        return $this->id;
    }

    public function getName(): string
    {
        # code...

        return $this->name;
    }

    public function getEmail(): string
    {
        # code...

        return $this->email;
    }

    public function getRole(): string
    {
        # code...

        return $this->role;
    }


    public function getPassword(): string
    {
        # code...
        return $this->password;
    }

    public function createResetToken()
    {
        # code...


        $bytes = 32;

        list(0 => $first_algo, 6 => $second_algo) = hash_algos();

        $hex_string = random_bytes($bytes);

        $first_string = hash_init($first_algo);

        $second_string =  hash($second_algo, $hex_string);

        hash_update($first_string, $second_string);

        return hash_final($first_string,);
    }



    public function setPasswordResetExpires(string | null $value)
    {
        # code...

        $this->password_reset_expires = $value;

        return $this;
    }


    public function setResetToken(string $value)
    {
        # code...

        $this->reset_token = $value;

        return $this;
    }

    public function setPhoto(string $value)
    {
        # code...

        $this->photo = $value;

        return $this;
    }

    public function updateUser(array $body): bool
    {
        # code...
        return $this->update($body);
    }


    public function saveChanges()
    {
        # code...
        return $this->saveOrFail();
    }

    public function setPassword(string  $password)
    {
        # code...

        $this->password = password_hash($password, PASSWORD_ARGON2I);

        return $this;
    }

    public function checkIfTokenExpirationIsGreaterThanNow(DateTime $date_time)
    {
        # code...


        $password_reset_interval = new DateTimeImmutable($this->password_reset_expires);


        $diff_interval = $date_time->diff($password_reset_interval);

        $seconds = $diff_interval->s;

        $zero = 0;

        $seconds_equals_to_zero = $seconds === $zero;

        return $seconds_equals_to_zero;
    }
}

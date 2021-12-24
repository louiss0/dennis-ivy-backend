<?php

namespace Src\Types\Enums;

class Paths
{

    const VERSION_ONE = "/v1";
    const USERS = "/users";
    const SIGN_UP = "/sign-up";
    const SIGN_IN = "/sign-in";
    const FORGOT_PASSWORD = "/forgot-password";
    const RESET_PASSWORD = "/reset-password/{token:\S+}";
    const UPDATE_MY_PASSWORD = "/update-my-password";
    const SLUG = "/{slug:\S+(?:-\w+)|\w+}";
    const ID = "/{id:\d+}";
    const GET_ME = "/me";
    const UPDATE_ME = "/update-me";
    const DELETE_ME = "/delete-me";
};

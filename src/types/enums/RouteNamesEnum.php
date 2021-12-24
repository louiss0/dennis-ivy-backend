<?php


namespace Src\Types\Enums;


interface RouteNamesEnum
{
    public const SIGN_UP = "sign-up";
    public const SIGN_IN = "sign-in";
    public const FORGOT_PASSWORD = "forgot-password";
    public const RESET_PASSWORD = "reset-password";
    public const UPDATE_MY_PASSWORD = "update-my-password";

    public const GET_USERS = "users";
    public const GET_USER = "user";
    public const CREATE_USER = "create-user";
    public const UPDATE_USER = "update-user";
    public const DELETE_USER = "delete-user";
}

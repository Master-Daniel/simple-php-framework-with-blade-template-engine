<?php

class AuthController
{
    public function login()
    {
        echo "Login Page";
    }

    public function logout()
    {
        echo "Logging Out...";
        session_destroy();
    }
}

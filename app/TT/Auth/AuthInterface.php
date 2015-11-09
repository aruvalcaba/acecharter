<?php namespace TT\Auth;

interface AuthInterface {
    public function login(array $credentials);
}

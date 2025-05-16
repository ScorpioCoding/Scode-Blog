<?php

namespace App\Core;

use App\Core\NewException;
use App\Core\Session;
use App\Core\TokenBasic;


class Auth
{

    public static function sessionUp(object $user): bool
    {
        if ($user) {
            $session = new Session();
            $session->set('auth', 'true');
            $session->set('id', $user->id);
            $session->set('realm', $user->realm);
            $session->set('created', time());
            return true;
            exit;
        }
        return false;
    }

    public static function sessionValide(): bool
    {
        $session = new Session();
        $created = $session->get('created');
        if (!isset($created)) {
            return false;
            exit;
        }

        if (time() - $created > 1800) {
            session_regenerate_id(true);
            return false;
            exit;
        }

        $auth = $session->get('auth');
        if (!isset($auth) || $auth == false) {
            return false;
            exit;
        }

        return true;
    }

    public static function getSession(string $arg)
    {
        $str = (new Session())->get($arg);
        return $str;
    }

    public static function sessionDown(): bool
    {
        $rtn = false;
        try {
            $session = new Session();
            $session->remove('auth');
            $session->remove('id');
            $session->remove('realm');
            $session->clear();
            $session->destroy();
            $rtn = true;
        } catch (NewException $e) {
            echo $e->getErrorMsg();
            $rtn = false;
        }
        return $rtn;
    }

    /**
     * 
     */
    public static function isAuthMethod(string $method)
    {
        $state = false;

        if ($_SERVER['REQUEST_METHOD'] === strtoupper($method)) {
            $state = true;
        }

        return $state;
    }

    /**
     * 
     */
    public static function isAuthByTokenBasic(array $headers)
    {
        $state = false;
        if (isset($headers['Authorization'])) {
            $authorizationHeader = $headers['Authorization'];

            $token = TokenBasic::getTokenBasic($authorizationHeader);
            if (TokenBasic::validateTokenBasic($token)) {
                $state = true;
            }
        }
        return $state;
    }

    public static function createTokenBasic(string $email, string $psw)
    {
        return TokenBasic::setTokenBasic($email, $psw);
    }

    public static function validateTokenBasic(string $token)
    {
        $state = false;
        if (TokenBasic::validateTokenBasic($token)) {
            $state = true;
        }
        return $state;
    }



    //
    //END CLASS
}
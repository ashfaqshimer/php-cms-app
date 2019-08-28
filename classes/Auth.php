<?php

class Auth
{
    /**
     * Return the user authenticated status
     *
     * @return boolean True if a user is logged in, false otherwise
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    /**
     * Provide authorization to the route
     *
     * @return void
     */
    public static function requireLogin()
    {
        if (!static::isLoggedIn()) {
            die('Unauthorized.');
        }
    }

    /**
     * Login the user
     *
     * @return void
     */
    public static function login()
    {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
    }

    /**
     * Logout the user
     *
     * @return void
     */
    public static function logout()
    {
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
    }
}

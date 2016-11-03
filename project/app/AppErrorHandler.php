<?php

/**
 * Class AppErrorHandler
 *
 * @author olsav <olsav@ciklum.com>
 */
class AppErrorHandler
{
    /**
     * @var array
     */
    private static $errorArray = [
        E_ERROR,
        E_PARSE,
        E_CORE_ERROR,
        E_COMPILE_ERROR,
        E_RECOVERABLE_ERROR
    ];

    /**
     * Register function
     */
    public static function register($errorEmail = null, array $errorArray = null)
    {
        $errorEmail = is_array($errorEmail) ? $errorEmail : [$errorEmail];
        if (0 === count($errorEmail)) {
            return;
        }
        register_shutdown_function(
            function ($errorEmail, $errorArray) {
                $lastError = error_get_last();
                if (is_array($lastError) && in_array($lastError['type'], $errorArray)) {
                    if (isset($_SERVER['REMOTE_ADDR'])) {
                        header('HTTP/1.1 500 Internal Server Error');
                    }
                    echo '<h1>Internal server error</h1>';

                    $description = $lastError['message'] . ' in ' . $lastError['file'] . '(' . $lastError['line'] . ')';
                    $description .= "\n";
                    $description .= "\nSERVER: " . print_r($_SERVER, true);
                    if (isset($_SERVER['REMOTE_ADDR'])) {
                        $description .= "Remote addr: " . $_SERVER['REMOTE_ADDR'] . "\n";
                    }

                    switch ($lastError['type']) {
                        case E_ERROR:
                            $subject = 'Fatal error (E_ERROR)';
                            break;
                        case E_PARSE:
                            $subject = 'Fatal error (E_PARSE)';
                            break;
                        case E_CORE_ERROR:
                            $subject = 'Fatal error (E_CORE_ERROR)';
                            break;
                        case E_COMPILE_ERROR:
                            $subject = 'Fatal error (E_COMPILE_ERROR)';
                            break;
                        case E_RECOVERABLE_ERROR:
                            $subject = 'Fatal error (E_RECOVERABLE_ERROR)';
                            break;
                        default:
                            $subject = 'Fatal error';
                    }
                    foreach ($errorEmail as $email) {
                        mail($email, $subject, $description);
                    }
                }
            },
            $errorEmail,
            (is_null($errorArray) ? self::$errorArray : $errorArray)
        );
    }
}
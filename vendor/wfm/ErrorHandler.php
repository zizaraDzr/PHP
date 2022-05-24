<?php

namespace wfm;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        // Задаёт пользовательский обработчик исключений
        set_exception_handler([$this, 'exceptionHandler']);
        // устанавливаем пользовательский обработчик ошибок
        set_error_handler([$this, 'errorHandler']);
        // включаем буфферизацию вывода (вывод скрипта сохраняется во внутреннем буфере)
        ob_start();
        // регистрируем функцию, которая выполняется после завершения работы скрипта (например, после фатальной ошибки)
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }
    /**
     * Функция перехвата фатальных ошибок
     */
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        // если была ошибка и она фатальна
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            // очищаем буффер (не выводим стандартное сообщение об ошибке)
            ob_end_clean();
            // запускаем обработчик ошибок
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            // отправка (вывод) буфера и его отключение
            ob_end_flush();
        }
    }

    public function exceptionHandler(\Throwable $e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }
    /**
     * Функция Записи ошибок в файл error.log
     */
    protected function logError($message = '42', $file = '', $line = '')
    {
        file_put_contents(
            LOGS . '/error.log',
            "[" . date('Y-m-d H:d:s') . "] ТЕКСТ Ошибки: {$message} | Файл: {$file} | Строка {$line}\n===\n",
            FILE_APPEND
        );
    }
    /**
     * Функция показа ошибок
     */
    protected function displayError($errorno, $errorstr, $errorfile, $errorline, $response = 500)
    {
        if ($response == 0) {
            $response = 404;
        }
        http_response_code($response);
        if ($response == 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require_once WWW . '/errors/development.php';
        } else {
            require_once WWW . '/errors/production.php';
        }
        die;
    }
}

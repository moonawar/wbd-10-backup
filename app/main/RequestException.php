<?
class RequestException extends Exception
{
    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
        $this->log($message, $code);
    }

    private function log($message, $code)
    {
        error_log('[ERROR CODE: ' . $code . '] ' . $message);
    }
}
?>
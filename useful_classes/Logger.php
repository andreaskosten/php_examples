<?php

class Logger
{
    private static $filename = "";
    private static $instance = null;
    protected function __construct(){}

    public static function getInstance(): Logger
    {
        if( !isset(self::$instance) ){
            self::$instance = new static();
            $time = date('Y-m-d_H-i-s');
            self::$filename = "logs/LoggerLog_".$time.".txt";
            file_put_contents(self::$filename, "created at ".$time."\n");
        }
        return self::$instance;
    }

    public function logAppend($text, $breaks=1)
    {
        $breaksString = "";
        for( $i = 0; $i < $breaks; $i++ ){
            $breaksString .= "\n";
        }

        file_put_contents(self::$filename, $breaksString.$text, FILE_APPEND);
    }
}

/*
USE:
Logger::getInstance()->logAppend("some_text");
*/

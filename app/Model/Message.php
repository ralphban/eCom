<?php

namespace app\Model;

class Message
{
    public $name;
    public $email;
    public $message;
    public $IP;
    
    public function __construct($object = null) {
        if ($object == null)
            return;
    
        // Check if properties exist before assigning them
        $this->name = isset($object->name) ? $object->name : null;
        $this->email = isset($object->email) ? $object->email : null;
        $this->message = isset($object->message) ? $object->message : null;
        $this->IP = isset($object->IP) ? $object->IP : null;
    }

    public function readMessages()
    {
        $filename = 'resources/messages.txt';
        $messages = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $result = [];
        foreach ($messages as $record) {
            $object = json_decode($record);
            $person = new \app\Model\Message($object);
            $result[] = $person;
        }

        return $result;
    }

    public function write()
    {
        $filename = 'resources/messages.txt'; // Correct the file path
        $file_handle = fopen($filename, 'a');
        if ($file_handle) {
            flock($file_handle, LOCK_EX);
            $data = json_encode($this);
            fwrite($file_handle, $data . "\n"); // Correct the concatenation operator
            flock($file_handle, LOCK_UN);
            fclose($file_handle);
            return true; // Return true on success
        } else {
            return false; // Return false if unable to open the file
        }
    }
}

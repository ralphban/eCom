<?php

namespace app\controllers;

use app\Model\Message;

class ContactController extends \app\core\Controller {

    public function contactIndex() {
        return $this->view('Contact/index');
    }

    public function read() {
        $messageInstance = new Message(); // Create an instance of the Message class
        $messages = $messageInstance->readMessages(); 
        $this->view('Contact/read', $messages);
    }
    
    public function submitForm()
{
    // Check if both email and message are provided
    if(isset($_POST['email']) && isset($_POST['message'])) {
        // Extract data from $_POST
        $email = $_POST['email'];
        $messageContent = $_POST['message'];

        // Get IP address
        $IP = $_SERVER['REMOTE_ADDR'];

        // Create a new Message object
        $message = new \app\Model\Message();
        $message->email = $email;
        $message->message = $messageContent;
        $message->IP = $IP;

        // Write message to file
        if($message->write()) {
            // Redirect to Contact/read
            header('Location: /Contact/read');
            exit;
        } else {
            // Handle error
            echo "Error occurred while writing message.";
        }
    } else {
        // Handle case when email or message is not provided
        echo "Email and message are required.";
    }
}
}
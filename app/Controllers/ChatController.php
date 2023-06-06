<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use App\Models\UsersModel;

class ChatController extends BaseController
{
    public function send()
    {
        $messageModel = new ChatModel();
    
        $jsonData = $this->request->getJSON();

        $message = $jsonData->message;
        $receiverId = $jsonData->receiver_id;
        $senderId = $jsonData->sender_id;

        $messageModel->insert([
            'sender_id'   => $senderId,
            'receiver_id' => $receiverId,
            'message'     => $message
        ]);
    
        return $this->response->setJSON(['success' => true]);
    }

    public function fetchUser()
    {
        $model = new UsersModel();
        return $this->response->setJSON($model->find(session()->get('id')));
    }

    public function fetchUserList()
    {
        $model = new UsersModel();
        return $this->response->setJSON($model->where('id !=', session()->get('id'))->findAll());
    }
    
    public function load()
    {
        $messageModel = new ChatModel();
        $senderId = $this->request->getGet('sender_id');
        $receiverId = $this->request->getGet('receiver_id');
        $messages = $messageModel
            ->where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->orWhere('sender_id', $receiverId)
            ->where('receiver_id', $senderId)
            ->findAll();

        return $this->response->setJSON($messages);
    }
}

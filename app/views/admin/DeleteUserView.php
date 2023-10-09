<?php

class DeleteUserView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        if (isset($this->data['username'])) {
            require_once __DIR__ . '/../../pages/admin/DeleteUserPage.php';
        }
    }
}

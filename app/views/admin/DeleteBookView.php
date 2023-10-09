<?php

class DeleteBookView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        if (isset($this->data['book_id'])) {
            require_once __DIR__ . '/../../pages/admin/DeleteBookPage.php';
        }
    }
}

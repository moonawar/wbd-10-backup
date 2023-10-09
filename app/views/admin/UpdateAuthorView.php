<?php

class UpdateAuthorView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        if (isset($this->data['author_id'])) {
            require_once __DIR__ . '/../../pages/admin/UpdateSpecificAuthorPage.php';
        } else {
            require_once __DIR__ . '/../../pages/admin/UpdateAuthorPage.php';
        }

    }
}

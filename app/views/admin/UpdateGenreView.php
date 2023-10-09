<?php

class UpdateGenreView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        if (isset($this->data['genre_id'])) {
            require_once __DIR__ . '/../../pages/admin/UpdateSpecificGenrePage.php';
        } else {
            require_once __DIR__ . '/../../pages/admin/UpdateGenrePage.php';
        }
    }
}

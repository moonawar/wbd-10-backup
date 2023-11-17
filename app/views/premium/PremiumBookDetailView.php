<?php

class PremiumBookDetailView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../pages/premium/PremiumBookDetailPage.php';
    }
}

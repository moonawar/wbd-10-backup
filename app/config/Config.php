<?
// URL
define('BASE_URL', 'http://localhost:8000/public');

// Pagination
define('BOOK_PER_PAGES', 8);

// File path
define('PROFILE_PIC_BASE', __DIR__ . '/../storage/profile-base.jpg');
define('BOOK_COVER_PATH', __DIR__ . '/../storage/image/book_cover/');
define('PROFILE_PIC_PATH', __DIR__ . '/../storage/image/profile_pic/');
define('AUDIOBOOK_PATH', __DIR__ . '/../storage/audio/');

// File config
define('ALLOWED_AUDIOS', [
    'audio/mpeg' => '.mp3',
]);

define('ALLOWED_IMAGES', [
    'image/jpeg' => '.jpg',
    'image/png' => '.png'
]);
?>
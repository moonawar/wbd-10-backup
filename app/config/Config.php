<?
// URL
define('BASE_URL', 'http://localhost:8000/public');
define('PROFILE_IMAGE_BASE', 'http://localhost:8000/storage/profile-base.jpg');

// Pagination
define('BOOK_PER_PAGES', 10);

// File path
define('BOOK_COVER_PATH', 'http://localhost:8000/storage/image/book_cover/');
define('PROFILE_PIC_PATH', 'http://localhost:8000/storage/image/profile_pic/');
define('AUDIOBOOK_PATH', 'http://localhost:8000/storage/audio/');

// File config
define('ALLOWED_AUDIOS', [
    'audio/mpeg' => '.mp3'
]);

define('ALLOWED_IMAGES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png'
]);
?>
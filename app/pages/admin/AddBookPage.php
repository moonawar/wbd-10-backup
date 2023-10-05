<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="180x180" href="<?= BASE_URL ?>/icon/favicon-110.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/icon/favicon-32.png">
    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/globals.css">
    <!-- Navbar CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/template/navbar.css">
   <!-- Page-specific CSS -->
   <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin/crud-page.css">
    <title>Add Book</title>
</head>
<body>
    <!-- Navigation bar -->
    <?php include(dirname(__DIR__) . '../../components/Navbar.php') ?>
  <div class="content">
    <h2>Add Book Page</h2>
    <form class="form-box center-contents">
      <div class="form-content flex-column">
        <label class="form-label" for="title">Judul:</label>
        <input class="form-field" type="text" id="title" name="title" required>

        <label class="form-label" for="year">Tahun Terbit:</label>
        <input class="form-field" type="number" id="year" name="year" required>

        <label class="form-label" for="author">Penulis:</label>
        <input class="form-field" type="text" id="author" name="author" required>

        <label class="form-label" for="genre">Genre:</label>
        <input class="form-field" type="text" id="genre" name="genre" required>

        <label class="file-upload form-label" for="image">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <label class="file-upload form-label" for="audio">Audio:</label>
        <input type="file" id="audio" name="audio" accept="audio/*" required>
        <button type="submit" class="button green-button">Add</button>
      </div>
    </form>
  </div>
</body>
</html>

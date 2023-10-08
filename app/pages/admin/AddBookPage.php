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
    <br><br><br>
    <h2>Add Book Page</h2>
    <form 
      class="form-box center-contents"
      action="/book/add" method="POST" enctype="multipart/form-data"
    >
      <div class="form-content flex-column">
        <label class="form-label" for="title">Title:</label>
        <input class="form-field" type="text" id="title" name="title" required>

        <label class="form-label" for="year">Year Published:</label>
        <input class="form-field" type="number" id="year" name="year" required>

        <label class="form-label" for="summary">Summary:</label>
        <textarea 
          class="text-area" type="text" id="summary" name="summary" 
          rows="5" cols="50" required
        > </textarea>

        <label class="form-label" for="authors[]">Authors:</label>
        <input class="form-field" type="number" id="author" name="authors[]" required>

        <label class="form-label" for="genres[]">Genres:</label>
        <input class="form-field" type="number" id="genre" name="genres[]" required>

        <label class="form-label" for="price">Price:</label>
        <input class="form-field" type="number" id="price" name="price" required>

        <label class="file-upload form-label" for="cover">Book Cover:</label>
        <input type="file" id="image" name="cover" accept="image/png, image/jpeg" required>

        <label class="file-upload form-label" for="audio">Audio:</label>
        <input type="file" id="audio" name="audio" accept="audio/mpeg" required>
        <button type="submit" class="button green-button">Add</button>
      </div>
    </form>
  </div>
</body>
</html>

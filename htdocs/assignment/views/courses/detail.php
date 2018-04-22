<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "../share/head.php" ?>
  <title>Edit Course</title>
</head>

<script src="/js/courses/detail.js"></script>

<style>
  #edit-form {
    width: 50%;
    margin: 0 auto;
  }
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "../share/header.php" ?>
    </header>
    <div id="edit-form">
      <form>
        <div class="form-group">
          <label for="code">Course code:</label>
          <input type="text" class="form-control" id="code" placeholder="Course code" name="code" disabled required>
        </div>
        <div class="form-group">
          <label for="name">Course name:</label>
          <input type="text" class="form-control" id="name" placeholder="Course name" name="name" required>
        </div>
        <div class="text-right">
          <button type="submit" id="btn-save" class="btn btn-primary">
            <i class="fa fa-edit" aria-hidden="true"></i> Save</button>
        </div>
      </form>
    </div>
    <footer>
      <?php include_once "../share/footer.php" ?>
    </footer>
  </div>
</body>
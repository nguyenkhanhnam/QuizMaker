<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "../share/import.php" ?>
  <title>Add Course</title>
</head>

<script src="/js/courses/create.js"></script>

<style>
  #login-form {
    width: 50%;
    margin: 0 auto;
  }

  #forgot {
    text-decoration: none;
    display: inline;
  }
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "../share/header.php" ?>
    </header>
    <div id="login-form">
      <form>
        <div class="form-group">
          <label for="code">Course code:</label>
          <input type="text" class="form-control" id="code" placeholder="Course code" name="code" required>
        </div>
        <div class="form-group">
          <label for="name">Course name:</label>
          <input type="text" class="form-control" id="name" placeholder="Course name" name="name" required>
        </div>
        <div class="text-right">
          <button type="button" id="btn-add" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Add Course</button>
        </div>
      </form>
    </div>
    <footer>
      <?php include_once "../share/footer.php" ?>
    </footer>
  </div>
</body>
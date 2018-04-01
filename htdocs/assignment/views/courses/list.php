<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "../share/import.php" ?>
  <title>List Course</title>
</head>

<script src="/js/courses/list.js"></script>

<style>
  #course-table {
    width: 50%;
    margin: 0 auto;
  }

  tbody > tr {
    cursor: pointer;
  }
</style>

<body>
  <div class="container">
    <header>
      <?php include_once "../share/header.php" ?>
    </header>

    <table class="table table-striped" id="course-table">
      <thead>
        <tr>
          <th>Course Code</th>
          <th>Course Name</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    <footer>
      <?php include_once "../share/footer.php" ?>
    </footer>
  </div>
</body>
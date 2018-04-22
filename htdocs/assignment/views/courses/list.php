<!DOCTYPE html>
<meta charset="utf-8" />
<html lang="en">

<head>
  <?php include_once "../share/head.php" ?>
  <title>List Course</title>
</head>

<?php
    if(isset($_SESSION['token']) && $_SESSION['token']!=''){
      $token = $_SESSION['token'];
      if(isLoggedIn($token)){
      
      }
      else {
        return header('location:/');
      }
    }
    else {
      return header('location:/');
    }
?>

<script src="/js/courses/list.js"></script>

<style>
  #course-table {
    width: 100%;
    margin: 0 auto;
  }

  tbody > tr {
    cursor: pointer;
  }
</style>


    

    <table class="table table-striped" id="course-table">
      <thead>
        <tr>
          <th>Code</th>
          <th>Course Name</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>


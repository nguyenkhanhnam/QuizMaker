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
<style>
  #course-table {
    width: 100%;
    margin: 0 auto;
  }

  tbody>tr {
    cursor: pointer;
  }
</style>

<table class="table" id="course-table">
  <thead>
    <tr>
      <th>Code</th>
      <th>Course Name</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<script src="/js/courses/list.js"></script>
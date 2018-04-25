﻿<style>
  #create-form {
    width: 50%;
    margin: 0 auto;
  }
</style>

<body>
  <div id="create-form">
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
</body>

<script src="/js/courses/create.js"></script>
<style>
  #edit-form {
    width: 100%;
    margin: 0 auto;
  }

  #btn-save, #btn-delete {
    display: none;
    width: 90px;
  }
</style>


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
    <div class="pull-left">
        <button type="button" id="btn-delete" class="btn btn-danger">
          <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
      </div>
    <div class="pull-right">
      <button type="submit" id="btn-save" class="btn btn-primary">
        <i class="fa fa-edit" aria-hidden="true"></i> Save</button>
    </div>
  </form>
</div>

<script src="/js/courses/detail.js"></script>
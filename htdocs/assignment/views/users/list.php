<?php include_once "../share/head.php" ?>
<header>
  <?php include_once "../share/header.php" ?>
</header>
<?php 
require 'db.php';
$sql = 'SELECT * FROM users';
$statement = $connection->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_OBJ);
?>



<div>
  <div>
    <h2>All users</h2>
  </div>
  <div align="middle">
    <form action="results.php" method="POST" >
      <input type="text" name="search" placeholder="Search for users...">
      <button class="btn btn-success" type="submit"> <i class ="glyphicon glyphicon-search"></i></button> 
    </form>
  </div>  
  <p></p>

  <div class="card-body">
    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
      <?php foreach($users as $user): ?>
        <tr>
          <td><?=$user->id?></td>
          <td><?=$user->username?></td>
          <td><?=$user->role?></td>
          <td>
            <a href="edit.php?id=<?= $user->id ?>" class="btn btn-info">Edit</a>
            <a onclick="return confirm('Are you sure you want to delete this user?')" href="delete.php?id=<?= $user->id ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php include_once "../share/footer.php" ?>
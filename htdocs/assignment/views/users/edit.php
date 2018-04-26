<?php 
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM users WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id'=>$id]);
$user = $statement->fetch(PDO::FETCH_OBJ);

if(isset($_POST['username']) /*&& isset($_POST['password'])*/){
	$username = $_POST['username'];
	/*$password = $_POST['password'];*/
	$role = $_POST['radio'];

	$sql = 'UPDATE users SET username=:username, role=:role WHERE id=:id';
	$statement = $connection->prepare($sql);
	if($statement->execute([':username'=>$username,
							/*':password'=>$password,*/
							':role'=>$role,
							':id'=>$id])){
		header("Location: ../crud/index.php");
	}
}
?>


<?php require 'header.php'; ?>
<div class="card">
	<div class="card-header">
		<h2>Update user</h2>
	</div>

	<div class="card-body">
		<?php if(!empty($message)): ?>
			<div class="alert alert-success">
				<?= $message; ?>
			</div>
		<?php endif; ?>

		<form method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<input value="<?=$user->username;?>" type="text" name="username" id="username" class="form-control">
			</div>
			<!-- <div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control">
			</div> -->
			<div class="form-group">
            	<label>Role</label>
            	<div>
	                <label class="radio-inline">
	                  <input type="radio" name="radio" value="0"> Admin
	                </label>
	                <label class="radio-inline">
	                  <input type="radio" name="radio" value="1" checked="checked"> User
	                </label>
	                <label class="radio-inline">
	                  <input type="radio" name="radio" value="2"> Staff
	                </label>
	            </div>
            </div>
            <div class="form-group">
				<button type="submit" class="btn btn-info">Update</button>
			</div>
		</form>
	</div>
</div>
<?php require 'footer.php'; ?>
<?php 
require 'db.php';
$message = '';
if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['radio'];

	$sql = 'INSERT INTO users(username, password, role) VALUES(:username, :password, :role)';
	$statement = $connection->prepare($sql);
	if($statement->execute([':username'=>$username,
							':password'=>$password,
							':role'=>$role])){
		$message = 'data inserted successfully';
	}
}
?>


<?php require 'header.php'; ?>
<div class="card">
	<div class="card-header">
		<h2>Create a user</h2>
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
				<input type="text" name="username" id="username" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control">
			</div>
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
				<button type="submit" class="btn btn-info">Create a user</button>
			</div>
		</form>
	</div>
</div>
<?php require 'footer.php'; ?>
<head>
	<?php include_once "../share/head.php" ?>
	<title>View Question</title>
</head>
<header>
	<?php include_once "../share/header.php" ?>
</header>
<body>
  <div class="container">
    <div class="form-group">
					<label for="question">Course:</label>
					<br>
					<select id="courses" name="code">
					</select>
		</div>
    <label for="difficult">Difficult: </label>
      <select class="form-group" id="difficult">
        <option value="0">Easy</option>
        <option value="1">Medium</option>
        <option value="2">Hard</option>
        <option value="3" selected>All</option>
      </select>
      <table id="question-table" class="table table-bordered">
        <thead>
          <tr>
            <th>Difficult</th>
            <th>Question</th>
            <th></th>
          </tr>
        </thead>
    	</table>
  </div>		
</body>
<footer>
		<?php include_once "../share/footer.php" ?>
</footer>
</html>

<script src="/js/questions/list.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


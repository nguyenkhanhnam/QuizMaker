<head>
	<?php include_once "../share/head.php" ?>
	<title>Quiz Maker</title>
</head>

<style>
	#form-center {
		width: 50%;
		margin: 0 auto;
	}

	#forgot {
		text-decoration: none;
		display: inline;
	}

	.ques {
		margin-right: 20%;
		margin-left: 20%;
		margin-top: 10px;
	}
</style>

<body>
	<div class="container">
		<header>
			<?php include_once "../share/header.php" ?>
		</header>
		<div class="ques">
			<p class="text-center" style="font-size: 80px">Create exam</p>
			<form id="create-form" class="form-horizontal" method="POST" action="/api/make_paper.php">
				<div class="form-group">
					<label for="courses">Course:</label>
					<br>
					<select id="courses" name="code">
					</select>
				</div>
				<div class="form-group">
					<b>Question number:</b>
					<div class="row">
						<div class="col-sm-3">
							<label for="easy">Easy:</label>
							<input class="form-control" id="easy" type="number" name="easy_num" min="0" value="0">
						</div>
						<div class="col-sm-3">
							<label for="medium">Medium:</label>
							<input class="form-control" id="medium" type="number" name="medium_num" min="0" value="0">
						</div>
						<div class="col-sm-3">
							<label for="hard">Hard:</label>
							<input class="form-control" id="hard" type="number" name="hard_num" min="0" value="0">
						</div>
						<div class="col-sm-3">
							<label>Total:</label>
							<input class="form-control" id="total" type="number" value="0" disabled>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<label for="date">Exam Date:</label>
							<div class="date">
								<input type="text" class="form-control" name="date" id="datePicker" required/>
							</div>
						</div>
						<div class="col-sm-6">
							<label for="patch-num">Number of patch:</label>
							<input type="number" class="form-control" name="patch_num" value="1" min="1">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label for="duration">Duration (minute):</label>
							<input type="number" class="form-control" name="duration" min="0" value="0" required/>
						</div>
						<div class="col-sm-9">
							<label for="note">Note:</label>
							<input type="text" class="form-control" name="note" placeholder= "Allow book or not, ....">
						</div>
					</div>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary">Make exam paper</button>
				</div>
			</form>
		</div>
		<footer>
			<?php include_once "../share/footer.php" ?>
		</footer>
	</div>
</body>

<script>
	$(document).ready(function () {
		$.ajax({
        type: 'GET',
        url: '/api/courses',
        dataType: 'json',

        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var str = res.responseText.trim()
                var courses = JSON.parse(str)
                console.log(courses)
                courses.forEach(course => {
                    $('#courses')
                        .append($("<option></option>")
                            .attr("value", course.code)
                            .text(course.name + ' (' + course.code + ')'))
                })
                $('#courses').select2()
            }
        }
    })

		$('#datePicker').datepicker({
			format: 'dd/mm/yyyy',
			startDate: '0',
			daysOfWeekDisabled: '0',
			todayHighlight: true,
			weekStart: 1,
			toggleActive: false,
			autoclose: true,
		}).datepicker('setDate', new Date())
	})

	$("#easy, #medium, #hard").bind("change paste keyup click", function() {
		var total = Number($("#easy").val()) + Number($("#medium").val()) + Number($("#hard").val())
		$("#total").val(total)
	})
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
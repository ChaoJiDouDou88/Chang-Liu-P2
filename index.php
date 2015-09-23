<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
?>

<!DOCTYPE html>
<html>
<head>
  <title>xkcd Password Generator</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href='//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css' rel="stylesheet">
  <?php require 'logic.php'; ?>
  <style>

		.container {
			text-align:center;
		}

		.password {
			text-align:center;
			font-size:3rem;
			margin-bottom:25px;
			color:#f39c12;
			font-family:consolas,courier;
			background-color:#eee;
			display:inline-block;
			padding:15px;
			font-weight:800;
		}

		#number_of_words {
			width:40px;
		}

    #number_of_symbols {
			width:40px;
		}

		.details {
			margin-top:25px;
		}

		.comic {
			width:75%;
			max-width:500px;
		}


	</style>

</head>

<body>


	<div class='container'>
		<h1>xkcd Password Generator</h1>

		<p class='password'>
			<?php echo $result ?>		</p>

		<form method='POST' action='index.php'>
			<p class='options'>
				<label for='number_of_words'># of Words</label>
				<input maxlength=1 type='text' name='number_of_words' id='number_of_words' value=''>  (Max 9)
				<br>
        <label for='number_of_symbols'># of Symbols</label>
				<input maxlength=1 type='text' name='number_of_symbols' id='number_of_symbols' value=''>  (Max 3)
        <br>
				<input type='checkbox' name='add_number' id='add_number' >
				<label for='add_number'>Add a number</label>
        <br>
        <input type='checkbox' name='space' id='space' >
				<label for='space'>Space</label>
        <input type='checkbox' name='hyphen' id='hyphen' >
				<label for='hyphen'>hyphen</label>
        <br>
        <input type='checkbox' name='upper_case' id='upper_case' >
				<label for='upper_case'>All Upper Case</label>
        <input type='checkbox' name='lower_case' id='lower_case' >
				<label for='lower_case'>All Lower Case</label>
        <input type='checkbox' name='first_letter_capitalize' id='first_letter_capitalize' >
				<label for='first_letter_capitalize'>first_letter_capitalize</label>
			</p>

			<input type='submit' class='btn btn-default' value= 'Start Generate'>

		</form>

		<p class='details'>
			<a href='http://xkcd.com/936/'>xkcd password strength</a><br>

			<a href='http://xkcd.com/936/'>
				<img class='comic' src='http://imgs.xkcd.com/comics/password_strength.png' alt='xkcd style passwords'>
			</a>
			<br>
		</p>

	</div>

	<script src='//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>
  <?php  #  Only for debugging
    #echo $result;
    #print_r($_POST);
  ?>
</body>
</html>

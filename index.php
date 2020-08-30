<?php  
	$myHost = "localhost";
    $myUser = "root";
    $myPassword = "";
    $myDatabase = "staehle";
    $connection = new mysqli($myHost, $myUser, $myPassword, $myDatabase);

	if ($connection->connect_error) {
	    die("Connection failed: " . $connection->connect_error);
	}

	$sql = "select * from `staehle` 
	join `chemische_zusammensetzung` 
	on `staehle`.`fk_chemische_zusammensetzung` = `chemische_zusammensetzung`.`id` 
	join `gebrauchseigenschaften` 
	on `staehle`.`fk_gebrauchseigenschaften` = `gebrauchseigenschaften`.`id` 
	join `kosten` 
	on `staehle`.`fk_kosten` = `kosten`.`id` 
	join `schnittgut` 
	on `staehle`.`fk_schnittgut` = `schnittgut`.`id`";
	$result = $connection->query($sql);
	$steelGrades = $result->fetch_all(MYSQLI_ASSOC);
	$scripts = "
		<script>
			let steelGrades = " . json_encode($steelGrades) . ";
		</script>
	";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stahlauswahl</title>
	<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="m-5">
		<h5 class="mb-4">Stellen Sie die Gewichtung der Sortierungskriterien ein.</h5>
		<div class="row">
			<label for="korrosionsbestaendigkeit" class="col-3">Korrosionsbeständigkeit</label>
			<input id="korrosionsbestaendigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="zugschneidhaltigkeit" class="col-3">Zugschneidhaltigkeit</label>
			<input id="zugschneidhaltigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="zugschneidfaehigkeit" class="col-3">Zugschneidfähigkeit</label>
			<input id="zugschneidfaehigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="schneidenwinkel" class="col-3">Stabiler Schneidenwinkel</label>
			<input id="schneidenwinkel" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="zaehigkeit" class="col-3">Zähigkeit, Schockbelastbarkeit</label>
			<input id="zaehigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="schnittguete" class="col-3">Schnittgüte</label>
			<input id="schnittguete" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="anfangsschaerfe" class="col-3">Anfangsschärfe</label>
			<input id="anfangsschaerfe" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="druckschneidhaltigkeit" class="col-3">Druckschneidhaltigkeit</label>
			<input id="druckschneidhaltigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="schneidkantenstabilitaet" class="col-3">Schneidkantenstabilität</label>
			<input id="schneidkantenstabilitaet" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="druckschneidfaehigkeit" class="col-3">Druckschneidfähigkeit</label>
			<input id="druckschneidfaehigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="schaerfbarkeit" class="col-3">Schärfbarkeit</label>
			<input id="schaerfbarkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<div class="row">
			<label for="verschleissbestaendigkeit" class="col-3">Verschleißbeständigkeit</label>
			<input id="verschleissbestaendigkeit" class="col-6" type="range" min="0" max="1000" step="1" oninput="setPercentage(this)" onchange="setPercentage(this)"></input>
		</div>
		<button id="sort" type="button" class="btn btn-info mt-5 mb-4">Sortieren</button>
		<div id="steelGrades" class="pt-3"></div>
	</div>

	<?php echo $scripts; ?>
	<script src="js/index.js"></script>
</body>
</html>
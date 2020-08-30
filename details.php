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
	on `staehle`.`fk_schnittgut` = `schnittgut`.`id`
	where `staehle`.`mainId` = {$_GET['id']}";
	$result = $connection->query($sql);
	$grade = $result->fetch_assoc();

	function setPercentage($element) {
		global $grade;
		if ($grade[$element] == 0) {
			$grade[$element] = "-";
		}
	}

	setPercentage("c");
	setPercentage("si");
	setPercentage("mn");
	setPercentage("p");
	setPercentage("s");
	setPercentage("co");
	setPercentage("cr");
	setPercentage("mo");
	setPercentage("ni");
	setPercentage("v");
	setPercentage("w");
	setPercentage("sonstiges");
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
		<div id="properties">
			<h5 class="mb-3">Bezeichnung: <?php echo $grade["name"]; ?></h5>
			<h5 class="mb-4">Gebrauchseigenschaften</h5>
			<div class="row">
				<label for="korrosionsbestaendigkeit" class="col-3">Korrosionsbeständigkeit</label>
				<input id="korrosionsbestaendigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['korrosionsbestaendigkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="zugschneidhaltigkeit" class="col-3">Zugschneidhaltigkeit</label>
				<input id="zugschneidhaltigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['zugschneidhaltigkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="zugschneidfaehigkeit" class="col-3">Zugschneidfähigkeit</label>
				<input id="zugschneidfaehigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['zugschneidfaehigkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="schneidenwinkel" class="col-3">Stabiler Schneidenwinkel</label>
				<input id="schneidenwinkel" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['schneidenwinkel']; ?>"></input>
			</div>
			<div class="row">
				<label for="zaehigkeit" class="col-3">Zähigkeit, Schockbelastbarkeit</label>
				<input id="zaehigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['zaehigkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="schnittguete" class="col-3">Schnittgüte</label>
				<input id="schnittguete" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['schnittguete']; ?>"></input>
			</div>
			<div class="row">
				<label for="anfangsschaerfe" class="col-3">Anfangsschärfe</label>
				<input id="anfangsschaerfe" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['anfangsschaerfe']; ?>"></input>
			</div>
			<div class="row">
				<label for="druckschneidhaltigkeit" class="col-3">Druckschneidhaltigkeit</label>
				<input id="druckschneidhaltigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['druckschneidhaltigkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="schneidkantenstabilitaet" class="col-3">Schneidkantenstabilität</label>
				<input id="schneidkantenstabilitaet" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['schneidkantenstabilitaet']; ?>"></input>
			</div>
			<div class="row">
				<label for="druckschneidfaehigkeit" class="col-3">Druckschneidfähigkeit</label>
				<input id="druckschneidfaehigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['druckschneidfaehigkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="schaerfbarkeit" class="col-3">Schärfbarkeit</label>
				<input id="schaerfbarkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['schaerfbarkeit']; ?>"></input>
			</div>
			<div class="row">
				<label for="verschleissbestaendigkeit" class="col-3">Verschleißbeständigkeit</label>
				<input id="verschleissbestaendigkeit" class="col-6" type="range" min="0" max="1000" step="1" value="<?php echo $grade['verschleissbestaendigkeit']; ?>"></input>
			</div>
			<h5 class="mt-5 mb-4">Kosten</h5>
			<div class="row">
				<label for="einkauf" class="col-3">Einkauf</label>
				<input id="einkauf" class="col-6" type="range" min="0" max="100" step="1" value="<?php echo $grade['einkauf']; ?>"></input>
			</div>
			<div class="row">
				<label for="verarbeitung" class="col-3">Verarbeitung</label>
				<input id="verarbeitung" class="col-6" type="range" min="0" max="100" step="1" value="<?php echo $grade['verarbeitung']; ?>"></input>
			</div>
			<div class="row">
				<label for="verfuegbarkeit" class="col-3">Verfügbarkeit</label>
				<input id="verfuegbarkeit" class="col-6" type="range" min="0" max="100" step="1" value="<?php echo $grade['verfuegbarkeit']; ?>"></input>
			</div>
			<h5 class="mt-5 mb-4">Schnittgut</h5>
			<div class="row">
				<label for="hart" class="col-3">Hart</label>
				<input id="hart" class="col-6" type="range" min="0" max="100" step="1" value="<?php echo $grade['hart']; ?>"></input>
			</div>
			<div class="row">
				<label for="verschleissend" class="col-3">Verschleißend</label>
				<input id="verschleissend" class="col-6" type="range" min="0" max="100" step="1" value="<?php echo $grade['verschleissend']; ?>"></input>
			</div>
		</div>
		<h5 class="mt-5 mb-3">Legierungstyp: <?php echo $grade["legierungstyp"]; ?></h5>
		<h5 class="mb-4">Chemische Zusammensetzung (in %)</h5>
		<div class="row">
			<div class="col-1 border-right">
				<div class="border-bottom">C</div>
				<div><?php echo $grade["c"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">Si</div>
				<div><?php echo $grade["si"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">Mn</div>
				<div><?php echo $grade["mn"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">P</div>
				<div><?php echo $grade["p"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">S</div>
				<div><?php echo $grade["s"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">Co</div>
				<div><?php echo $grade["co"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">Cr</div>
				<div><?php echo $grade["cr"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">Mo</div>
				<div><?php echo $grade["mo"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">Ni</div>
				<div><?php echo $grade["ni"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">V</div>
				<div><?php echo $grade["v"]; ?></div>
			</div>
			<div class="col-1 border-right">
				<div class="border-bottom">W</div>
				<div><?php echo $grade["w"]; ?></div>
			</div>
			<div class="col-1">
				<div class="border-bottom">Sonstiges</div>
				<div><?php echo $grade["sonstiges"]; ?></div>
			</div>
		</div>
		<h5 class="my-5">Korngröße (Hartphase): <?php echo $grade["hartphasenkorngroesse"]; ?></h5>
		<a href="index.php" class="btn btn-info">Back</a>
	</div>
</body>
</html>
<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertCoachBtn'])) {

	$query = insertCoach($pdo, $_POST['username'], $_POST['firstName'], 
		$_POST['lastName'], $_POST['dateOfBirth'], $_POST['specialization']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editCoachBtn'])) {
	$query = updateCoach($pdo, $_POST['firstName'], $_POST['lastName'], 
		$_POST['dateOfBirth'], $_POST['specialization'], $_GET['coach_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}




if (isset($_POST['deleteCoachBtn'])) {
	$query = deleteWebDev($pdo, $_GET['coach_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewClientBtn'])) {
	$query = insertClient($pdo, $_POST['firstName'], $_POST['lastName'], $_GET['coach_id']);

	if ($query) {
		header("Location: ../viewclients.php?coach_id=" .$_GET['coach_id']);
	}
	else {
		echo "Insertion failed";
	}
}


if (isset($_POST['editClientBtn'])) {
	$query = updateClient($pdo, $_POST['firstName'], $_POST['lastName'], $_GET['client_id']);

	if ($query) {
		header("Location: ../viewclients.php?coach_id=" .$_GET['coach_id']);
	}
	else {
		echo "Update failed";
	}

}


if (isset($_POST['deleteClientBtn'])) {
	$query = deleteClient($pdo, $_GET['client_id']);

	if ($query) {
		header("Location: ../viewclients.php?coach_id=" .$_GET['coach_id']);
	}
	else {
		echo "Deletion failed";
	}
}




?>
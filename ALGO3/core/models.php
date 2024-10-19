<?php  

function insertCoach($pdo, $username, $first_name, $last_name, 
	$date_of_birth, $specialization) {

	$sql = "INSERT INTO coaches (username, first_name, last_name, 
		date_of_birth, specialization) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $first_name, $last_name, 
		$date_of_birth, $specialization]);

	if ($executeQuery) {
		return true;
	}
}



function updateCoach($pdo, $first_name, $last_name, 
	$date_of_birth, $specialization, $coach_id) {

	$sql = "UPDATE coaches
				SET first_name = ?,
					last_name = ?,
					date_of_birth = ?, 
					specialization = ?
				WHERE coach_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, 
		$date_of_birth, $specialization, $coach_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteWebDev($pdo, $coach_id) {
	$deleteCoachClient = "DELETE FROM clients WHERE coach_id = ?";
	$deleteStmt = $pdo->prepare($deleteCoachClient);
	$executeDeleteQuery = $deleteStmt->execute([$coach_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM coaches WHERE coach_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$coach_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function getAllCoach($pdo) {
	$sql = "SELECT * FROM coaches";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCoachByID($pdo, $coach_id) {
	$sql = "SELECT * FROM coaches WHERE coach_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getClientsByCoach($pdo, $coach_id) {
	
	$sql = "SELECT 
				clients.client_id AS client_id,
				clients.first_name AS first_name,
				clients.last_name AS last_name,
				clients.date_added AS date_added,
				CONCAT(coaches.first_name,' ',coaches.last_name) AS coach_name
			FROM clients
			JOIN coaches ON clients.coach_id = coaches.coach_id
			WHERE clients.coach_id = ? 
			GROUP BY clients.first_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllInfoByCoachID($pdo, $coach_id) {
	$sql = "SELECT * FROM coaches WHERE coach_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$coach_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertClient($pdo, $first_name, $last_name, $coach_id) {
	$sql = "INSERT INTO clients (first_name, last_name, coach_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $coach_id]);
	if ($executeQuery) {
		return true;
	}

}

function getClientByID($pdo, $client_id) {
	$sql = "SELECT 
				clients.client_id AS client_id,
				clients.first_name AS first_name,
				clients.last_name AS last_name,
				clients.date_added AS date_added,
				CONCAT(coaches.first_name,' ',coaches.last_name) AS client_owner
			FROM clients
			JOIN coaches ON clients.coach_id = coaches.coach_id
			WHERE clients.client_id  = ? 
			GROUP BY clients.first_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateClient($pdo, $first_name, $last_name, $client_id) {
	$sql = "UPDATE clients
			SET first_name = ?,
				last_name = ?
			WHERE client_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $client_id]);

	if ($executeQuery) {
		return true;
	}
}


function deleteClient($pdo, $client_id) {
	$sql = "DELETE FROM clients WHERE client_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return true;
	}
}




?>
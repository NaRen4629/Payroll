<?php 
	require 'config/connection.php';

	function loadAuthors() {
		$db = new Connection;
		$conn = $db->open();

		$stmt = $conn->prepare("SELECT * FROM tbl_category");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}

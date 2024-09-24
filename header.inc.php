<?php
// Einbinden der privaten Daten
include 'informations.inc.php';

// Datenbankverbindung herstellen
$servername = $privateData['db_servername']; // ggf. anpassen
$username = $privateData['db_username']; // ggf. anpassen
$password = $privateData['db_password']; // ggf. anpassen
$dbname = $privateData['db_dbname']; // ggf. anpassen

// Verbindung zum MySQL-Server (ohne Datenbank) herstellen
$conn = new mysqli($servername, $username, $password);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// Überprüfen, ob die Datenbank existiert
$db_check = $conn->query("SHOW DATABASES LIKE '$dbname'");

if ($db_check !== false && $db_check->num_rows == 0) {
    // Datenbank erstellen, falls sie nicht existiert
    $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
}

// Verbindung zur Datenbank herstellen
$conn->select_db($dbname);

// Überprüfen, ob die Tabelle existiert
$table_check = $conn->query("SHOW TABLES LIKE 'registrations'");

if ($table_check !== false && $table_check->num_rows == 0) {
    // Tabelle erstellen, falls sie nicht existiert
    $conn->query("CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vpncode VARCHAR(6) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    `group` TINYINT NOT NULL,
    day JSON NULL,
    note TEXT NULL,
    email_count INT DEFAULT 0,
    timestamp_of_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    timestamp_of_last_change TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);");
}
?>
<!DOCTYPE html>
<html lang="de">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="robots" content="noindex, nofollow"> <!-- Verhindert die Indexierung durch Suchmaschinen -->

      <!-- SEO Meta-Tags -->
      <meta name="description" content="Webtool als Intervention zur Erhöhung der Selbstakzeptanz. Im Rahmen der Bachelorarbeit">
      <meta name="keywords" content="Selbstakzeptanz, Autosuggestion, Studie, Psychologie">
      <meta name="author" content="<?php echo $privateData['name']; ?>">

      <!-- Favicon -->
      <!--<link rel="icon" href="favicon.png" type="image/png">-->

      <!-- CSS-Dateien -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="./assets/stylesheet.css">

      <!-- JavaScript-Dateien -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <title>Selbstakzeptanz Autosuggestion</title>
  </head>
<body>
  <header>
        <div class="container">
            <h1 class="my-4">Selbstakzeptanz Übung</h1>
            <p class="lead">Bachelorarbeit Studie über Selbstakzeptanz</p>
        </div>
    </header>

    <!-- Dein Hauptinhalt hier -->
    <main>

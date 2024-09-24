<?php
// Einbinden der privaten Daten
include 'informations.inc.php';

// Datenbankverbindung herstellen
$servername = $privateData['db_servername']; // ggf. anpassen
$username = $privateData['db_username']; // ggf. anpassen
$password = $privateData['db_password']; // ggf. anpassen
$dbname = $privateData['db_dbname']; // ggf. anpassen

try {
    // Verbindung zur Datenbank herstellen
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tabelle erstellen, falls sie nicht existiert
    $conn->exec("CREATE TABLE IF NOT EXISTS registrations (
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

} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="./assets/stylesheet.css">

      <!-- JavaScript-Dateien -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-6crM8dMz8mI1AlSwfTuG8w9MZo/g5U1YAWP9T4lDQh0=" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/@popperjs/core@2"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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

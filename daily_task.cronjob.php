<?php
if ($_GET['daytime'] == "morning") {
    // Morgen-spezifische Logik hier
} elseif ($_GET['daytime'] == "evening") {
    // Abend-spezifische Logik hier
} else {
    http_response_code(422); // 422 Unprocessable Entity
    exit;
}

// Einbinden der header.inc.php
include 'header.inc.php';

// Holen der E-Mail-Adressen und VPN-Codes aus der Datenbank
$sql = "SELECT id, email, vpncode FROM registrations WHERE `group` = 1 AND email_count <= 20";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // E-Mail-Header
    $subject = "Ihr VPN-Code";
    $headers = "From: " . $privateData['server_email'] . "\r\n" .
               "Reply-To: " . $privateData['email'] . "\r\n" . // Antwort an die spezifische E-Mail-Adresse
               "Content-Type: text/html; charset=UTF-8\r\n" . // HTML-Header
               "X-Mailer: PHP/" . phpversion();

    // Schleife durch alle Zeilen im Ergebnis
    while ($row = $result->fetch_assoc()) {
        $id = $row['id']; // ID für die Aktualisierung
        $email = $row['email'];
        $vpncode = $row['vpncode'];

        // E-Mail-Inhalt
        $message = "Ihr VPN-Code: $vpncode";

        // E-Mail versenden
        if (mail($email, $subject, $message, $headers)) {
            // E-Mail erfolgreich versendet, email_count erhöhen
            $update_sql = "UPDATE registrations SET email_count = email_count + 1 WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("i", $id); // ID binden
            $stmt->execute();
            $stmt->close();
        } else {
            // Fehler beim Versand
            error_log("Fehler beim Versenden der E-Mail an: $email");
        }
    }
} else {
    echo "Keine E-Mail-Adressen zu versenden.";
}

// Verbindung schließen
$conn->close();
?>

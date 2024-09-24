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

        // Berechnung von DAY und Zeit (morgen oder abend)
        if ($row['email_count'] < 20) {
            $day = floor($row['email_count'] / 2) + 1; // Tag berechnen
            $time_of_day = ($row['email_count'] % 2 == 0) ? "morgen" : "abend"; // Zeitpunkt bestimmen
        } else {
            // Wenn die Anzahl der E-Mails 20 erreicht, wird kein weiterer Tag mehr gesendet
            $day = 10; // Maximaler Tag
            $time_of_day = "none"; // Keine weitere E-Mail senden
        }

        // E-Mail-Inhalt
        $message = "
        <html>
        <head>
            <title>Information zur Selbstakzeptanz Übung</title>
        </head>
        <body>
            <h2>Willkommen zur Selbstakzeptanz Übung!</h2>
            <p>Vielen Dank, dass Sie an unserer Studie teilnehmen. Hier ist Ihr VPN-Code:</p>
            <h3>$vpncode</h3>
            <p>Um an der Übung teilzunehmen, klicken Sie bitte auf den folgenden Link:</p>
            <p><a href='https://selbstakzeptanz.tomaschmann.de?vpncode=$vpncode&group=1&day=$day'>Selbstakzeptanz Übung starten</a></p>
            <p>Dieser Link ist gültig für den Tag $day der Übung, die über einen Zeitraum von 10 Tagen läuft.</p>
            <p>Wir wünschen Ihnen viel Erfolg bei Ihrer Reise zur Selbstakzeptanz!</p>
            <p>Mit freundlichen Grüßen,<br>Ihr Forschungsteam</p>
        </body>
        </html>
        ";

        // E-Mail versenden
        if (mail($email, $subject, $message, $headers)) {
            // E-Mail erfolgreich versendet, email_count erhöhen
            $update_sql = "UPDATE registrations SET email_count = email_count + 1, time_of_day = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $time_of_day, $row['id']); // ID verwenden, um den Datensatz eindeutig zu aktualisieren
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

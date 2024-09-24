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
  $subject = "Ihr VPN-Code für die Selbstakzeptanz-Übung";
  $headers = "From: " . $privateData['server_email'] . "\r\n" .
             "Reply-To: " . $privateData['email'] . "\r\n" .
             "Content-Type: text/html; charset=UTF-8\r\n" .
             "X-Mailer: PHP/" . phpversion();

  // Schleife durch alle Zeilen im Ergebnis
  while ($row = $result->fetch_assoc()) {
      $email = $row['email'];
      $vpncode = $row['vpncode'];
      $email_count = $row['email_count'];

      // Berechnung des Tages
      $day = floor($email_count / 2) + 1; // Tag 1 für 0-1, Tag 2 für 2-3, usw.

      // Tageszeit bestimmen
      $time_of_day = ($email_count % 2 === 0) ? "morgen" : "abend";

      // E-Mail-Inhalt
      $message = "
      <html>
      <head>
          <title>Ihr VPN-Code für die Selbstakzeptanz-Übung</title>
      </head>
      <body>
          <p>Liebe*r Teilnehmende*r,</p>
          <p>wir freuen uns, Ihnen Ihren VPN-Code für die Selbstakzeptanz-Übung zur Verfügung zu stellen. Dieser Code ist ein wichtiger Bestandteil unserer Intervention und wird Ihnen helfen, Ihre Fortschritte zu verfolgen.</p>
          <p><strong>Ihr VPN-Code:</strong> $vpncode</p>
          <p>Bitte verwenden Sie den folgenden Link, um auf die Übung zuzugreifen:</p>
          <p><a href='https://selbstakzeptanz.tomaschmann.de?vpncode=$vpncode&group=1&day=$day'>Selbstakzeptanz-Übung</a></p>
          <p>Wichtige Hinweise:</p>
          <ul>
              <li>Der Link bleibt bis zum Ende Ihrer Teilnahme aktiv.</li>
              <li>Bitte stellen Sie sicher, dass Sie den Link nur einmal verwenden, um Ihre Daten korrekt zu erfassen.</li>
          </ul>
          <p>Vielen Dank für Ihre Teilnahme an unserer Studie. Ihre Mitarbeit ist von großer Bedeutung für die Forschung im Bereich Selbstakzeptanz.</p>
          <p>Bei Fragen oder weiteren Informationen stehen wir Ihnen gerne zur Verfügung.</p>
          <p>Mit freundlichen Grüßen,<br>Das Team von [Ihr Team-Name oder Projektname]<br>[Kontaktinformationen]</p>
      </body>
      </html>
      ";

      // E-Mail versenden
      if (mail($email, $subject, $message, $headers)) {
          // E-Mail erfolgreich versendet, email_count erhöhen
          $update_sql = "UPDATE registrations SET email_count = email_count + 1 WHERE id = ?";
          $stmt = $conn->prepare($update_sql);
          $stmt->bind_param("i", $row['id']); // ID verwenden, um den count zu erhöhen
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

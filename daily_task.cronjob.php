<?php
if ($_GET['passkey'] != "Fq1X1uozDYZt6ycq8dMjts8jF4ZK9F7M") {
    http_response_code(422); // 422 Unprocessable Entity
    exit;
}

// Einbinden der header.inc.php
include 'header.inc.php';

// Holen der E-Mail-Adressen und VPN-Codes aus der Datenbank
$sql = "SELECT id, email, vpncode, email_count FROM registrations WHERE `group` = 1 AND email_count <= 20";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // E-Mail-Header
  $subject = "Deine heutige Selbstakzeptanz-Übung";
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
      $message = "<p>Liebe:r Teilnehmer:in,</p>

      <p>herzlich willkommen zu deiner täglichen Übung! Vielen Dank, dass du dir die Zeit nimmst.<br>
      Du bekommst 10 Tage lang jeden Morgen und Abend eine E-Mail. Anschließend bekommst du einen zweiten Fragebogen.</p>

      <p>Dies ist die Übung für den <strong>$time_of_day</strong> des <strong>$day.</strong> Tages.</p>

      <p>Übung für heute: <a href='https://selbstakzeptanz.tomaschmann.de?vpncode=$vpncode&group=1&day=$day'>Hier klicken, um zur Übung zu gelangen</a>.</p>

      <small>Falls du den Link nicht anklicken kannst, kannst du ihn hier kopieren: <strong><a href='https://selbstakzeptanz.tomaschmann.de?vpncode=$vpncode&group=1&day=$day'>https://selbstakzeptanz.tomaschmann.de?vpncode=$vpncode&group=1&day=$day</a></strong></small>

      <p>Nimm dir bitte ein paar Minuten, um die Übung zu absolvieren. Es ist hilfreich, diese so bald wie möglich nach Erhalt dieser E-Mail zu machen, aber bitte nicht auf den nächsten Tag verschieben. Die Übung dauert nur etwa 5 Minuten. Dabei wirst du 5 Minuten lang einen Satz im Kopf immer wieder durchgehen.</p>
      <p>Solltest du eine Übung verpasst haben, mache einfach mit der nächsten weiter.</p>
      <p>Indem du regelmäßig an dieser Übung teilnimmst, unterstützt du nicht nur deine persönliche Entwicklung, sondern leistest auch einen wertvollen Beitrag zur wissenschaftlichen Forschung.<br>
      Denk auch an die Belohnung am Ende 🙂.</p>

      <p>Wenn du Fragen hast oder Unterstützung benötigst, stehe ich dir jederzeit gerne zur Verfügung.</p>";


      // E-Mail versenden
      if (mail($email, $subject, $message, $headers)) {
          // E-Mail erfolgreich versendet, email_count erhöhen
          $update_sql = "UPDATE registrations SET email_count = email_count + 1 WHERE id = ?";
          $stmt = $conn->prepare($update_sql);
          $stmt->bind_param("i", $row['id']); // ID verwenden, um den count zu erhöhen
          $stmt->execute();
          $stmt->close();
          echo '<div class="alert alert-primary" role="alert">E-Mail des Nutzers mit der ID '.$row['id'].' wurde versendet (Counter: '.$email_count.', Tag: '.$day.')</div>';
      } else {
          // Fehler beim Versand
          echo '<div class="alert alert-danger" role="alert">Fehler beim versenden der E-Mail an: '.$email.'.</div>';
          error_log("Fehler beim Versenden der E-Mail an: $email");
      }
  }

} else {
    echo '<div class="alert alert-warning" role="alert">Keine E-Mail-Adressen zu versenden.</div>';
}

// Verbindung schließen
$conn->close();
?>

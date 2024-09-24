<?php
// Damit nur der Cronjob die Seite ausführt, ist ein Passkey (Public Key) integriert
if ($_GET['passkey'] != "Fq1X1uozDYZt6ycq8dMjts8jF4ZK9F7M") {
    http_response_code(422); // 422 Unprocessable Entity
    exit;
}

// Einbinden der header.inc.php
include 'header.inc.php';

// SQL-Abfrage, um Einträge zu finden, bei denen email_count gleich 20 ist
$sql = "SELECT id, email, vpncode, email_count FROM registrations WHERE email_count = 20";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // E-Mail-Header
  $subject = "Zweiter Fragebogen zur Selbstakzeptanz";
  $headers = "From: " . $privateData['server_email'] . "\r\n" .
             "Reply-To: " . $privateData['email'] . "\r\n" .
             "Content-Type: text/html; charset=UTF-8\r\n" .
             "X-Mailer: PHP/" . phpversion();

  // Schleife durch alle Zeilen im Ergebnis
  while ($row = $result->fetch_assoc()) {
      $email = $row['email'];
      $vpncode = $row['vpncode'];

      // E-Mail-Inhalt
      // E-Mail-Inhalt
      $message = "<h2>Der Letzte Fragebogen</h2>
                  <p>Liebe:r Teilnehmer:in,</p>

                  <p>herzlichen Glückwunsch! Du hast alle täglichen Übungen mit großem Engagement abgeschlossen, und dafür möchte ich dir von Herzen danken. 💚</p>

                  <p>Jetzt stehst du kurz vor dem letzten Schritt: Bitte nimm dir ein paar Minuten Zeit, um den <a href='https://www.soscisurvey.de/selbstakzeptanz-1/?q=2&r=".$vpncode."'>zweiten Fragebogen</a> auszufüllen.</p>

                  <p>Deine Teilnahme ist für mich von großer Bedeutung, und ich schätze es sehr, dass du dir die Zeit nimmst, um an dieser Umfrage teilzunehmen.</p>

                  <p>Nach Abschluss des zweiten Fragebogens kannst du an der Verlosung der 3x 10 € Wunschgutscheine teilnehmen. Du bekommst den kostenlosen Zugang für 3 Monaten Premium der 7mind Meditationsapp, und die 3,5 Versuchspersonenstunden als Psychologie-Student:in der HSRW. Auch bekommst du Zugang zu den Ergebnissen der Studie 🙂.

                  <small>Falls du den Link nicht anklicken kannst, kannst du ihn hier kopieren: <strong><a href='https://www.soscisurvey.de/selbstakzeptanz-1/?q=2&r=".$vpncode."'>https://www.soscisurvey.de/selbstakzeptanz-1/?q=2&r=".$vpncode."</a></strong></small>

                  <p>Ich danke dir noch einmal für deine Zeit und wünsche dir alles Gute!</p>

                  <p>Liebe Grüße,</p>
                  <p>Tom</p>";

      // E-Mail versenden
      if (mail($email, $subject, $message, $headers)) {
          // E-Mail erfolgreich versendet, email_count erhöhen
          $update_sql = "UPDATE registrations SET email_count = email_count + 1 WHERE id = ?";
          $stmt = $conn->prepare($update_sql);
          $stmt->bind_param("i", $row['id']); // ID verwenden, um den count zu erhöhen
          $stmt->execute();
          $stmt->close();
          echo '<div class="alert alert-primary" role="alert">Erinnerung an den zweiten Fragebogen wurde an die E-Mail des Nutzers mit der ID '.$row['id'].' gesendet (Counter erhöht).</div>';
      } else {
          // Fehler beim Versand
          echo '<div class="alert alert-danger" role="alert">Fehler beim Versenden der E-Mail an: '.$email.'.</div>';
          error_log("Fehler beim Versenden der E-Mail an: $email");
      }
  }

} else {
    echo '<div class="alert alert-warning" role="alert">Keine E-Mail-Adressen gefunden, bei denen der email_count gleich 20 ist.</div>';
}

// Verbindung schließen
$conn->close();
require './footer.inc.php';
?>

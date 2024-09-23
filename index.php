<?php
    require './header.inc.php'; # Header Datei, in welcher beginnende Inhalte gespeichert sind, die auf jeder Seite anfangs eingebunden werden
    require './send_email.inc.php';
    if (isset($_GET['vpncode']) && strlen($_GET['vpncode']) == 6 && is_numeric($_GET['group']) && (intval($_GET['group']) == 1 || intval($_GET['group']) == 2)) { # Abfrage der immer benötigten GET-Parameter
// Registrierung
        if (isset($_GET['register']) && !isset($_GET['day'])) { # Abfrage ob Person registriert werden soll (und Ausschluss des day-GET-Parameters)
          if ($_GET['register'] == 1) {
            ?>
            <h4 style="text-align: center">Dies ist die Anmeldung für die Intervention zur Selbstakzeptanz.</h4>
            <h5 style="text-align: center">Bitte gebe deine E-Mail-Adresse unten ein. Du bekommst eine automatisch E-Mail zugesendet.</h5>
            <?php
            if (intval($_GET['group']) == 1) { # Interventionsgruppe
              ?>
              <p>Du bekommst 10 Tage lang jeden Tag morgens und Abends eine kleine Aufgabe. Dies dauert nur 5 Minuten und hilft dir deine Selbstakzeptanz zu erhöhen.</p>
              <?php
            } elseif (intval($_GET['group']) == 2) { # Kontrollgruppe
              ?>
              <p>Du bekommst eine Aufgabe zur per E-Mail zugesendet. Diese hilft dir deine Selbstakzeptanz zu erhöhen.</p>
              <?php
            }
            ?>
            <div class="container">
              <p>
                Nach 10 Tagen bekommst du eine weitere E-Mail mit einem Link für den zweiten Fragebogen. <strong>Dieser zweite Fragebogen ist sehr wichtig!</strong><br>
                Als <strong>Dankeschön</strong> kannst du, nach Abschluss der Intervention und des zweiten Fragebogens, an einer Verlosung von 3x 10 € Wunschgutscheinen teilnehmen, bekommst eine 3-monatige gratis Premium Mitgliedschaft der Meditationsapp 7mind und bekommst Zugang zu der fertigen Studie.<br>
                Als Student der HSRW bekommst du dann auch deine 3,5 Versuchspersonenstunden gutgeschrieben.<br>
                Mit deiner Teilnahme leistest du einen großen Beitrag zur Wissenschaft und unterstützt mich sehr bei meiner Bachelorarbeit. Vielen Dank!
              </p>
              <form method="post" action="?vpncode=<?php echo $_GET['vpncode']; ?>&group=<?php echo $_GET['group']; ?>&register=2">
                  <input type="hidden" name="vpncode" value="<?php echo $_GET['vpncode']; ?>">
                  <input type="hidden" name="group" value="<?php echo $_GET['group']; ?>">
                  <label for="email">
                    <input type="email" id="email" name="email" placeholder="E-Mail-Adresse">
                  </label>
                  <input type="submit" value="Mit der Übung beginnen">
              </form>
            </div>

            <?php
          } elseif ($_GET['register'] == 2) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Daten aus dem Formular holen
              $vpncode = $conn->real_escape_string($_POST['vpncode']);
              $email = $conn->real_escape_string($_POST['email']);
              $group = intval($_POST['group']); // Typumwandlung
              $day = json_encode(null); // Optional anpassen
              $note = null; // Optional anpassen

              // Überprüfung auf Duplikate
              $check_sql = "SELECT COUNT(*) AS count FROM registrations WHERE vpncode = '$vpncode' AND email = '$email'";
              $result = $conn->query($check_sql);
              $row = $result->fetch_assoc();

              if ($row['count'] > 0) {
                  // Duplikat gefunden
                  echo "Fehler: Diese Kombination aus VPN-Code und E-Mail ist bereits registriert.";
              } else {
                  // SQL-Statement zum Einfügen der Daten
                  $sql = "INSERT INTO registrations (vpncode, email, `group`, day, note)
                          VALUES ('$vpncode', '$email', $group, '$day', '$note')";

                          if ($conn->query($sql) === TRUE) {
                              // E-Mail versenden
                              if (sendEmail($email, $group)) {
                                  echo "<p class='container'>Vielen Dank für deine Registrierung. Du hast soeben eine E-Mail erhalten in welcher beschrieben wird wie die Übungen über die 10 Tage ablaufen. <strong>Bitte lese dir die E-Mail gut durch.</strong> Solltest du keine E-Mail erhalten haben schreibe mir bitte über die E-Mail-Adresse <a href='mailto:tom-john.aschmann@hsrw.org'>tom-john.aschmann@hsrw.org</a>.<br>Du kannst diese Seite nun schließen 🙂.</p>";
                              } else {
                                  echo "Fehler beim Versenden der E-Mail.";
                              }
                          } else {
                              echo "Fehler: " . $sql . "<br>" . $conn->error; // Ausgabe des Fehlers
                          }

              }

              $conn->close(); // Verbindung schließen
            }


          } else {
            echo "Error 3 - Ungültiger register Parameter";
          }
// Intervention
        } elseif (isset($_GET['day']) && is_numeric($_GET['day']) && intval($_GET['day']) >= 1 && intval($_GET['day']) <= 14 && !isset($_GET['register'])) { # Abfrage ob day-GET-Parameter gesetzt ist (und Ausschluss des register-GET-Parameters)

          /*
            BITTE HIER EINFÜGEN
          */
          // Überprüfen, ob der VPN-Code in der Datenbank existiert
          $vpncode = $conn->real_escape_string($_GET['vpncode']);
          $day_input = intval($_GET['day']);

          // SQL-Abfrage, um den Eintrag mit dem gegebenen VPN-Code zu überprüfen
          $sql = "SELECT day FROM registrations WHERE vpncode = '$vpncode'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Datensatz gefunden, day-Parameter aus der Datenbank auslesen
              $row = $result->fetch_assoc();
              $day_data = $row['day'] ? json_decode($row['day'], true) : null;

              // Überprüfen, ob day-Daten leer oder null sind
              if (is_null($day_data)) {
                  // JSON-Liste erstellen, falls day leer ist
                  $day_data = [
                      "days" => array_map(function ($d) {
                          return ["day" => $d, "finished" => 0, "timestamp" => ""];
                      }, range(1, 14))
                  ];

                  // Day als JSON in die Datenbank speichern
                  $day_json = $conn->real_escape_string(json_encode($day_data));
                  $update_sql = "UPDATE registrations SET day = '$day_json' WHERE vpncode = '$vpncode'";
                  $conn->query($update_sql);
              }

              ###############################
              // Hole die JSON-Daten für den aktuellen Tag aus der Datenbank
              $group = intval($_GET['group']);
              $day = intval($_GET['day']);
              $json_query = "SELECT day FROM registrations WHERE vpncode = '$vpncode' AND `group` = $group";
              $result = $conn->query($json_query);

              if ($result && $row = $result->fetch_assoc()) {
                  $day_data = json_decode($row['day'], true); // JSON in ein Array umwandeln

                  // Überprüfen, ob der letzte Timestamp vorhanden ist
                  if ($last_timestamp_string) {
                      // Splitten des Strings und den letzten Timestamp holen
                      $timestamps = explode(';', $last_timestamp_string);
                      $last_timestamp = end($timestamps); // Letzten Timestamp auswählen

                      // DateTime-Objekt erstellen
                      $current_time = new DateTime(); // Aktuelle Zeit
                      $last_time = new DateTime($last_timestamp); // Zeit des letzten Timestamps
                      $interval = $current_time->diff($last_time); // Zeitdifferenz berechnen

                      // Debugging-Ausgaben
                      echo "Aktuelle Zeit: " . $current_time->format('Y-m-d H:i:s') . "<br>";
                      echo "Letzter Timestamp: " . $last_timestamp . "<br>";
                      echo "Zeitdifferenz: " . $interval->format('%d Tage %h Stunden %i Minuten') . "<br>";

                      // Überprüfen, ob die Zeitdifferenz weniger als 4 Stunden beträgt
                      $hours_difference = ($interval->days * 24) + $interval->h; // Gesamtstunden berechnen
                      echo "Gesamtstunden Differenz: " . $hours_difference . "<br>";

                      if ($hours_difference < 4) {
                          $daily_task_finished = true; // Weniger als 4 Stunden
                      } else {
                          $daily_task_finished = false; // Mehr als 4 Stunden
                      }
                  } else {
                      $daily_task_finished = false; // Falls kein Timestamp vorhanden ist
                  }


                  } else {
                      echo "Fehler: Tag nicht gefunden.";
                      $daily_task_finished = false;
                  }
              } else {
                  echo "Fehler beim Abrufen der JSON-Daten: " . $conn->error;
              }
              var_dump($daily_task_finished);



              ###############################

              if ($daily_task_finished == false) {
              // Satz anzeigen
              echo "<p>Ich akzeptiere mich so wie ich bin.</p>";

              // Formular erstellen
              ?>
              <form method="post" action="?vpncode=<?php echo $_GET['vpncode']; ?>&day=<?php echo $_GET['day']; ?>&group=<?php echo $_GET['group']; ?>">
                  <input type="hidden" name="vpncode" value="<?php echo $_GET['vpncode']; ?>">
                  <input type="hidden" name="day" value="<?php echo $_GET['day']; ?>">
                  <input type="submit" name="daily_task" value="Aufgabe abschließen">
              </form>
              <?php
            } else {
              ?>
              <p>Du hast die Übung erfolgreich abgeschlossen!</p>
              <?php
            }
              // Prüfen, ob das Formular abgesendet wurde
              if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['daily_task'])) {
                  // JSON-Daten erneut laden, falls sie aktualisiert wurden
                  $day_data = json_decode($row['day'], true);

                  // Den aktuellen Tag finden und aktualisieren
                  foreach ($day_data['days'] as &$day_item) {
                      if ($day_item['day'] == $day_input) {
                          $day_item['finished'] += 1; // Anzahl der abgeschlossenen Aufgaben erhöhen
                          $day_item['timestamp'] .= (empty($day_item['timestamp']) ? "" : ";") . date("Y-m-d H:i:s"); // Timestamp hinzufügen
                          break;
                      }
                  }

                  // Aktualisierte JSON-Liste zurück in die Datenbank speichern
                  $day_json = $conn->real_escape_string(json_encode($day_data));
                  $update_sql = "UPDATE registrations SET day = '$day_json' WHERE vpncode = '$vpncode'";

                  if ($conn->query($update_sql) === TRUE) {
                      $daily_task_finished = true;
                  } else {
                      echo "Fehler beim Aktualisieren der Daten: " . $conn->error;
                  }
              }

          } else {
              echo "Fehler: Kein Datensatz mit diesem VPN-Code gefunden.";
          }

        } else {
          echo "Error 1 - Weder die Interventionsseite (day) noch die Registrierungsseite (register) wurde ausgewählt.";
          ?>
            <h4>Bitte wende dich per E-Mail an die Versuchsleitung: <a href="mailto:tom-john.aschmann@hsrw.org">tom-john.aschmann@hsrw.org</a></h4>
            <strong><p>Bitte achte darauf, dass du vorher den Fragebogen ausgefüllt hast.</p></strong>
            <form method="get">
              <input type="hidden" name="register" value=1 required>
              <label for="vpncode"><strong>Bitte gebe deinen VPN-Code ein. Merke dir diesen gut, da er für die weiteren Aufgaben wichtig ist.</strong><br>
                  Dein VPN-Code setzt sich zusammen aus insgesamt 6 Zeichen<br>
                  Die ersten beiden Buchstaben der Straße in der du wohnst. Z. B. - BA - bei Baumstraße<br>
                  Der Tag deines Geburtsdatums. Z. B. - 21 - beim 21.09.1995<br>
                  Die letzten beiden Buchstaben deines Geburtsortes: Z. B. - RG - bei Duisburg<br>
                  In diesem Beispiel wäre der VPN-Code: BA21RG<br>
                  <input type="text" id="vpncode" name="vpncode" placeholder="VPN-Code" minlength="6" maxlength="6" required>
              </label>
              <?php /*
              <label for="day">
                <input type="number" id="day" placeholder="Tag" name="day" min=1 max=14 minlength="1" maxlength="2" required>
              </label> */ ?>
              <label for="send_form">
                <input type="submit" value="Zur Registrierung" id="send_form">
              </label>
            </form>
          <?php
        }
    } else {
      echo "Error 2 - Der VPN-Code ist ungültig und/oder die Gruppenzuordnung ist ungültig";
    }


    require './footer.inc.php';

<?php
    require './header.inc.php'; # Header Datei, in welcher beginnende Inhalte gespeichert sind, die auf jeder Seite anfangs eingebunden werden
    if (isset($_GET['vpncode']) && strlen($_GET['vpncode']) == 6 && is_numeric($_GET['group']) && (intval($_GET['group']) == 1 || intval($_GET['group']) == 2)) { # Abfrage der immer benötigten GET-Parameter
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
                    // SQL-Statement zum Einfügen
                    $sql = "INSERT INTO registrations (vpncode, email, `group`, day, note)
                            VALUES ('$vpncode', '$email', $group, '$day', '$note')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Registrierung erfolgreich!";
                    } else {
                        echo "Fehler: " . $sql . "<br>" . $conn->error; // Ausgabe des Fehlers
                    }
                }
            }


            // Daten aus dem Formular holen
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $vpncode = $conn->real_escape_string($_POST['vpncode']);
              $email = $conn->real_escape_string($_POST['email']);
              $group = intval($_POST['group']);  // Annahme, dass group als Integer übergeben wird
              var_dump($_POST);
              $day = json_encode(null); // Optional falls day nicht gesetzt, kannst du dies später dynamisch anpassen
              $note = null; // Kann später gesetzt werden, wenn nötig

              // SQL-Statement zum Einfügen der Daten
              $sql = "INSERT INTO registrations (vpncode, email, `group`, day, note)
                      VALUES ('$vpncode', '$email', $group, '$day', '$note')";

              if ($conn->query($sql) === TRUE) {
                  echo "Registrierung erfolgreich!";
              } else {
                  echo "Fehler: " . $sql . "<br>" . $conn->error;
              }
            }
            $conn->close(); // Verbindung schließen

              ?>
              <p class="container">
                Vielen Dank für deine Registrierung. Du hast soeben eine E-Mail erhalten in welcher beschrieben wird wie die Übungen über die 10 Tage ablaufen. <strong>Bitte lese dir die E-Mail gut durch.</strong> Solltest du keine E-Mail erhalten haben schreibe mir bitte über die E-Mail-Adresse <a href="mailto:tom-john.aschmann@hsrw.org">tom-john.aschmann@hsrw.org</a>.<br>
                Du kannst diese Seite nun  schließen 🙂.
              </p>
              <?php
          } else {
            echo "Error 3 - Ungültiger register Parameter";
          }

        } elseif (isset($_GET['day']) && is_numeric($_GET['day']) && intval($_GET['day']) >= 1 && intval($_GET['day']) <= 14 && !isset($_GET['register'])) { # Abfrage ob day-GET-Parameter gesetzt ist (und Ausschluss des register-GET-Parameters)

          ?>
          <form method="get">
            <label for="vpncode"><strong>Bitte gebe deinen VPN-Code ein. Merke dir diesen gut, da er für die weiteren Aufgaben wichtig ist.</strong><br>
                Dein VPN-Code setzt sich zusammen aus insgesamt 6 Zeichen<br>
                Die ersten beiden Buchstaben der Straße in der du wohnst. Z. B. - BA - bei Baumstraße<br>
                Der Tag deines Geburtsdatums. Z. B. - 21 - beim 21.09.1995<br>
                Die letzten beiden Buchstaben deines Geburtsortes: Z. B. - RG - bei Duisburg<br>
                In diesem Beispiel wäre der VPN-Code: BA21RG<br>
                <input type="text" id="vpncode" name="vpncode" placeholder="VPN-Code" minlength="6" maxlength="6" required>
            </label
            <label for="day">
              <input type="number" id="day" placeholder="Tag" name="day" min=1 max=14 minlength="1" maxlength="2" required>
            </label>
            <label for="send_form">
              <input type="submit" value="Senden" id="send_form">
            </label>
          </form>
          <?php

        } else {
          echo "Error 1 - Weder die Interventionsseite (day) noch die Registrierungsseite (register) wurde ausgewählt.";
        }
    } else {
      echo "Error 2 - Der VPN-Code ist ungültig und/oder die Gruppenzuordnung ist ungültig";
    }


    require './footer.inc.php';

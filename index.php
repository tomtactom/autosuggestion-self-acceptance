<?php
    require './header.inc.php'; # Header Datei, in welcher beginnende Inhalte gespeichert sind, die auf jeder Seite anfangs eingebunden werden
    if (isset($_GET['vpncode']) && strlen($_GET['vpncode']) == 6 && is_numeric($_GET['group']) && (intval($_GET['group']) == 1 || intval($_GET['group']) == 2)) { # Abfrage der immer benötigten GET-Parameter
        if (isset($_GET['register']) && !isset($_GET['day'])) { # Abfrage ob Person registriert werden soll (und Ausschluss des day-GET-Parameters)

            ?>
              <form method="post" action="?<?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?>">
                  <label for="email">
                    <input type="email" id="email" name="email" placeholder="E-Mail-Adresse">
                  </label>
                  <input type="submit">
              </form>
            <?php

        } elseif (isset($_GET['day']) && is_numeric($_GET['day']) && intval($_GET['day']) >= 1 && intval($_GET['day']) <= 14 && !isset($_GET['register'])) { # Abfrage ob day-GET-Parameter gesetzt ist (und Ausschluss des register-GET-Parameters)



        } else {
          echo "Error 1";
        }
    } else {
      echo "Error 2";
    }


    if (isset($_GET['vpncode']) && strlen($_GET['vpncode']) == 6 && isset($_GET['day']) && is_numeric($_GET['day']) && intval($_GET['day']) >= 1 && intval($_GET['day']) <= 14) {
        $vpncode = htmlspecialchars($_GET['vpncode']);
        $day = htmlspecialchars($_GET['day']);

        // Wenn der Button geklickt wurde
        if (isset($_POST['submit'])) {
            // Aktuelles Datum und Uhrzeit
            $timestamp = date("Y-m-d-H-i-s");

            // Log-Datei öffnen
            $logfile = 'log.txt';
            $logmessage = $timestamp.";".$vpncode.";".$day;

            // In Log-Datei schreiben
            file_put_contents($logfile, $logmessage, FILE_APPEND | LOCK_EX);

            echo "<p>Die Aktion wurde erfolgreich geloggt.</p>";
            exit;
        }
        ?>
        <p>Ich akzeptiere mich so wie ich bin</p>
        <form method="POST">
          <button type="submit" name="submit">Bestätigen</button>
        </form>
        <?php
    } else {
      ?>
        <form method="get">
          <label for="vpncode">Bitte gebe deinen VPN-Code ein, welchen du auch im Fragebogen eingegeben hast. Dieser setzt sich zusammen aus ###########
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
    }
    required('./footer.inc.php');

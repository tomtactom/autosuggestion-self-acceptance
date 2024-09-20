<?php
    require './header.inc.php'; # Header Datei, in welcher beginnende Inhalte gespeichert sind, die auf jeder Seite anfangs eingebunden werden
    if (isset($_GET['vpncode']) && strlen($_GET['vpncode']) == 6 && is_numeric($_GET['group']) && (intval($_GET['group']) == 1 || intval($_GET['group']) == 2)) { # Abfrage der immer benötigten GET-Parameter
        if (isset($_GET['register']) && !isset($_GET['day'])) { # Abfrage ob Person registriert werden soll (und Ausschluss des day-GET-Parameters)
            ?>
            <h4>Dies ist die Anmeldung für die Intervention zur Selbstakzeptanz.</h4>
            <h5>Bitte gebe deine E-Mail-Adresse unten ein. Du bekommst eine automatisch E-Mail zugesendet.</h5>
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
                Als <strong>Dankeschön<strong> kannst du, nach Abschluss der Intervention und des zweiten Fragebogens, an einer Verlosung von 3x 10 € Wunschgutscheinen teilnehmen, bekommst eine 3-monatige gratis Premium Mitgliedschaft der Meditationsapp 7mind und bekommst Zugang zu der fertigen Studie.<br>
                Als Student der HSRW bekommst du dann auch deine <!-- 3,5? --> Versuchspersonenstunden gutgeschrieben.
                Mit deiner Teilnahme leistest du einen großen Beitrag zur Wissenschaft und unterstützt mich sehr bei meiner Bachelorarbeit. Vielen Dank!
              </p>
              <form method="post" action="?<?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?>">
                  <label for="email">
                    <input type="email" id="email" name="email" placeholder="E-Mail-Adresse">
                  </label>
                  <input type="submit">
              </form>
            </div>
            <?php

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

/*
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

      <?php
    }*/
    require './footer.inc.php';

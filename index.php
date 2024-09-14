<?php
    if (isset($_GET['vpncode']) && strlen($_GET['vpncode']) == 6 && isset($_GET['day']) && is_numeric($_GET['day']) && intval($_GET['day']) >= 1 && intval($_GET['day']) <= 14) {
        $vpncode = htmlspecialchars($_GET['vpncode']);

        // Wenn der Button geklickt wurde
        if (isset($_POST['submit'])) {
            // Aktuelles Datum und Uhrzeit
            $timestamp = date("Y-m-d-H-i-s");

            // Log-Datei öffnen
            $logfile = 'log.txt';
            $logmessage = $vpncode.";".$timestamp.PHP_EOL;

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

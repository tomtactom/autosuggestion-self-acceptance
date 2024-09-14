<?php
    if ($_GET['vpncode']) {
      if(strlen($_GET['vpncode']) == 6) {
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
        echo "Error 1: Der VPN-Code ist ungültig";
      }
    } else {
      ?>
        <form method="get">
          <label for="vpncode">Bitte gebe deinen VPN-Code ein, welchen du auch im Fragebogen eingegeben hast. Dieser setzt sich zusammen aus ###########
              <input type="text" id="vpncode" name="vpncode" placeholder="VPN-Code" minlength="6" maxlength="6">
          </label>
          <label for="send_form">
            <input type="submit" value="Senden" id="send_form">
          </label>
        </form>
      <?php
    }

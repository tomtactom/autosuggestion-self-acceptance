<?php
    if (!$_GET['vpncode']) {
      if(strlen($_GET['vpncode']) == 6) {



      } else {
        $error = "";
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

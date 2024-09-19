<?php
// Einbinden der privaten Daten
include 'informations.inc.php';
?>
  </main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted">© <?php echo date('Y'); ?> <?php echo $privateData['name']; ?>. Alle Rechte vorbehalten.</p>
                <h6>Kontakt</h6>
                <p class="text-muted" id="email-container"></p>
                <p class="text-muted" id="phone-container"></p>
            </div>
            <div class="col-md-6 text-md-right">
                <button class="btn btn-link text-muted" data-toggle="modal" data-target="#impressumModal" aria-label="Impressum anzeigen">Impressum</button>
                <button class="btn btn-link text-muted" data-toggle="modal" data-target="#datenschutzModal" aria-label="Datenschutz anzeigen">Datenschutz</button>
            </div>
        </div>
    </div>

    <!-- Impressum Modal -->
    <div class="modal fade" id="impressumModal" tabindex="-1" role="dialog" aria-labelledby="impressumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="impressumModalLabel">Impressum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Impressum</strong></p>
                    <p><strong>Verantwortlich:</strong> <?php echo $privateData['name']; ?></p>
                    <p><strong>Hochschule:</strong> <?php echo $privateData['university']; ?></p>
                    <p><strong>Adresse:</strong> <?php echo $privateData['address']; ?></p>
                    <p><strong>Haftungsausschluss:</strong> Die Inhalte dieser Website wurden mit größtmöglicher Sorgfalt erstellt. Der Anbieter übernimmt jedoch keine Gewähr für die Vollständigkeit und Richtigkeit der bereitgestellten Informationen. Die Website ist ab 16 Jahren zur Verwendung erlaubt.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Datenschutz Modal -->
    <div class="modal fade" id="datenschutzModal" tabindex="-1" role="dialog" aria-labelledby="datenschutzModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datenschutzModalLabel">Datenschutz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Datenschutz</strong></p>
                      <p>Herzlich willkommen auf unserer Webseite! Wir freuen uns über Ihr Interesse und möchten Ihnen transparent und verständlich erklären, wie wir Ihre Daten behandeln.</p>

                      <p><strong>1. Wer ist für die Datenverarbeitung verantwortlich?</strong></p>
                      <p><?php echo $privateData['name']; ?><br>
                      <?php echo $privateData['address']; ?><br>
                      Telefon: <?php echo $privateData['phone']; ?><br>
                      E-Mail: <?php echo $privateData['email']; ?></p>

                      <p><strong>2. Welche Daten erfassen wir und warum?</strong></p>
                      <ul style="text-align: left;">
                          <li><strong>Technische Daten:</strong> Wie bei vielen Webseiten üblich, erfassen wir technische Informationen wie Ihre IP-Adresse, den Browsertyp und das Datum sowie die Uhrzeit Ihres Besuchs. Diese Daten helfen uns, die Webseite zu optimieren und sicherzustellen, dass alles reibungslos funktioniert.</li>
                          <li><strong>Formulardaten:</strong> Wenn Sie unser Formular nutzen, speichern wir Ihre E-Mail-Adresse, um Ihnen wichtige Informationen oder Updates zukommen zu lassen.</li>
                          <li><strong>Pseudonymisierte Daten:</strong> Wir verwenden einen VPN-Code, der gemeinsam mit den Daten durch SoSciSurvey verarbeitet wird. Diese Daten sind pseudonymisiert und werden ausschließlich zu Forschungszwecken verwendet.</li>
                          <li><strong>Psychologische und psychometrische Gesundheitsdaten:</strong> Im Rahmen unserer Studie erfassen wir diese speziellen Daten, um herauszufinden, wie Autosuggestionen die Selbstakzeptanz beeinflussen können.</li>
                      </ul>

                      <p><strong>3. Warum verarbeiten wir Ihre Daten?</strong></p>
                      <p>Ihre Daten helfen uns, wissenschaftliche Erkenntnisse zu gewinnen und die Studie erfolgreich durchzuführen. Wir anonymisieren die Daten so schnell wie möglich, um Ihre Privatsphäre zu schützen. Anonyme Daten können langfristig gespeichert und veröffentlicht werden, um die Forschung weiter voranzutreiben.</p>

                      <p><strong>4. Geben wir Ihre Daten weiter?</strong></p>
                      <p>Ihre pseudonymisierten Daten werden an SoSciSurvey und Netcup weitergegeben. Beide Partner sind verpflichtet, Ihre Daten sicher zu behandeln und nur für die Zwecke unserer Studie zu nutzen. Alle Server befinden sich in Deutschland, und Ihre Daten werden über verschlüsselte Verbindungen übertragen. Pseudonymisierte Daten werden nicht in Drittländer übertragen, während anonyme Daten aus wissenschaftlichem Interesse veröffentlicht werden können.</p>

                      <p><strong>5. Wie lange speichern wir Ihre Daten?</strong></p>
                      <p>Wir speichern Ihre personenbezogenen Daten bis zum Ende des Projektes oder spätestens bis Ende 2026. Danach werden die Daten anonymisiert und in dieser Form unbegrenzt aufbewahrt.</p>

                      <p><strong>6. Welche Rechte haben Sie?</strong></p>
                      <p>Sie haben das Recht, Auskunft über die von Ihnen gespeicherten Daten zu erhalten sowie deren Berichtigung oder Löschung zu verlangen. Pseudonymisierte Daten können auf Anfrage korrigiert oder gelöscht werden. Sobald die Daten anonymisiert sind, ist eine Löschung oder Berichtigung nicht mehr möglich. Bitte senden Sie dazu eine formale E-Mail an uns.</p>

                      <p><strong>7. Beschwerderecht und Widerruf</strong></p>
                      <p>Wenn Sie der Ansicht sind, dass wir Ihre Daten nicht korrekt verarbeiten, haben Sie das Recht, sich bei einer Aufsichtsbehörde zu beschweren. Sollten Sie uns Ihre Einwilligung zur Datenverarbeitung gegeben haben, können Sie diese jederzeit widerrufen. Der Widerruf hat keinen Einfluss auf die Rechtmäßigkeit der bis dahin erfolgten Verarbeitung.</p>

                      <p><strong>8. Kontakt bei Datenschutzfragen</strong></p>
                      <p>Wenn Sie Fragen zum Datenschutz haben oder Ihre Rechte ausüben möchten, können Sie uns gerne kontaktieren:<br>
                      <?php echo $privateData['name']; ?><br>
                      <?php echo $privateData['address']; ?><br>
                      Telefon: <?php echo $privateData['phone']; ?><br>
                      E-Mail: <?php echo $privateData['email']; ?></p>

                      <p>Sollte der Kontakt zu mir nicht möglich sein, wenden Sie sich bitte an den Datenschutzbeauftragten der Hochschule Rhein-Waal:</p>
                      <p>Andreas Braam<br>
                      Marie-Curie-Straße 1<br>
                      47533 Kleve<br>
                      E-Mail: datenschutz@hochschule-rhein-waal.de</p>

                      <p><strong>9. Cookies und ähnliche Technologien</strong></p>
                      <p>Wir verwenden keine Cookies. Es werden jedoch pseudonymisierte Daten zum Klickverhalten und zur Nutzung der Autosuggestionen erfasst.</p>

                      <p><strong>10. Änderungen der Datenschutzerklärung</strong></p>
                      <p>Änderungen dieser Datenschutzerklärung werden per E-Mail an die von Ihnen angegebene Adresse kommuniziert. Es liegt in Ihrer Verantwortung, sich über etwaige Änderungen zu informieren. Bei fehlender E-Mail-Adresse sind Sie eigenverantwortlich, sich regelmäßig über Aktualisierungen zu informieren.</p>

                      <p><strong>11. SoSciSurvey und Auftragsverarbeitung</strong></p>
                      <p>SoSciSurvey verarbeitet die von Ihnen bereitgestellten pseudonymisierten Daten im Auftrag von Tom Aschmann gemäß dem abgeschlossenen Auftragsverarbeitungsvertrag. SoSciSurvey verpflichtet sich, die Daten gemäß den geltenden Datenschutzbestimmungen zu schützen und ausschließlich für die in der Studie vorgesehenen Zwecke zu verwenden.</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScript-Bibliotheken -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Schutz für die E-Mail-Adresse
    document.getElementById('email-container').innerHTML = 'E-Mail: <a href="mailto:' + '<?php echo $privateData['email']; ?>' + '">' + '<?php echo $privateData['email']; ?>' + '</a>';

    // Schutz für die Telefonnummer
    document.getElementById('phone-container').innerHTML = 'Telefon: <?php echo $privateData['phone']; ?>';
</script>
</body>
</html>

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
                <button class="btn btn-link text-muted" data-bs-toggle="modal" data-bs-target="#impressumModal" aria-label="Impressum anzeigen">Impressum</button>
                <button class="btn btn-link text-muted" data-bs-toggle="modal" data-bs-target="#datenschutzModal" aria-label="Datenschutz anzeigen">Datenschutz</button>
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
                    <p><strong>Telefonnummer:</strong> <?php echo $privateData['phone']; ?></p>
                    <p><strong>Adresse:</strong> <?php echo $privateData['address']; ?></p>
                    <p><strong>Haftungsausschluss:</strong> Die Inhalte dieser Website wurden mit größtmöglicher Sorgfalt erstellt. Der Anbieter übernimmt jedoch keine Gewähr für die Vollständigkeit und Richtigkeit der bereitgestellten Informationen. Die Website ist ab 16 Jahren zur Verwendung erlaubt.</p>
                    <p><strong>Hochschule:</strong> <?php echo $privateData['university']; ?></p>
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
                    <p>Herzlich willkommen auf dieser Webseite! Es wird erläutert, wie die Daten behandelt werden.</p>

                    <p><strong>1. Verantwortliche Stelle</strong></p>
                    <p><?php echo $privateData['name']; ?><br>
                    <?php echo $privateData['address']; ?><br>
                    Telefon: <?php echo $privateData['phone']; ?><br>
                    E-Mail: <?php echo $privateData['email']; ?></p>

                    <p><strong>2. Erfasste Daten und Zweck</strong></p>
                    <ul style="text-align: left;">
                        <li><strong>Technische Daten:</strong> Wie bei vielen Webseiten üblich, werden technische Informationen wie die IP-Adresse, der Browsertyp und das Datum sowie die Uhrzeit des Besuchs erfasst. Diese Daten helfen, die Webseite zu optimieren und sicherzustellen, dass alles reibungslos funktioniert.</li>
                        <li><strong>Formulardaten:</strong> Wenn das Formular genutzt wird, werden die E-Mail-Adresse und andere eingegebene Daten gespeichert, um wichtige Informationen oder Updates zukommen zu lassen.</li>
                        <li><strong>Pseudonymisierte Daten:</strong> Ein VPN-Code wird zusammen mit den Daten durch SoSciSurvey verarbeitet. Diese Daten sind pseudonymisiert und werden ausschließlich zu Forschungszwecken verwendet.</li>
                        <li><strong>Psychologische und psychometrische Gesundheitsdaten:</strong> Im Rahmen der Studie werden spezielle Daten erfasst, um herauszufinden, wie Autosuggestionen die Selbstakzeptanz beeinflussen können.</li>
                    </ul>

                    <p><strong>3. Zweck der Datenverarbeitung</strong></p>
                    <p>Die Daten helfen, wissenschaftliche Erkenntnisse zu gewinnen und die Studie erfolgreich durchzuführen. Die Daten werden so schnell wie möglich anonymisiert, um die Privatsphäre zu schützen. Anonyme Daten können langfristig gespeichert und veröffentlicht werden, um die Forschung weiter voranzutreiben.</p>

                    <p><strong>4. Datenweitergabe</strong></p>
                    <p>Die pseudonymisierten Daten werden an SoSciSurvey weitergegeben. Dieser Partner ist verpflichtet, die Daten sicher zu behandeln und nur für die Zwecke der Studie zu nutzen. Alle Server befinden sich in Deutschland, und die Daten werden über verschlüsselte Verbindungen übertragen. Pseudonymisierte Daten werden nicht in Drittländer übertragen, während anonyme Daten aus wissenschaftlichem Interesse veröffentlicht werden können.</p>

                    <p><strong>5. Speicherdauer der Daten</strong></p>
                    <p>Die personenbezogenen Daten werden bis zum Ende des Projektes oder spätestens bis Ende 2026 gespeichert. Danach werden die Daten anonymisiert und in dieser Form unbegrenzt aufbewahrt.</p>

                    <p><strong>6. Rechte der betroffenen Personen</strong></p>
                    <p>Es besteht das Recht, Auskunft über die gespeicherten Daten zu erhalten sowie deren Berichtigung oder Löschung zu verlangen. Pseudonymisierte Daten können auf Anfrage korrigiert oder gelöscht werden. Nach der Anonymisierung ist eine Löschung oder Berichtigung nicht mehr möglich. Bei Fragen dazu kann eine formale E-Mail gesendet werden.</p>

                    <p><strong>7. Beschwerderecht und Widerruf</strong></p>
                    <p>Bei der Annahme, dass die Daten nicht korrekt verarbeitet werden, besteht das Recht, sich bei einer Aufsichtsbehörde zu beschweren. Eine erteilte Einwilligung zur Datenverarbeitung kann jederzeit widerrufen werden. Der Widerruf hat keinen Einfluss auf die Rechtmäßigkeit der bis dahin erfolgten Verarbeitung.</p>

                    <p><strong>8. Kontakt bei Datenschutzfragen</strong></p>
                    <p>Bei Fragen zum Datenschutz oder zur Ausübung der Rechte kann gerne Kontakt aufgenommen werden:<br>
                    <?php echo $privateData['name']; ?><br>
                    <?php echo $privateData['address']; ?><br>
                    Telefon: <?php echo $privateData['phone']; ?><br>
                    E-Mail: <?php echo $privateData['email']; ?></p>

                    <p>Wenn der Kontakt nicht möglich ist, kann sich an den Datenschutzbeauftragten der Hochschule Rhein-Waal gewandt werden:</p>
                    <p>Andreas Braam<br>
                    Marie-Curie-Straße 1<br>
                    47533 Kleve<br>
                    E-Mail: datenschutz@hochschule-rhein-waal.de</p>

                    <p><strong>9. Cookies und ähnliche Technologien</strong></p>
                    <p>Es werden keine Cookies verwendet. Allerdings werden pseudonymisierte Daten zum Klickverhalten und zur Nutzung der Autosuggestionen erfasst.</p>

                    <p><strong>10. Änderungen der Datenschutzerklärung</strong></p>
                    <p>Änderungen dieser Datenschutzerklärung werden per E-Mail an die angegebene Adresse kommuniziert. Es liegt in der Verantwortung, sich über etwaige Änderungen zu informieren. Bei fehlender E-Mail-Adresse ist es wichtig, sich regelmäßig über Aktualisierungen zu informieren.</p>

                    <p><strong>11. SoSciSurvey und Auftragsverarbeitung</strong></p>
                    <p>SoSciSurvey verarbeitet die bereitgestellten pseudonymisierten Daten im Auftrag von <?php echo $privateData['name']; ?> gemäß dem abgeschlossenen Auftragsverarbeitungsvertrag. SoSciSurvey verpflichtet sich, die Daten gemäß den geltenden Datenschutzbestimmungen zu schützen und ausschließlich für die in der Studie vorgesehenen Zwecke zu verwenden.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScript-Bibliotheken -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-6crM8dMz8mI1AlSwfTuG8w9MZo/g5U1YAWP9T4lDQh0=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./assets/timer.js"></script> <!-- JavaScript 4-Minuten Timer für die Übung -->
<script>
    // Schutz für die E-Mail-Adresse
    document.getElementById('email-container').innerHTML = 'E-Mail: <a href="mailto:' + '<?php echo $privateData['email']; ?>' + '">' + '<?php echo $privateData['email']; ?>' + '</a>';

    // Schutz für die Telefonnummer
    document.getElementById('phone-container').innerHTML = 'Telefon: <?php echo $privateData['phone']; ?>';
</script>
</body>
</html>

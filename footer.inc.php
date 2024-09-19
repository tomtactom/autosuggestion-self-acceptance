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
                    <p>Der Schutz Ihrer persönlichen Daten ist uns wichtig. Wir erheben, verarbeiten und nutzen Ihre Daten ausschließlich im Rahmen der gesetzlichen Bestimmungen. Diese Website ist nur für Personen ab 16 Jahren gedacht. Weitere Informationen zum Datenschutz finden Sie hier.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
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

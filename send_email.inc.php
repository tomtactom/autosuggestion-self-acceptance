<?php
function sendEmail($email, $group) {
    global $privateData; // Zugriff auf die globale Variable

    $subject = "Willkommen zur Intervention zur Selbstakzeptanz";

    if ($group == 1) {
        $message = "Herzlich willkommen in der Interventionsgruppe! Hier sind Ihre Anweisungen für die nächsten 10 Tage...";
        // Weitere Instruktionen für die Interventionsgruppe
    } elseif ($group == 2) {
        $message = "Willkommen in der Kontrollgruppe! Hier sind Ihre Anweisungen für die nächsten 10 Tage...";
        // Weitere Instruktionen für die Kontrollgruppe
    } else {
        return false; // Ungültige Gruppe
    }

    // E-Mail Header
    $headers = "From: " . $privateData['server_email'];

    // E-Mail senden
    return mail($email, $subject, $message, $headers);
}
?>

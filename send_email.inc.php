<?php
function sendEmail($email, $group) {
    global $privateData; // Zugriff auf die globale Variable

    $subject = "Willkommen zur Selbst-Akzeptanz-Übung!";

    if ($group == 1) {
        $message = "<p>Vielen Dank, dass du an dieser Studie teilnimmst! In dieser E-Mail erhälst du alle Informationen zu deiner Selbst-Akzeptanz-Übung.</p>

<h2>So läuft es ab:</h2>

<ul>
    <li>
        <strong>Tägliche E-Mails:</strong> In den nächsten 10 Tagen bekommst du jeden Morgen um 07:00 Uhr und jeden Abend um 20:00 Uhr eine E-Mail mit einem persönlichen Link zu deiner Übung.
        Diese Übungen sind darauf ausgelegt, deine Selbstakzeptanz zu fördern.
    </li>
    <li>
        <strong>Dein Engagement zählt:</strong> Es ist wichtig, dass du die Übungen regelmäßig machst, um den vollen Nutzen zu ziehen. Wenn du einmal vergisst, ist das kein Problem –
        mach einfach beim nächsten Mal weiter! Die Übungen bleiben gleich, um dir die Teilnahme zu erleichtern.
    </li>
</ul>

<h2>Dein Nutzen:</h2>
<p>
    Durch deine Teilnahme hast du die Möglichkeit, an einer Verlosung von 3x 10 € Wunschgutscheinen teilzunehmen und eine 3-monatige kostenlose Premium-Mitgliedschaft der Meditationsapp 7mind zu erhalten.
    Als Student:in der HSRW bekommst du außerdem 3 Versuchspersonenstunden gutgeschrieben. Dafür benötige ich jedoch deine regelmäßige Teilnahme. Darüber hinaus trägst du aktiv zur wissenschaftlichen Forschung bei und hilfst mir persönlich bei meiner Bachelorarbeit –
    dein Beitrag ist wertvoll!
</p>

<h2>Gemeinsam stark:</h2>
<p>
    Indem du diese 10 Tage durchziehst, stärkst du nicht nur deine eigene Selbstakzeptanz, sondern unterstützt auch die psychologische Forschung. Ich danke dir herzlich für dein Engagement und freue mich auf deine Teilnahme!
</p>

<p>Nach 10 Tagen bekommst du einen persönlichen Link für den zweiten Fragebogen. Nachdem du diesen vollständig ausgefüllt hast und die Übungen regelmäßig durchgegangen bist, kannst du an der Verlosung teilnehmen, bekommst eine 3monatige Premium Mitgliedschaft der Meditationsapp 7mind und als Student:in der HSRW 3 Versuchspersonenstunden.<br>
    Wenn du Fragen hast oder Unterstützung benötigst, stehe ich dir jederzeit zur Verfügung.
</p>";
        // Weitere Instruktionen für die Interventionsgruppe
    } elseif ($group == 2) {
        $message = "<p>Vielen Dank, dass du an dieser Studie teilnimmst! In dieser E-Mail erhälst du alle Informationen zu deiner Selbst-Akzeptanz-Übung.</p>

<h2>So läuft es ab:</h2>

<p>
    Versuche in den kommenden 10 Tagen, dich selbst so zu akzeptieren wie du bist. Die Forschung hat gezeigt, dass es bereits hilfreich ist, sich vorzunehmen, die eigene Selbstakzeptanz zu fördern.
</p>

<h2>Dein Nutzen:</h2>
<p>
    Durch deine Teilnahme hast du die Möglichkeit, an einer Verlosung von 3x 10 € Wunschgutscheinen teilzunehmen und eine 3-monatige kostenlose Premium-Mitgliedschaft der Meditationsapp 7mind zu erhalten.
    Als Student:in der HSRW bekommst du außerdem 3 Versuchspersonenstunden gutgeschrieben. Dafür benötige ich jedoch deine regelmäßige Teilnahme. Darüber hinaus trägst du aktiv zur wissenschaftlichen Forschung bei und hilfst mir persönlich bei meiner Bachelorarbeit –
    dein Beitrag ist wertvoll!
</p>

<h2>Gemeinsam stark:</h2>
<p>
    Mit dem ausfüllen des zweiten Fragebogens, stärkst du nicht nur deine eigene Selbstakzeptanz, sondern unterstützt auch die psychologische Forschung. Ich danke dir herzlich für dein Engagement und freue mich auf deine Teilnahme!
</p>

<p>Nach 10 Tagen bekommst du einen persönlichen Link für den zweiten Fragebogen. Nachdem du diesen vollständig ausgefüllt hast, kannst du an der Verlosung teilnehmen, bekommst eine 3monatige Premium Mitgliedschaft der Meditationsapp 7mind und als Student:in der HSRW 3 Versuchspersonenstunden.<br>
    Wenn du Fragen hast oder Unterstützung benötigst, stehe ich dir jederzeit zur Verfügung.
</p>";
        // Weitere Instruktionen für die Kontrollgruppe
    } else {
        return false; // Ungültige Gruppe
    }

    // E-Mail Header
    $headers = "From: " . $privateData['server_email'] . "\r\n" .
           "Reply-To: ".$privateData['email']."\r\n" . // Antwort an die spezifische E-Mail-Adresse
           "Content-Type: text/html; charset=UTF-8\r\n" . // HTML-Header
           "X-Mailer: PHP/" . phpversion();

    // E-Mail senden
    return mail($email, $subject, $message, $headers);
}
?>

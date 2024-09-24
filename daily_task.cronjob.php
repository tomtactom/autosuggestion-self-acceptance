<?php
    if ($_GET['daytime'] == "morning") {

    } elseif ($_GET['daytime'] == "evening") {

    } else {
      http_response_code(422); // 422 Unprocessable Entity wird verwendet, wenn die Anfrage korrekt ist, aber die übermittelten Daten aus inhaltlichen Gründen nicht verarbeitet werden können
      exit;
    }

    

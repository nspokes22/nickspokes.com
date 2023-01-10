<?php
    $headers = 'From: notifications@nickspokes.com'."\r\n".'Reply-To: '.$_POST['Email']."\r\n".'X-Mailer: PHP/'.phpversion();
    mail('nick@nickspokes.com', $_POST['Name'], $_POST['Message'], $headers);
    echo '<script>window.close();</script>';
?>
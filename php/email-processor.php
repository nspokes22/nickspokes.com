<?php
    $headers = 'From: notifications@nickspokes.com'."\r\n".'Reply-To: '.$_POST['Email']."\r\n".'X-Mailer: PHP/'.phpversion();
    mail('nick@nickspokes.com', $_POST['Name'], $_POST['Message'], $headers);
    $headers = 'From: notifications@nickspokes.com'."\r\n".'Reply-To: nick@nickspokes.com'."\r\n".'X-Mailer: PHP/'.phpversion();
    mail($_POST['Email'], "Message Sent Confirmation", "Your message has been sent and I will respond soon, thank you!\n\nMessage sent automatically through nickspokes.com.", $headers);
    echo '<script>alert("Message sent! To confirm it has reached its destination, check your inbox.");</script>';
    echo '<script>window.close();</script>';
?>
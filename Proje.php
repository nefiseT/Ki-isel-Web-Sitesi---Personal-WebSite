<?php
if (isset($_POST['Email'])) {

    // EDIT THE FOLLOWING TWO LINES:
    $email_to = "nefise.turkohlu@ogr.sakarya.edu.tr";
    $email_subject = "İletişim Formu";

    function problem($error)
    {
        echo "Doldurduğunuz formda birkaç hata var galiba. ";
        echo "Bulunan hatalar işaretlidir.<br><br>";
        echo $error . "<br><br>";
        echo "Hataları düzeltip tekrar deneyiniz.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) 
    
    {
        problem('Doldurduğunuz formda birkaç hata var galiba.');
    }

    $name = $_POST['Name']; // lazım
    $email = $_POST['Email']; // lazım
    $message = $_POST['Message']; // lazım

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Geçerli bir mail adresi giriniz.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Geçerli bir isim giriniz.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Geçerli bir mesaj giriniz.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form detayları.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- INCLUDE YOUR SUCCESS MESSAGE BELOW -->

    İletişime geçtiğiniz için Teşekkürler. Lütfen tarafımızdan dönüş bekleyin...

<?php
}
?>

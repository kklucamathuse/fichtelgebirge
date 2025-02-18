<?php

/**
 * WICHTIG
 *
 * Manche Benennungen von Variablen sind von WordPress reserviert und können nicht als name-attribute für Felder genutzt werden.
 * Eine Liste mit allen NONOs finden ihr hier: https://codex.wordpress.org/Reserved_Terms
 *
 * CSV Datien
 * Bitte denkt daran, den Head der csv-dateien anzupassen. Diese sollten entsprechend der Reiehenfolge sein.
 * Beispiel: Datum;Name;Telefon;Email;Nachricht
 *
 *
 */
?>
<?php
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php")) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();
}

// Get PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/PHPMailer-6.6.5/src/Exception.php';
require 'vendor/PHPMailer-6.6.5/src/PHPMailer.php';
require 'vendor/PHPMailer-6.6.5/src/SMTP.php';

// Check + Set field values
/* How to use
     * <input type="text" id="name" name="name" value="<?php echo cfv( 'name' ) ?>"> - "name" darf nicht als name verwendet werden
     * <option <?php echo ( cfv( 'salutation' ) == 'Herr' ? 'selected="selected"' : '' ); ?> value="Herr">Herr</option>
     * <textarea id="notice" name="notice" maxlength="200" placeholder="Platzhaltertext"><?php echo cfv( 'notice' ) ?></textarea>
     * <input type="checkbox" id="dse" name="dse" <?php echo ( cfv( 'dse' ) == true ? 'checked="checked"' : '' ); ?>/>
     * <div class="form-field-group file-group selection">
	Wählen Sie ein Bild zum Upload aus <br>
	<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
	<input type="file" class="form-control-file actual-btn" name="additional_files[]" id="additional_files" multiple accept="image/*,.pdf,.doc">
    </div>
     */

if (!function_exists('cfv')) {
    function cfv($value)
    {
        $currentFieldValues = $_POST;
        $currentFieldValues = array_filter($currentFieldValues);
        if (isset($currentFieldValues[$value])) {
            return $currentFieldValues[$value];
        }
    }
}

if (empty($_POST)) {
    // Start session
    // declare before DOCTYPE | session_start();
    $_SESSION['time'] = time();

} else {
    // Required fields
    $requiredFields = array('full-name', 'phone', 'email', 'dsgvo');
    $errorRequiredFields = false;
    $errorBots = false;
    $errorFields = array();

    foreach ($requiredFields as $requiredField) {
        if (empty($_POST[$requiredField])) {
            $errorFields[] = $requiredField;
            $errorRequiredFields = true;
        }
    }

    // Honeypot -> trap for bots
    if (!empty($_POST['confirm'])) {
        $errorBots = true;
    }

    // When the form is submitted in under three seconds -> detect as bot
    $startSession = $_SESSION['time'];
    $submitForm = time();

    // echo "<br/><br/><br/>startSession: " . $startSession . " | submitForm: " . $submitForm . " | ";

    if ($submitForm - $startSession < 3) {
        $errorBots = true;
    }

    $mail = new PHPMailer();
    include 'smtp/data.php';

    $mail->CharSet = 'utf-8';
    $mail->From = $_ENV["KK_SMTP_USERNAME"];
    $mail->FromName = $_ENV["KK_SMTP_FROMNAME"];
    $mail->Subject = "Bergauf Kreativkarussell - Anfrage";
    $mail->ErrorInfo = '';

    // Generate Mail
    $message = null;
    $message .= 'Bergauf Kreativkarussell: ' . "\n";
    $message .= 'Vor- und Nachname: ' . $_POST['full-name'] . "\n";
    $message .= 'Telefon: ' . $_POST['phone'] . "\n";
    $message .= 'E-Mail-Adresse: ' . $_POST['email'] . "\n";
    //$message .= 'DSGVO wurde zugestimmt: ' . $_POST['dsgvo'] . "\n";
    if (!empty($_POST['notice'])) {
        $message .= 'Nachricht:' . "\n" . trim($_POST['notice']);
    }

    $mail->Body = $message;

    // Main Recipient
    $mail->AddAddress($receiver);
    $mail->addReplyTo($_POST['email'], $_POST['full-name']);

    /*
        // Recipient List
        $recipients = array(
            'max@mustermann.de' => 'Max Mustermann',
            'melanie@mustermann.de' => 'Melanie Mustermann',
		);

        // Set recipients as CC
		foreach($recipients as $email => $name) {
            $mail->AddCC($email, $name);
		}
        */

        $info = null;

        // Required fields not filled out
        if ($errorRequiredFields) {
	    $errorMessage ="";
            if (empty($_POST['full-name'])) {
                $errorMessage .= '&bull; Vor- und Nachname<br/>';
            }

            if (empty($_POST['phone'])) {
                $errorMessage .= '&bull; Telefonnummer<br/>';
            }

            if (empty($_POST['email'])) {
                $errorMessage .= '&bull; E-Mail-Adresse<br/>';
            }

            if (empty($_POST['dsgvo'])) {
                $errorMessage .= '&bull; Einwilligung der Datenschutzbestimmungen<br/>';
            }

            $info = '<div class="form-error w-full border-rose-500 border-2 border-solid bg-rose-500/[.02] p-8 mb-8"><p><strong>Bitte füllen Sie alle Pflichtfelder aus:</strong><br/>' . $errorMessage . '</p></div>';

            // Display time difference between "enter page" and "send form"
            // echo 'You submitted the form after ' . ($submitForm - $startSession) . ' seconds';
            // Reset variables after trying to send form
            $startSession = time();
            $_SESSION['time'] = time();
        }

    // Bot detected
    else if ($errorBots) {
        $info = '<div class="form-error w-full border-rose-500 border-2 border-solid bg-rose-500/[.03] p-8 mb-8"><strong>Leider ist ein Fehler beim Versenden Ihrer Nachricht aufgetreten. (Fehlercode: 999)</strong></div>';
    }

    // Okay
    else {
	/*
	//attach Files to the Email
	if (isset($_FILES["additional_files"])) {
            if (isset($_FILES["additional_files"]["name"])) {
              if ($_FILES["additional_files"]["name"][0]!="") {
                $countadditional_files = count($_FILES['additional_files']['name']);

                for ($i = 0; $i < $countadditional_files; $i++) {
                $mail->AddAttachment($_FILES['additional_files']['tmp_name'][$i], $_FILES['additional_files']['name'][$i]);
                }
              }
            }
          }
	*/
        // Mail could not be sent. Technical / SMTP error
        if (!$mail->Send()) {
            $info = '<div class="form-error w-full border-rose-500 border-2 border-solid bg-rose-500/[.03] p-8 mb-8"><p><strong>Leider ist beim Versenden Ihrer Nachricht ein technischer Fehler aufgetreten.</strong><br/> Bitte versuchen Sie es erneut oder kontaktieren Sie uns telefonisch unter 02961 - 9108000</p></div>';

            // Logging

            // open file (must already exist!!) and set mode
            $file = __DIR__ . '/logs/error.csv';
            $fh = fopen($file, 'a');

            // get and write data
            $data = date("d.m.Y H:i:s") . ";";
            $data .= $_POST['full-name'] . ";";
            $data .= $_POST['phone'] . ";";
            $data .= $_POST['email'] . ";";
            $data .= $_POST['notice'] . ";";
            $data .= "\n"; // new line
            fwrite($fh, $data);
            fclose($fh);
        }

        // Mail sent, everything's ok
        else {
            $info = '<div class="form-success w-full border-emerald-500 border-2 border-solid bg-emerald-500/[.03] p-8 mb-8"><p><strong>Vielen Dank für Ihre Anfrage.</strong><br/>Wir melden uns zeitnah bei Ihnen zurück.</p></div>';

            // Logging

            // open file (must already exist!!) and set mode
            $file = __DIR__ . '/logs/success.csv';
            $fh = fopen($file, 'a');

            // get and write data
            $data = date("d.m.Y H:i:s") . ";";
            $data .= $_POST['full-name'] . ";";
            $data .= $_POST['phone'] . ";";
            $data .= $_POST['email'] . ";";
            $data .= $_POST['notice'] . ";";
            $data .= "\n"; // new line
            fwrite($fh, $data);
            fclose($fh);

            // reset $_POST
            $_POST = array();
        }
    }
}
//use <form id="form" method="post" action="#form" autocomplete="false" enctype="multipart/form-data"> if you need to upload files
?>
    <form id="form" method="post" action="#form" autocomplete="false">
        <?php if (isset($info)) { ?>
            <?php echo $info; ?>
        <?php } ?>

        <div class="form-inner space-y-8">
            <div class="form-field-group">
                <label for="full-name" class="inline-block mb-2">Vor- und Nachname *</label>
                <input type="text" id="full-name" class="w-full h-12 p-4 border-gray-300 border-2 border-solid" name="full-name" value="<?php echo cfv('full-name') ?>" />
            </div>

            <div class="form-field-group">
                <label for="phone" class="inline-block mb-2">Telefonnummer *</label>
                <input type="tel" id="phone" class="w-full h-12 p-4 border-gray-300 border-2 border-solid" name="phone" value="<?php echo cfv('phone') ?>" />
            </div>

            <div class="form-field-group">
                <label for="email" class="inline-block mb-2">E-Mail-Adresse *</label>
                <input type="email" id="email" class="w-full h-12 p-4 border-gray-300 border-2 border-solid" name="email" value="<?php echo cfv('email') ?>"  />
            </div>

            <div class="form-field-group">
                <label for="notice" class="inline-block mb-2">Nachricht</label>
                <textarea id="notice" class="w-full min-h-32 p-4 border-gray-300 border-2 border-solid" name="notice"><?php echo cfv('notice') ?></textarea>
            </div>

            <div class="form-field-group">
                <label class="checkbox flex cursor-pointer" for="dsgvo">
                    <span class="relative w-6 h-6 mt-1 mr-4 shrink-0 lg:mt-0">
                        <input type="checkbox" id="dsgvo" class="appearance-none block w-full h-full border-gray-300 border-2 border-solid transition ease-in-out peer checked:bg-primary checked:border-primary" name="dsgvo" <?php echo (cfv('dsgvo') == true ? 'checked="checked"' : ''); ?>/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"  class="absolute top-1/2 left-1/2 w-4 h-4 -translate-x-1/2 -translate-y-1/2 opacity-0 transition ease-in-out stroke-white peer-checked:opacity-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    <span class="checkbox-text">
                        Mit dem Absenden des Kontaktformulars bestätige ich, dass ich mit den <a href="<?php echo $dsvLink; ?>" target="_blank">Datenschutzbestimmungen</a>
                        einverstanden bin.</span>
                </label>
            </div>

            <?php /* honeypot */ ?>
            <input type="text" id="confirm" name="confirm" value="<?php echo cfv('confirm') ?>" tabindex="-1" autocomplete="off" class="hidden" />

            <button class="btn btn-primary" type="submit" name="submit">
                Abschicken
            </button>

        </div>
    </form>

<?php if (!empty($errorFields)) { ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var errorFields = <?php echo json_encode($errorFields); ?>;

            $.each(errorFields, function(index, value) {
                jQuery("*[name='" + value + "']").addClass("error border-rose-500");
            });
        }, false);
    </script>
<?php } ?>

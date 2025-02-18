<?php   
  $mail->IsSMTP();
  $mail->SMTPDebug = $_ENV['KK_SMTP_DEBUG'];
  /**
      * level 1 = client; will show you messages sent by the client
      * level 2  = client and server; will add server messages, it’s the ### recommended ### setting.
      * level 3 = client, server, and connection; will add information about the initial information, might be useful for discovering STARTTLS failures
      * level 4 = low-level information.
    */
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = $_ENV['KK_SMTP_SECURE'];
  $mail->Host = $_ENV['KK_SMTP_HOST'];
  $mail->Port = $_ENV['KK_SMTP_PORT'];
  $mail->Username = $_ENV['KK_SMTP_USERNAME'];
  $mail->Password = $_ENV['KK_SMTP_PASSWORD'];
  $mail->Mailer = "smtp";
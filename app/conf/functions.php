<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    function flash($key) {
        if (!empty($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $message;
        }
        return null;
    }

    function sendVerifyCode($email) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pixelgallery777@gmail.com';
        $mail->Password   = 'qqbn sffy mdsf wbls';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('pixelgallery777@gmail.com');
        $mail->addAddress($email);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $mail->isHTML(true);
        $mail->Subject = 'Лучшая галерея в мире!!!';
        $mail->Body = "Код подтверждения: $code";

        $mail->send();
        return $code;
    }

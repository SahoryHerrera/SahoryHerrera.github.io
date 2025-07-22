<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $to = "sahoryherrera2233@gmail.com"; // Tu correo real de destino
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Correo inválido.";
    exit;
  }

  $email_content = "Nombre: $name\n";
  $email_content .= "Correo: $email\n";
  $email_content .= "Asunto: $subject\n\n";
  $email_content .= "Mensaje:\n$message\n";

  $email_headers = "From: $name <$email>";

  if (mail($to, $subject, $email_content, $email_headers)) {
    http_response_code(200);
    echo "Mensaje enviado correctamente.";
  } else {
    http_response_code(500);
    echo "Hubo un error al enviar el mensaje.";
  }
} else {
  http_response_code(403);
  echo "Método no permitido.";
}
?>

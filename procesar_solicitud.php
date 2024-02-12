<?php
require 'vendor/autoload.php'; // Importa la biblioteca SendGrid

use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $tipo_de_solicitud = $_POST["tipo_de_solicitud"];
    $mensaje = $_POST["mensaje"];
    
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "Por favor completa todos los campos.";
    } else {
        // Crea un objeto Mail de SendGrid
        $correo = new Mail();
        $correo->setFrom("tu@email.com", "Tu Nombre");
        $correo->setSubject("Nueva solicitud de servicio desde la Ventanilla Única");
        $correo->addTo("dfcalderon32@gmail.com", "Diego");
        
        // Construye el cuerpo del correo electrónico
        $contenido_texto = "Nombre: $nombre\n";
        $contenido_texto .= "Email: $email\n";
        $contenido_texto .= "Teléfono: $telefono\n";
        $contenido_texto .= "Tipo de solicitud: $tipo_de_solicitud\n";
        $contenido_texto .= "Mensaje:\n$mensaje\n";
        
        // Crea el objeto PlainTextContent y asigna el contenido
        $contenido = new PlainTextContent($contenido_texto);
        
        // Agrega el contenido al correo electrónico
        $correo->addContent($contenido);

        // Configura la clave API de SendGrid
        $sendgrid = new \SendGrid('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'); // Reemplaza 'TU_API_KEY' con tu API Key de SendGrid

        try {
            // Envía el correo electrónico utilizando SendGrid
            $response = $sendgrid->send($correo);
            echo "¡Tu solicitud ha sido enviada con éxito!";
        } catch (Exception $e) {
            echo "Hubo un error al enviar tu solicitud. Por favor, inténtalo de nuevo más tarde.";
        }
    }
} else {
    header("Location: index.html");
    exit();
}
?>


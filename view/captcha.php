<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHA Simple</title>
</head>
<body>
    <h1>Formulario con CAPTCHA</h1>
    <form id="captchaForm">
        <label for="captcha">¿Qué es 2 + 5?</label><br>
        <input type="text" id="captcha" required><br>
        <button type="submit">Enviar</button>
    </form>
    
    <p id="message"></p>

    <script>
        document.getElementById('captchaForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario

            var userAnswer = document.getElementById('captcha').value;
            var correctAnswer = 7; // Respuesta correcta a la pregunta

            if (parseInt(userAnswer) === correctAnswer) {
                document.getElementById('message').innerText = "¡Correcto! El formulario se ha enviado.";
                // Aquí puedes agregar la lógica para enviar el formulario, si es necesario.
            } else {
                document.getElementById('message').innerText = "Respuesta incorrecta. Intenta de nuevo.";
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Lácthosa</title>
    <style>
        #chat-container {
            width: 300px;
            height: 400px;
            border: 1px solid #ccc;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            flex-direction: column;
        }

        #chat-box {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        #user-input {
            display: flex;
        }

        #user-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
        }

        #user-input button {
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
        }

        #user-input button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Bienvenido a Lácthosa</h1>
<button onclick="toggleChat()">Chatbot</button>

<div id="chat-container">
    <div id="chat-box" id="chat-box"></div>
    <div id="user-input">
        <input type="text" id="user-message" placeholder="Escribe tu mensaje..." />
        <button onclick="sendMessage()">Enviar</button>
    </div>
</div>

<script>
    function toggleChat() {
        const chatContainer = document.getElementById('chat-container');
        chatContainer.style.display = chatContainer.style.display === 'none' ? 'flex' : 'none';
    }

    function sendMessage() {
        const userMessage = document.getElementById('user-message').value;
        const chatBox = document.getElementById('chat-box');

        if (userMessage) {
            chatBox.innerHTML += <div><strong>Tú:</strong> ${userMessage}</div>;
            document.getElementById('user-message').value = '';

            // Lógica sencilla para responder
            const response = getChatbotResponse(userMessage);
            chatBox.innerHTML += <div><strong>Chatbot:</strong> ${response}</div>;
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll hacia abajo
        }
    }

    function getChatbotResponse(input) {
        input = input.toLowerCase();
        if (input.includes("lácteo") || input.includes("producto")) {
            return "¿Qué tipo de lácteos estás buscando? Tenemos leche, yogur y quesos.";
        } else if (input.includes("leche")) {
            return "Ofrecemos leche entera, descremada y semidescremada.";
        } else if (input.includes("yogur")) {
            return "Contamos con yogur natural y de frutas.";
        } else if (input.includes("queso")) {
            return "Disponemos de queso fresco, panela y cheddar.";
        } else {
            return "Lo siento, no entiendo. Puedes preguntar sobre nuestros productos lácteos.";
        }
    }
</script>

</body>
</html>
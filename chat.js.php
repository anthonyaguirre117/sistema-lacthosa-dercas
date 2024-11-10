document.getElementById("chatbotOpen").onclick = function() {
    const chatbotDiv = document.getElementById("chatbot");
    chatbotDiv.style.display = (chatbotDiv.style.display === "none" || chatbotDiv.style.display === "") ? "block" : "none";
};
document.getElementById("closeButton").onclick = function() {
    const chatbotDiv = document.getElementById("chatbot");
    chatbotDiv.style.display = "none"; // Oculta el chatbot
};

function appendMessage(message) {
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML += '<div>' + message + '</div>';
    messagesDiv.scrollTop = messagesDiv.scrollHeight; // Desplazar hacia abajo
}

function showWelcomeMessage() {
    appendMessage('Chatbot: ¡Hola! Bienvenido a nuestra empresa de lácteos. ¿Cómo puedo ayudarte hoy?');
    appendMessage('Chatbot: ¿Estás buscando información sobre nuestros productos, recetas o tienes alguna otra pregunta?');
}

showWelcomeMessage();

document.getElementById('sendButton').addEventListener('click', function() {
    const message = document.getElementById('userInput').value;
    appendMessage('Usuario: ' + message);
    document.getElementById('userInput').value = ''; // Limpiar campo

    sendResponseToServer(message);

    handleUserResponse(message);
});

function handleUserResponse(message) {
    if (message.toLowerCase().includes('productos')) {
        appendMessage('Chatbot: Tenemos una variedad de productos como leche, yogur, quesos y mantequilla. ¿Te gustaría saber más sobre alguno de ellos?');
    } else if (message.toLowerCase().includes('recetas')) {
        appendMessage('Chatbot: ¡Claro! Aquí tienes una receta fácil de helado de yogurt. ¿Te gustaría que te la envíe?');
    } else if (message.toLowerCase().includes('opinión')) {
        appendMessage('Chatbot: Tu opinión es muy importante para nosotros. ¿Cómo calificarías nuestros productos en una escala del 1 al 10?');
    } else {
        appendMessage('Chatbot: Gracias por tu mensaje, por favor especifica cómo puedo ayudarte con nuestros productos lácteos.');
    }
}

function sendResponseToServer(response) {
    fetch('process_response.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ response: response })
    }).then(res => res.json())
      .then(data => console.log(data));
}
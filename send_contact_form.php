<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST["mensagem"]);

    if (empty($nome) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    $recipient = "henriqueti.adm@gmail.com";
    $subject = "Novo contato de $nome";
    $email_content = "Nome: $nome\n";
    $email_content = "Email: $email\n\n";
    $email_content .= "Mensagem:\n$mensagem\n";

    $email_headers = "From: $nome <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Obrigado! Sua mensagem foi enviada.";
    } else {
        http_response_code(500);
        echo "Ocorreu um erro ao enviar sua mensagem.";
    }
} else {
    http_response_code(403);
    echo "Acesso proibido.";
}
?>

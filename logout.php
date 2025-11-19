<?php
session_start();

// Remove dados do usuário, mas mantém o carrinho se quiser (opcional)
// Para remover tudo (login e carrinho), use session_destroy()
unset($_SESSION['user_id']);
unset($_SESSION['user_nome']);

// Redireciona para a Home
header("Location: index.php");
exit;
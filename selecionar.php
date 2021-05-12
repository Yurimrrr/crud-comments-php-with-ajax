<?php
    header('Content-Type: application/json');

    $pdo = new PDO('mysql:host=localhost; dbname=bd-comment-video;', 'root', '');

    $stmt = $pdo->prepare('SELECT * FROM comments');
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $status = 1;
        $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $status = 0;
        $msg = 'Nenhum comentario foi encontrado. ';
    }

    echo json_encode([
        'status' => $status,
        'msg' => $msg,
    ]);
<?php

    $id = filter_input(INPUT_GET,'id');

    header('Content-Type: application/json');

    $pdo = new PDO('mysql:host=localhost; dbname=bd-comment-video;', 'root', '');

    if(!(is_numeric($id))){
        $status = 0;
        $msg = 'Não foi possível excluir o comentário.';
    }else{
        $status = 1;
        $stmt = $pdo->prepare('DELETE FROM comments WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $msg = 'Comentário excluido com sucesso. ';

    }

    echo json_encode([
        'status' => $status,
        'msg' => $msg,
    ])
?>
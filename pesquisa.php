<?php
    header('Content-Type: application/json');

    $pdo = new PDO('mysql:host=localhost; dbname=bd-comment-video;', 'root', '');

    $id = filter_input(INPUT_GET, 'id');
    if(!is_numeric($id)){
        $msg = 'Id Invalido.';
        $status = 0;
    }else{
        $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = :id");
        $stmt->execute([':id'=>$id]);
        $status = 0;
        if ($stmt->rowCount() >= 1) {
            $status = 1;
            $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $msg = 'Nenhum registro encontrado.';
        }
    }

    echo json_encode([
        'status'=>$status,
        'msg'=>$msg,
    ]);



?>
<?php
    header('Content-Type: application/json');

    $id = filter_input(INPUT_POST,'id');
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if(strlen($name) <= 0 ){
        $msg = 'Usuario não colocou o nome. ';
        $status = 0;

    }else if(strlen($comment) <= 0 ){
        $msg = 'Usuario não colocou o comentario. ';
        $status = 0;
        
    }else{

        $pdo = new PDO('mysql:host=localhost; dbname=bd-comment-video;', 'root', '');

        /** 
         * Como não tem id ele cadastra novo no banco. se tiver 
         * ele vai mandar pro update, dentro do ajax 
         * não tinha o id, ai colocou pego
         * 
         * @author Yuri Moreira 
         * @version 10/05/2021
         * @return 
        */
        if(!(is_numeric($id))){
            $id = null;
            $stmt = $pdo->prepare('INSERT INTO comments (id,name, comment) VALUES (:id,:na, :co)');
        }else{
            //pesquisa do id dentro do banco e verificar se ele existe. FAZER
            $stmt = $pdo->prepare('UPDATE comments SET name = :na , 
            comment = :co WHERE id = :id');
        }

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':na', $name);
        $stmt->bindValue(':co', $comment);
        $stmt->execute();
        if ($stmt->rowCount() >= 1) {
            $status = 1;
            $msg = 'Entrada de dados sucedida. ';
        } else{
            $msg = 'Falha no envio dos dados. ';
            $status = 0;
        }
    }

    echo json_encode([
        'status'=>$status,
        'msg'=>$msg,
    ]);


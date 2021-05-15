<?php
    if(isset($_POST['id'])){
        require '../db_conn.php';

        $id = $_POST['id']; // Html kod içerisindeki yer

        if(empty($id)){
            echo 'error';
        }else{
            $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
            $todos->execute([$id]);

            $todo = $todos->fetch();
            $uID = $todo['id'];
            $checked = $todo['checked'];

            $uChecked = $checked ? 0: 1;
            
            $res = $conn ->query("UPDATE todos SET checked=$uChecked WHERE id=$uID");

            if($res){
                echo $checked;
            }else{
                echo "error";
            }


            $conn = null;
            exit();
        }

    }else{
        header("Location: ../index.php?mess=error");

    }


?>
<!DOCTYPE html>
<html>
<meta charset="utf8">
</header>

<title>Formulário Teste</title>

<header>
    
<?php

$nomeErro = $emailErro = $senhaErro = $comentarioErro = "";
$nome = $email = $senha = $comentario = "";
mb_internal_encoding("UTF-8");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty($_POST["nome"])){
        $nomeErro = "* Um nome é necessário.";
    }   elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nome"])){
            $nomeErro = "Só letras e espaços em brancos permitidos.";
        }   else if(strlen($_POST["nome"]) <= 3){
                $nomeErro = "* O nome precisa ter mais de 3 caracteres.";
            }   else{
                    $nome = testar_input($_POST["nome"]);
                }


    if(empty($_POST["email"])){
        $emailErro = "* Um email é necessário.";
    }   else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErro = "Email inválido.";
        }   else{
                $email = testar_input($_POST["email"]);
            }

    
    if(empty($_POST["senha"])){
        $senhaErro = "* Uma senha é necessária.";
    }   elseif(strlen($_POST["senha"]) <= 3 || strlen($_POST["senha"]) >= 17){
            $senhaErro = "A senha precisa ter entre 4 e 16 caracteres.";
    }   else{
            $senha = testar_input($_POST["senha"]);
    }

    $comentario = testar_input($_POST["comentario"]);
    
}

function testar_input($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}
?>

<body>

<h1>Teste de formulário</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<input type="text" placeholder="Nome" name="nome" value="<?php echo $nome ?>"> 
<span class="erro">
    <?php
    echo $nomeErro;
    ?>
 </span><br><br>
<input type="text" placeholder="Email" name="email" value="<?php echo $email?>">
<span class="erro">
    <?php
    echo $emailErro;
    ?>
</span><br><br>
<input type="text" placeholder="Senha" name="senha" value="<?php echo $senha ?>">
    <?php
    echo $senhaErro;
    ?>
</span><br><br>
<textarea  rows="5" cols="40" name="comentario" value="<?php echo $comentario?>"></textarea>
<input type="submit">
</form>
<h2>Sua saída</h2>
<?php
    echo $nome;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $senha;
    echo "<br>";
    echo $comentario;
?>

</body>

</html>
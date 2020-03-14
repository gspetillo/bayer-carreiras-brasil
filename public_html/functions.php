<?php
 
/**
 * Conecta com o MySQL usando PDO
 */
function db_connect(){
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    return $PDO;
}

/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str){
    return sha1(md5($str));
}

/**
 * Verifica se o usuário está logado
 */
function isLoggedIn(){
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        return false;
    }
    return true;
}


/**
 * Verifica se o usuário é ADM
 */
function isADM() {
    // busca os dados do usuário a ser editado
    $PDO = db_connect();
    $sql = "SELECT type FROM recruiters WHERE rec_cpf = :rec_cpf";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':rec_cpf', $_SESSION['email_rec_cpf'], PDO::PARAM_STR);
     
    $stmt->execute();
     
    $aux = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($aux['type'] != 1) {
        return false;
    }
    return true;
}


/**
 * Verifica se o usuário é Recrutador
 */
function isRec() {
    // busca os dados do usuário a ser editado
    $PDO = db_connect();
    $sql = "SELECT type FROM recruiters WHERE rec_cpf = :rec_cpf";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':rec_cpf', $_SESSION['email_rec_cpf'], PDO::PARAM_STR);
     
    $stmt->execute();
     
    $aux = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (($aux['type'] != 2)&&($aux['type'] != 1)) {
        return false;
    }
    return true;
}


/**
 * Formata a data para o formato brasileiro
 */
function fdata($data){
    return date("d/m/Y", strtotime($data));
}
?>
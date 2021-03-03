<?php
require_once('../load.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'username',
        'password',
        'password2',
        'recovery_question',
        'recovery_answer'
    ));
    
    if($d['password'] != $d['password2'])
        errResponse('passwords not match');

    if(!is_password_valid($d['password']))
        errResponse('Password not valid.');

    $sql = 'SELECT `id` FROM user WHERE username="'.$d['username'].'"';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0)
        errResponse("username already has taken");
    
    $hashed_password = md5($d['password']);
    $sql = 'INSERT INTO user (`username`, `email`, `password`, `recovery_question`, `recovery_answer`)
                VALUES("'.$d['username'].'", "'.$d['email'].'", "'.$hashed_password.'", "'.$d['recovery_question'].'", "'.$d['recovery_answer'].'")
    ';
    $res = mysqli_query($conn, $sql);
    
    $sql = 'SELECT `id`, `username`, `email` FROM user WHERE username="'.$d['username'].'" LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        response($user);
    }
    errResponse("Can not create user.");

    // response($res);

}
?>
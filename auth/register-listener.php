<?php
require_once('../load.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'user_id',
        'first_name',
        'last_name',
        'nationality',
        'birthday_year'
    ));
    
    $sql = 'INSERT INTO listener (`user_id`, `first_name`, `last_name`, `nationality`, `birthday_year`)
                VALUES("'.$d['user_id'].'", "'.$d['first_name'].'", "'.$d['last_name'].'", "'.$d['nationality'].'", "'.$d['birthday_year'].'")
    ';
    $res = mysqli_query($conn, $sql);
    
    $sql = 'SELECT id, first_name, last_name, birthday_year, nationality, username, email  FROM `listener` INNER JOIN `user` ON listener.user_id=user.id WHERE listener.user_id='.$d['user_id'].' LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        response($user);
    }
    errResponse("Can not create listener.");

    // response($res);

}
?>
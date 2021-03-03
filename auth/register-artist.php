<?php
require_once('../load.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'user_id',
        'name',
        'nationality',
        'begin_year',
    ));
    
    $sql = 'INSERT INTO artist (`user_id`, `name`, `nationality`, `begin_year`)
                VALUES("'.$d['user_id'].'", "'.$d['name'].'", "'.$d['nationality'].'", "'.$d['begin_year'].'")
    ';
    $res = mysqli_query($conn, $sql);
    
    $sql = 'SELECT id, name, begin_year, nationality, username, email  FROM `artist` INNER JOIN `user` ON artist.user_id=user.id WHERE artist.user_id='.$d['user_id'].' LIMIT 1';
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        response($user);
    }
    errResponse("Can not create artist.");

    // response($res);

}
?>
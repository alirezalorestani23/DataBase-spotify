<?php
require_once('../../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $d = get_posted_data(array(
        'music_id'
    ));

    $user = get_user();

    $today = date("Y-m-d");

    $sql = 'SELECT COUNT(*) as num FROM music_play WHERE listener_id = "'.$user['id'].'" AND datetime LIKE "'.$today.'"' ;

    $res = mysqli_query($conn,$sql);
    $row_num = mysqli_fetch_assoc($res);
    $count = $row_num['num'];

    if ($count<5) {
        $sql = 'INSERT INTO music_play (listener_id, music_id, datetime) VALUES("'.$user['id'].'", "'.$d['music_id'].'", "'.$today.'")';
        $res = mysqli_query($conn, $sql);
        response(array(
          'id' => $d['music_id']
        ));
    }
    else {
        errResponse("you have reached the maximum number of plays in a day");
    }
}
?>

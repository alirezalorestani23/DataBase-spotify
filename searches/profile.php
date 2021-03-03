<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['user_id'])) {
      $user_id = $_GET['user_id'];

      $sql = 'SELECT * FROM user WHERE id = '.$user_id.' LIMIT 1';
      $res = mysqli_query($conn,$sql);
      $user = mysqli_fetch_assoc($res);


      $follower_num = mysqli_num_rows(get_followers($user_id));
      $following_num = mysqli_num_rows(get_followings($user_id));

      global $playlists;
      $tbl_playlists = get_playlist_by_id($user_id);
      for ($i=0; $i < mysqli_num_rows($tbl_playlists) ; $i++) {
        $playlist = mysqli_fetch_assoc($tbl_playlists);
        $sql = 'SELECT MAX(id) as id FROM playlist_music WHERE playlist_id='.$playlist['id'].' LIMIT 1';
        $res = mysqli_query($conn,$sql);
        $last_id = mysqli_fetch_assoc($res)['id'];
        $sql = 'SELECT date FROM playlist_music WHERE id = '.$last_id.'';
        $res = mysqli_query($conn,$sql);
        $last_update = mysqli_fetch_assoc($res);

        $playlists[$i] = array(
          "name"=>$playlist['name'],
          "music_number"=>mysqli_num_rows(get_musics_of_playlist($playlist['id'])),
          "last_update"=>$last_update
        );

      }

      global $listener;
      if (is_listener_by_id($user_id)) {
        $listener = get_listener_by_id($user_id);
        response(array(
          "username"=>$user['username'],
          "name"=>$listener['first_name'],
          "followers"=>$follower_num,
          "following"=>$following_num,
          "playlists"=>$playlists
        ));
      }

      global $artist;
      if (is_artist_by_id($user_id)) {
        $artist = get_artist_by_id($user_id);
        response(array(
          "username"=>$user['username'],
          "artistic_name"=>$artist['name'],
          "followers"=>$follower_num,
          "following"=>$following_num,
          "playlists"=>$playlists
        ));
      }







      response(array(
        "username"=>$user['username'],
        "name"=>$listener['first_name'],
        "artistic_name"=>$artist['name'],
        "followers"=>$follower_num,
        "following"=>$following_num,
        "playlists"=>$playlists
      ));

    }

    $user = get_user();
    $today = date("Y-m-d");

}
?>

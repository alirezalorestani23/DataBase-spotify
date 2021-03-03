<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['search'])) {
      $to_search = $_GET['search'];
      $index=0;
      $sql = 'SELECT * FROM user WHERE username LIKE "%'.$to_search.'%"';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      global $users;
      for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
        $user = mysqli_fetch_assoc($res);
        $users[$i] = array(
          "username" => $user['username'],
          "user_id" => $user['id']
        );

      }
      echo $users[0];


      $sql = 'SELECT * FROM album WHERE name LIKE "%'.$to_search.'%"';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      global $albums;
      for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
        $album = mysqli_fetch_assoc($res);
        $albums[$i] = array(
          "name" => $album['name'],
          "album_id" => $album['id'],
          "artist_name" => get_user_by_id($album['artist_id'])['username']
        );
        // print_r($albums[$i]);

      }


      $sql = 'SELECT * FROM music WHERE name LIKE "%'.$to_search.'%"';
      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      global $musics;

      for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
        $music = mysqli_fetch_assoc($res);
        $artist_id = get_album_by_id($music['album_id'])['artist_id'];
        $musics[$i] = array(
          "name" => $music['name'],
          "music_id" => $music['id'],
          "artist_name" => get_user_by_id($artist_id)['username']
        );
        // print_r($musics[$i]);
      }



        $sql = 'SELECT * FROM playlist WHERE name LIKE "%'.$to_search.'%"';
        $res = mysqli_query($conn,$sql);
        if (mysqli_errno($conn)>0) {
          errResponse(mysqli_error($conn));
        }
        global $playlists;

        for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
          $playlist = mysqli_fetch_assoc($res);
          $playlists[$i] = array(
            "name" => $playlist['name'],
            "playlist_id" => $playlist['id']
          );
          // print_r($playlists[$i]);
        }

        $final_result = array(
          "users" => $users,
          "musics" => $musics,
          "albums" => $albums,
          "playlists" => $playlists
        );
        response($final_result);




    }

    $user = get_user();
    $today = date("Y-m-d");

}
?>

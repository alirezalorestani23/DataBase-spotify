<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['source_type'])) {
      if (isset($_GET['source_id'])) {

        $source_id = $_GET['source_id'];
        $source_type = $_GET['source_type'];

        if ($source_type === 'playlist') {
          $playlist = get_musics_of_playlist($source_id);
          for ($i=0; $i < mysqli_num_rows($playlist) ; $i++) {
            $music_in_playlist = mysqli_fetch_assoc($playlist);
            $music = mysqli_fetch_assoc(get_music_by_id($music_in_playlist['music_id']));
            $response[$i] = array(
              'id'=>$music_in_playlist['music_id'],
              "name"=>$music['name'],
              "playlist_id"=>$source_id,
              "duration"=>$music['duration'],
              "add_date"=>$music_in_playlist['date']

            );
          }
          response($response);
        }
        elseif($source_type === 'album'){
          $album = get_musics_of_album($source_id);
          // global $response;
          for ($i=0; $i < mysqli_num_rows($album) ; $i++) {
            $response[$i] = mysqli_fetch_assoc($album);
          }
          response($response);
        }
        else {
          errResponse('invalid source!');
        }

      }
      else {
        errResponse('more data is required!');
      }



      $user = get_user();
      $today = date("Y-m-d");

    }

}
?>

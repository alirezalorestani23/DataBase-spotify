
<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['playlist_id'])) {
    $playlist_id = $_GET['playlist_id'];

    $sql ='SELECT music.id as music_id, music.name as music_name, genre
    FROM music
    JOIN album
    ON music.album_id=album.id
    WHERE album.genre=(SELECT album.genre
      FROM `playlist_music`
      JOIN music
      ON playlist_music.music_id=music.id
      JOIN album
      ON music.album_id=album.id
      WHERE `playlist_music`.`playlist_id`='.$playlist_id.'
      GROUP BY album.genre
      ORDER BY COUNT(playlist_music.id) DESC
      LIMIT 1)
      AND music.id NOT IN (
        SELECT music_id as id
        FROM playlist_music
        WHERE playlist_music.playlist_id=14
      )
      ORDER BY RAND()
      LIMIT 2';

      $res = mysqli_query($conn,$sql);
      if (mysqli_errno($conn)>0) {
        errResponse(mysqli_error($conn));
      }
      global $response;
      for ($i=0; $i <mysqli_num_rows($res) ; $i++) {
        $music = mysqli_fetch_assoc($res);
        $response[$i] = array(
          'music_id'=>$music['music_id'],
          'music_name'=>$music['music_name'],
          'genre'=>$music['genre']
        );
      }
      response($response);

  }
  else {
    errResponse('Enter playlist_id!');
  }
}
?>

<?php
require_once('../load.php');
is_user();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user = get_user();
    $today = date("Y-m-d");

//newest music in fav genre
    $sql = ' SELECT music.id as music_id, music.name as music_name, album.publish_datetime, genre
    FROM music
    JOIN album
    	ON music.album_id=album.id
    WHERE album.genre = (SELECT album.genre
        FROM album
            JOIN music ON album.id=music.album_id
            JOIN music_play ON music.id=music_play.music_id
        WHERE music_play.listener_id='.$user['id'].'
        GROUP BY album.genre
        ORDER BY COUNT(music_play.id) DESC
        LIMIT 1)
    AND album.publish_datetime > DATE_SUB(NOW(), INTERVAL 7 DAY)
    ORDER BY album.publish_datetime DESC
    LIMIT 5';
    $res = mysqli_query($conn,$sql);
    $newest_row_num = mysqli_num_rows($res);
    global $newset_list;
    for ($i=0; $i <$newest_row_num ; $i++) {
      $music = mysqli_fetch_assoc($res);
      $newset_list[$i] = array(
        'music_id' => $music['music_id'],
        'music_name' => $music['music_name'],
        'genre' => $music['genre']
      );
    }

//most popular music in fav genre
      $sql = 'SELECT music.name as music_name, music.id as music_id, album.genre as genre, COUNT(music_like.id)+COUNT(music_play.id) as rate
              FROM music
              JOIN album
              	ON music.album_id=album.id
              LEFT JOIN music_like
              	ON music.id = music_like.music_id
              LEFT JOIN music_play
              	ON music.id = music_play.music_id
              WHERE album.genre = (SELECT album.genre
                  FROM album
                      JOIN music ON album.id=music.album_id
                      JOIN music_play ON music.id=music_play.music_id
                  WHERE music_play.listener_id='.$user['id'].'
                  GROUP BY album.genre
                  ORDER BY COUNT(music_play.id) DESC
                  LIMIT 1)
              GROUP BY music.name
              ORDER BY rate DESC
              LIMIT 5';
        $res = mysqli_query($conn,$sql);
        $popular_row_num = mysqli_num_rows($res);
        global $popular_list;
        for ($i=0; $i <$popular_row_num ; $i++) {
          $music = mysqli_fetch_assoc($res);
          $popular_list[$i] = array(
            'music_id' => $music['music_id'],
            'music_name' => $music['music_name'],
            'genre' => $music['genre'],
            'rate' =>$music['rate']
          );
        }

        response(array(
          'newest_musics'=>$newset_list,
          'most_popular_musics' => $popular_list
        ));
}
?>

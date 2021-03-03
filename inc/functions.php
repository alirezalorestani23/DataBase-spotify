<?php
// print_r($conn);
function errResponse($message, $status_code=406){
    http_response_code($status_code);
    die(json_encode(array(
        'message' => $message,
        'status_code' => $status_code
    )));
}
function response($data){
    die(json_encode($data));
}

function get_posted_data($reqs){
    $data = json_decode(file_get_contents('php://input'), true);
    if(!$data){
      errResponse("Data required");
    }
    $keys = array_keys($data);
    foreach($reqs as $req){
        if(!in_array($req, $keys)){
            errResponse("Field ".$req." is required.");
        }
    }

    return $data;
}
function is_password_valid($pass){
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $number    = preg_match('@[0-9]@', $pass);

    if(!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
        return FALSE;
    }
    return TRUE;
}
function is_user(){
  if(!isset($_SESSION['user_id'])){
    errResponse("Not authenticated", 403);
  }
}
function is_admin(){
  global $conn;
  $id = $_SESSION['user_id'];
  $sql = 'SELECT user_id FROM admin WHERE user_id = "'.$id.'" LIMIT 1 ';
  $res = mysqli_query($conn, $sql);
  return (mysqli_num_rows($res)>0);
}
function get_admin(){
  global $conn;
  $id = $_SESSION['user_id'];
  $sql = 'SELECT * FROM admin WHERE user_id = "'.$id.'" LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;
}

function is_artist(){
  global $conn;
  $id = $_SESSION['user_id'];
  $sql = 'SELECT user_id FROM artist WHERE user_id = "'.$id.'" LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  return (mysqli_num_rows($res)>0);
}
function is_verified(){
  global $conn;
  if (is_artist()) {
    $artist = get_artist();
    return $artist['is_active'];
  }
  else {
    errResponse('there is no such artist!');
  }
}

function get_artist(){
  global $conn;
  $id = $_SESSION['user_id'];
  $sql = 'SELECT * FROM artist WHERE user_id = "'.$id.'" LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;
}


function is_listener(){
  global $conn;
  $id = $_SESSION['user_id'];
  $sql = 'SELECT user_id FROM listener WHERE user_id = "'.$id.'" LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  return (mysqli_num_rows($res)>0);
}
function is_listener_by_id($id){
  global $conn;
  $sql = 'SELECT user_id FROM listener WHERE user_id = '.$id.' LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  return (mysqli_num_rows($res)>0);
}
function is_artist_by_id($id){
  global $conn;
  $sql = 'SELECT user_id FROM artist WHERE user_id = '.$id.' LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  return (mysqli_num_rows($res)>0);
}
function get_listener(){
  global $conn;
  $id = $_SESSION['user_id'];
  $sql = 'SELECT * FROM listener WHERE user_id = '.$id.' LIMIT 1 ';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;
}
function is_premium(){
  global $conn;
  if (is_listener()) {
    $listener = get_listener();
    $listener_id = $listener['user_id'];
    $sql = 'SELECT * FROM premium_account WHERE listener_id = '.$listener_id.' LIMIT 1 ';
    $res = mysqli_query($conn,$sql);
    return (mysqli_num_rows($res)>0);
  }
  return false;
}
function get_user_by_id($user_id){
  global $conn;
  $sql = 'SELECT * FROM user WHERE id = '.$user_id.' LIMIT 1';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;
}
function get_listener_by_id($user_id){
  global $conn;
  $sql = 'SELECT * FROM listener WHERE user_id = '.$user_id.' LIMIT 1';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;
}

function get_artist_by_id($user_id){
  global $conn;
  $sql = 'SELECT * FROM artist WHERE user_id = '.$user_id.' LIMIT 1';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;

}

function get_album_by_id($album_id){
  global $conn;
  $sql = 'SELECT * FROM album WHERE id ='.$album_id.' LIMIT 1';
  $res = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($res);
  return $data;
}
function get_playlist_by_id($playlist_id){
  global $conn;
  $sql = 'SELECT * FROM playlist WHERE author_id ='.$playlist_id.'';
  $res = mysqli_query($conn,$sql);
  return $res;
}


function get_user(){
  global $conn;
  if(!isset($_SESSION['user_id'])) return null;
  $user_id = $_SESSION['user_id'];
  $sql = 'SELECT * FROM `user` WHERE `id`="'.$user_id.'"';
  $conn = db_conn();
  $res = mysqli_query($conn, $sql);
  if(mysqli_num_rows($res) > 0){
    $data = mysqli_fetch_assoc($res);
    return $data;
  }
}
function get_followers($user_id){
  global $conn;
  $sql = 'SELECT * FROM user_follow WHERE followee_id ='.$user_id.'';
  $res = mysqli_query($conn,$sql);
  return $res;
}

function get_followings($user_id){
  global $conn;
  $sql = 'SELECT * FROM user_follow WHERE follower_id ='.$user_id.'';
  $res = mysqli_query($conn,$sql);
  return $res;
}
function get_music_by_id($music_id){
  global $conn;
  $sql = 'SELECT * FROM music WHERE id ='.$music_id.' ';
  $res = mysqli_query($conn,$sql);
  return $res;
}
function get_musics_of_playlist($playlist_id){
  global $conn;
  $sql ='SELECT * FROM playlist_music WHERE playlist_id = '.$playlist_id.'';
  $res = mysqli_query($conn,$sql);
  return $res;
}
function get_musics_of_album($album_id){
  global $conn;
  $sql ='SELECT * FROM music WHERE album_id = '.$album_id.'';
  $res = mysqli_query($conn,$sql);
  return $res;
}
function find_genre_artist($artist_id){
  global $conn;
  $sql = 'SELECT genre FROM album WHERE artist_id='.$artist_id.' GROUP BY genre ORDER BY COUNT(id) DESC LIMIT 1';
  $res = mysqli_query($conn,$sql);
  return $res;
}
function get_week_popular(){
  global $conn;
  $sql = 'SELECT music.id as music_id ,music.name as music_name, COUNT(music.id) as rate FROM `music` LEFT JOIN `music_play` ON music.id=music_play.music_id LEFT JOIN `music_like` ON music.id=music_like.music_id WHERE `music_like`.`datetime` > DATE_SUB(NOW(), INTERVAL 7 DAY) OR `music_play`.`datetime` > DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY music.name ORDER BY COUNT(music.id) DESC LIMIT 5 ';
  $res = mysqli_query($conn,$sql);
  return $res;
}

//get 5 popular music in past week




// newest musics in fav genre
// SELECT music.id, music.name, album.publish_datetime, album.genre
// FROM music
// JOIN album
// 	ON music.album_id=album.id
// WHERE album.genre = (SELECT album.genre
//     FROM album
//         JOIN music ON album.id=music.album_id
//         JOIN music_play ON music.id=music_play.music_id
//     WHERE music_play.listener_id=5
//     GROUP BY album.genre
//     ORDER BY COUNT(music_play.id) DESC
//     LIMIT 1)
// AND album.publish_datetime > DATE_SUB(NOW(), INTERVAL 7 DAY)
// ORDER BY album.publish_datetime DESC
// LIMIT 5



// most popular musics in fav genre
// SELECT music.name, COUNT(music_like.id)+COUNT(music_play.id) as rate
// FROM music
// JOIN album
// 	ON music.album_id=album.id
// LEFT JOIN music_like
// 	ON music.id = music_like.music_id
// LEFT JOIN music_play
// 	ON music.id = music_play.music_id
// WHERE album.genre = (SELECT album.genre
//     FROM album
//         JOIN music ON album.id=music.album_id
//         JOIN music_play ON music.id=music_play.music_id
//     WHERE music_play.listener_id=5
//     GROUP BY album.genre
//     ORDER BY COUNT(music_play.id) DESC
//     LIMIT 1)
// GROUP BY music.name
// ORDER BY rate DESC
// LIMIT 5


// offer 2 other songs from same genre of playlist
// SELECT *
// FROM music
// JOIN album
// 	ON music.album_id=album.id
// WHERE album.genre=(SELECT album.genre
//     FROM `playlist_music`
//     JOIN music
//         ON playlist_music.music_id=music.id
//     JOIN album
//         ON music.album_id=album.id
//     WHERE `playlist_music`.`playlist_id`=14
//     GROUP BY album.genre
//     ORDER BY COUNT(playlist_music.id) DESC
//     LIMIT 1)
// AND music.id NOT IN (
// 	SELECT music_id as id
//     FROM playlist_music
//     WHERE playlist_music.playlist_id=14
// )
// ORDER BY RAND()
// LIMIT 2




// best listeners of artist
// SELECT CONCAT(listener.first_name," ", listener.last_name) as listener,  COUNT(music_play.id) as rate
// FROM listener
// INNER JOIN music_play
// 	ON listener.user_id=music_play.listener_id
// JOIN music
// 	ON music_play.music_id=music.id
// JOIN album
// 	ON music.album_id=album.id
// JOIN artist
// 	ON album.artist_id=artist.user_id
// WHERE artist.user_id = 4
// GROUP BY listener.user_id
// 	HAVING COUNT(music_play.id) > 10
?>

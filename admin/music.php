<?php
require_once('../load.php');
if (!is_admin()) {
  errResponse('permission denied!',403);
}

if (isset($_GET['id']) ) {
  $id = $_GET['id'];
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE' ) {
    $sql = 'DELETE FROM music WHERE id = '.$id.' ';
    $res = mysqli_query($conn,$sql);
    if (mysqli_errno($conn)>0) {
      errResponse(mysqli_error($conn));
    }
    response(array(
      'message'=>'music deleted successfully'
    ));

  }elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

  }
}else{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //create music
    $d = get_posted_data(array(
      'name',
      'album_id',
      'duration'
    ));
    $sql ='INSERT INTO music (`name`,`album_id`, `duration`) VALUES("'.$d['name'].'","'.$d['album_id'].'",'.$d['duration'].')';
    $res = mysqli_query($conn,$sql);
    if (mysqli_errno($conn)>0) {
      errResponse(mysqli_error($conn));
    }
    response(array(
      'message' => 'music created!'
    ));

  } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

  }


}

?>

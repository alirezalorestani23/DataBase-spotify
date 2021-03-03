  <?php
  require_once('../../load.php');
  is_user();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $d = get_posted_data(array(
          'music_id',
          'description'

      ));

    $user = get_user();

        $sql = 'INSERT INTO music_report (`music_id`,`listener_id`,`description`) VALUES("'.$d['music_id'].'","'.$user['id'].'","'.$d['description'].'")';
        $res = mysqli_query($conn,$sql);
        if (mysqli_errno($conn)>0) {
          errResponse(mysqli_error($conn));
        }
        response(array(
          'message' => 'music reproted successfully!',
          'music_id'=>$d['music_id']
        ));



    }
   ?>

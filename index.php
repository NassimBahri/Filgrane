<?php
include 'Filgrane.php';
$img='image.png';
$new='nouvelle.png';
$legend=new Filgrane($img,'ma signature',$new);
?>
<img src="<?php echo $new; ?>" />
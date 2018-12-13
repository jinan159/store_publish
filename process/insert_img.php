<?php session_start();

$store_img_folder = "img/menu_img/".$_SESSION['s_store_id'];
if(!is_dir($store_img_folder)) {
    mkdir($store_img_folder);
}
$target_dir = $store_img_folder."/";
$target_file = $target_dir . basename($_FILES["depfile"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file_path = $target_dir . time().".".$imageFileType;
$uploadOk = 1;


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["depfile"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "파일이 이미지가 아닙니다.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file_path)) {
    echo "<script>alert('파일이름이 중복 됩니다. 이름을 바꿔주세요.');";
    echo "location.replace('../index.php');</script>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["depfile"]["size"] > 2000000) {
    echo "<script>alert('파일의 크기가 너무 큽니다.');";
    echo "location.replace('../index.php');</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>alert('죄송합니다. JPG, JPEG, PNG & GIF 파일만 허용됩니다.');";
    echo "</script>";
    // location.replace('../index.php');
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('파일을 업로드 할수없습니다.');";
    echo "</script>";
    // location.replace('../index.php');
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["depfile"]["tmp_name"], $target_file_path)) {
        /*$id = date("ymd") . "_". $_SESSION['ss_mtcode'] . "_" . time();
        $dest = '../file/dep_img/' . $id;*/

        echo "<script>console.log('파일 업로드 성공');</script>";

    } else {
        echo "<script>alert('파일을 업로드하는데 문제가 발생했습니다.');";
        echo "location.replace('../index.php');</script>";
    }
}
?>
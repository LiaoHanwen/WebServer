<?php
class Emp {
    public $success = "";
    public $message  = "";
    public $url = "";
}
$e = new Emp();

$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        $e->success="0";
        $e->message=$_FILES["file"]["error"];
    }
    else
    {       
        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("../image_upload/" . $_FILES["file"]["name"]))
        {
            $e->success="0";
            $e->message="file has existed";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "../image_upload/" . $_FILES["file"]["name"]);
            $e->success="1";
            $e->message="success";
            $e->url="localhost/image_upload/".$_FILES["file"]["name"];
        }
    }
}
else
{
    $e->success="0";
    $e->message="illegal file type";
}

echo json_encode($e);
?>
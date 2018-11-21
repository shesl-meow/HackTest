<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018/11/21
 * Time: 10:02
 */

  if ($_FILES["file-upload"]["error"] > 0)
  {
    echo "错误：: " . $_FILES["file-upload"]["error"] . "<br>";
  }
  else
  {
    echo "上传文件名: " . $_FILES["file-upload"]["name"] . "<br>";
    echo "文件类型: " . $_FILES["file-upload"]["type"] . "<br>";
    echo "文件大小: " . ($_FILES["file-upload"]["size"] / 1024) . " kB<br>";
    echo "文件临时存储的位置: " . $_FILES["file-upload"]["tmp_name"] . "<br>";

    // 判断当期目录下的 upload 目录是否存在该文件
    // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
    if (file_exists("upload/" . $_FILES["file-upload"]["name"]))
    {
      echo $_FILES["file-upload"]["name"] . " 文件已经存在。 ";
    }
    else
    {
      // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
      move_uploaded_file($_FILES["file-upload"]["tmp_name"], "../upload/" . $_FILES["file-upload"]["name"]);
      echo "文件存储在: " . "upload/" . $_FILES["file-upload"]["name"];
    }
  }
?>
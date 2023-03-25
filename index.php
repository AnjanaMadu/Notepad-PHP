<?php

include 'database.php';

if (isset($_POST['content'])) {
  $content = $_POST['content'];
  if (strlen($content) == 0) {
    header("Location: index.php");
    exit();
  }
  $name = saveFile($content);
  header("Location: index.php?key=$name");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notepad</title>
</head>
<style>
  body {
    background-color: #1f2d3d;
    color: #d3d3d3;
    font-family: Arial, sans-serif;
    margin: 0;
  }

  textarea {
    width: 100%;
    height: 100%;
    border: none;
    outline: none;
    background-color: #1f2d3d;
    color: #d3d3d3;
    font-size: 16px;
    padding: 20px;
    margin-top: 50px;
    box-sizing: border-box;
  }

  .title {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
    position: absolute;
    top: 20px;
    left: 20px;
  }

  .button-wrapper {
    position: absolute;
    top: 20px;
    right: 20px;
    text-align: right;
  }

  .button {
    background-color: #1f2d3d;
    color: #d3d3d3;
    border: 1px solid #d3d3d3;
    border-radius: 5px;
    padding: 8px 16px;
    font-size: 16px;
    cursor: pointer;
    margin-left: 10px;
  }
</style>

<body>
  <div class="title">Notepad</div>
  <form action="index.php" method="POST">
    <div class="button-wrapper">
      <?php 
      if (isset($_GET['key'])) {
        echo '<button type="button" class="button" onclick="window.location.href=\'index.php\'">New</button>';
        echo '<button type="button" class="button" onclick="copyLink()">Copy Link</button>';
      } else {
        echo '<button type="button" class="button" onclick="resetTextArea()">New</button>';
        echo '<button type="submit" class="button">Save</button>';
      }
      ?>
    </div>
    <?php
      if (isset($_GET['key'])) {
        $key = $_GET['key'];
        $content = loadKey($key);
        echo "<textarea readonly>$content</textarea>";
      } else {
        echo "<textarea id='content' name='content' autofocus></textarea>";
      }
    ?>
  </form>
</body>

<script>
  function resetTextArea() {
    document.getElementById("content").value = "";
  }

  function copyLink() {
    const link = window.location.href;
    navigator.clipboard.writeText(link).then(() => {
      alert("Link copied to clipboard");
    }, () => {
      alert("Failed to copy link to clipboard");
    });
  }
</script>

</html>
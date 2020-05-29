<?php 
include('./config/config.php');
session_start();

if (isset($_POST['addTask'])) {
  add_task();
} elseif (isset($_POST['editTask'])) {
  edit_task();
} elseif (isset($_POST['deleteTask'])) {
  delete_task();
}


function add_task()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/config.php');
    session_start();
    $idList = mysqli_real_escape_string($db, $_POST['super_id_list']);
    $new_task_title = mysqli_real_escape_string($db, $_POST['newTaskTitle']);
    $new_task_description = mysqli_real_escape_string($db, $_POST['newTaskDescription']);
    $task_date = date('Y-m-d');
    $task_status = 0;
    
    $sql = 'INSERT INTO Tasks VALUES (idTasks, "'.$new_task_title.'", "'.$new_task_description.'", "'.$task_date.'", '.$task_status.', '.$idList.')';
    if ($result = mysqli_query($db, $sql)) {
      header("Location: ../homepage.php");
    } else {
      die(mysqli_error());
    }
  }
}

function edit_task()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/config.php');
    $idTask = mysqli_real_escape_string($db, $_POST['super_id_task']);
    $task_title = mysqli_real_escape_string($db, $_POST['editTaskTitle'.$idTask]);
    $task_description = mysqli_real_escape_string($db, $_POST['editTaskDescription'.$idTask]);
    $task_status = mysqli_real_escape_string($db, $_POST['editTaskStatus'.$idTask]);

    if (!$task_status) {
      $status = 0;
    } else {
      $status = 1;
    }

    $sql = 'UPDATE Tasks SET Title = "'.$task_title.'", Description = "'.$task_description.'", Status = '.$status.' WHERE idTasks = '.$idTask;
    if ($result = mysqli_query($db, $sql)) {
      header("Location: ../homepage.php");
    } else {
      die(mysqli_error());
    }
  }
}

function delete_task()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/config.php');
    session_start();
    $id_task = mysqli_real_escape_string($db, $_POST['super_id_task']);

    $sql = 'DELETE FROM Tasks WHERE idTasks = '.$id_task;
    if ($result = mysqli_query($db, $sql)) {
      header("Location: ../homepage.php");
    } else {
      die(mysqli_error());
    }
  }
}

?>
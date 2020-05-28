<?php 
// include('../config/config.php');
session_start();

function show_lists()
{
  include('./config/config.php');
  // TODO: Actualizar fk_idUser por el del login
  $sql = "SELECT idLists, Title FROM Lists WHERE fk_idUsers = 1";
  if ($result = mysqli_query($db, $sql)) {
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      $only_the_first = 0;
      while ($list_row = mysqli_fetch_row($result)) {
        if ($only_the_first == 0) {
          echo '<a role="tab" data-toggle="tab" href="#list'.$list_row[0]
            .'" class="list-group-item list-group-item-action active">'.$list_row[1].'</a>';
          $only_the_first++;
        } else {
          echo '<a role="tab" data-toggle="tab" href="#list'.$list_row[0]
            .'" class="list-group-item list-group-item-action">'.$list_row[1].'</a>';
        }
      }
    } else {
      echo '<a href="#" class="list-group-item list-group-item-action disabled">Nothing to do...</a>';
    }
  }
}

function show_list_tasks()
{
  include('./config/config.php');
  // TODO: Actualizar fk_idUser por el del login
  $sql = "SELECT idLists, Title FROM Lists WHERE fk_idUsers = 1";
  if ($result = mysqli_query($db, $sql)) {
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      $only_the_first_list = 0;
      while ($list_row = mysqli_fetch_row($result)) {
        if ($only_the_first_list == 0) {
          echo '<div class="tab-pane fade show active" id="list'.$list_row[0].'" role="tabpanel">';
          $only_the_first_list++;
        } else {
          echo '<div class="tab-pane fade" id="list'.$list_row[0].'" role="tabpanel">';
        }
        echo '<span>'.$list_row[1].'</span><br>';
        echo '<button class="btn btn-success">Add task</button>';
        echo '<button class="btn btn-danger">Delete list</button>';
        echo '<div class="nav nav-tabs">';
        show_tasks($list_row[0]);
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<a href="#" class="list-group-item list-group-item-action disabled">Nothing to do...</a>';
    }
  }
}

function show_tasks($id_list)
{
  include('./config/config.php');
  $sql = "SELECT idTasks, Title FROM equipo5.Tasks WHERE fk_idLists = ".$id_list;
  if ($result = mysqli_query($db, $sql)) {
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      $only_the_first_task = 0;
      while ($task_row = mysqli_fetch_row($result)) {
        if ($only_the_first_task == 0) {
          echo '<a role="tab" data-toggle="tab" href="#list'.$id_list.'task'.$task_row[0].'"
          class="list-group-item list-group-item-action active">'.$task_row[1].'</a>';
          $only_the_first_task++;
        } else {
          echo '<a role="tab" data-toggle="tab" href="#list'.$id_list.'task'.$task_row[0].'"
          class="list-group-item list-group-item-action">'.$task_row[1].'</a>';
        }
      }
    } else {
      echo '<a href="#" class="list-group-item list-group-item-action disabled">Nothing to do...</a>';
    }
  }
}

function show_single_task()
{
  include('./config/config.php');
  // TODO: Actualizar fk_idUser por el del login
  $sql = "SELECT l.idLists, l.Title, t.idTasks, t.Title, t.Description, t.CreationDate, t.Status FROM Lists l 
          INNER JOIN Tasks t ON l.idLists = t.fk_idLists AND l.fk_idUsers = 1";
  if ($result = mysqli_query($db, $sql)) {
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      $only_the_first_task = 0;
      while ($task_row = mysqli_fetch_row($result)) {
        if ($only_the_first_task == 0) {
          echo '<div class="tab-pane fade show active" id="list'.$task_row[0].'task'.$task_row[2].'" role="tabpanel">';
          $only_the_first_task++;
        } else {
          echo '<div class="tab-pane fade" id="list'.$task_row[0].'task'.$task_row[2].'" role="tabpanel">';
        }
        echo '<div class="card" style="width: 18rem;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'.$task_row[3].'</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">'.$task_row[1].'</h6>';
        echo '<p class="card-text">'.$task_row[4].'</p>';
        echo '<p class="card-text">Date: '.$task_row[5].'</p>';
        if ($task_row[6] == 1) {
          echo '<span>COMPLETED!</span>';
        } else {
          echo '<span>PENDING</span>';
        }
        echo '<hr>';
        echo '<a href="#" class="card-link">Edit task</a>';
        echo '<a href="#" class="card-link">Delete task</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<a href="#" class="list-group-item list-group-item-action disabled">Nothing to do...</a>';
    }
  }
}
?>
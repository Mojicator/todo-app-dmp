<?php 
include('./config/config.php');
session_start();

if (isset($_POST['addList'])) {
  add_list();
} elseif (isset($_POST['editList'])) {
  edit_list();
} elseif (isset($_POST['deleteList'])) {
  delete_list();
}

function show_lists()
{
  include('./config/config.php');
  session_start();
  $idUser = $_SESSION['user_id'];
  $sql = "SELECT idLists, Title FROM Lists WHERE fk_idUsers = ".$idUser;
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
  session_start();
  $idUser = $_SESSION['user_id'];
  $sql = "SELECT idLists, Title FROM Lists WHERE fk_idUsers = ".$idUser;
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
        echo '<div class="d-flex justify-content-between mb-2">'.
          '<h6>'.$list_row[1].'</h6>'
          .'<div class="btn-group" role="group" aria-label="Task Controls">'
            .'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTaskForm'.$list_row[0].'">Add</button>'
            .'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editListForm'.$list_row[0].'">Edit</button>'
            .'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteListForm'.$list_row[0].'">Del</button>'
          .'</div>'
        .'</div>';
        echo add_task_form_modal($list_row[0]);
        echo edit_list_form_modal($list_row[0], $list_row[1]);
        echo delete_list_form_modal($list_row[0]);
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
  session_start();
  $idUser = $_SESSION['user_id'];
  $sql = "SELECT l.idLists, l.Title, t.idTasks, t.Title, t.Description, t.CreationDate, t.Status FROM Lists l 
          INNER JOIN Tasks t ON l.idLists = t.fk_idLists AND l.fk_idUsers = ".$idUser;
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
        echo '<p class="card-text">Added on '.$task_row[5].'</p>';
        if ($task_row[6] == 1) {
          echo '<span>Status: COMPLETED!</span>';
        } else {
          echo '<span>Status: PENDING</span>';
        }
        echo '<hr>';
        echo '<div class="d-flex justify-content-around">';
        echo '<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editTaskForm'.$task_row[2].'">Edit task</button>';
        echo '<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteTaskForm'.$task_row[2].'">Delete task</button>';
        echo '</div>';
        echo edit_task_form_modal($task_row[2], $task_row[3], $task_row[4], $task_row[6]);
        echo delete_task_form_modal($task_row[2]);
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<a href="#" class="list-group-item list-group-item-action disabled">Nothing to do...</a>';
    }
  }
}

function add_list()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/config.php');
    session_start();
    $idUser = $_SESSION['user_id'];
    $new_list_title = mysqli_real_escape_string($db, $_POST['newListTitle']);
    
    $sql = 'INSERT INTO Lists VALUES (idLists, "'.$new_list_title.'", '.$idUser.')';
    if ($result = mysqli_query($db, $sql)) {
      header("Location: ../homepage.php");
    } else {
      die(mysqli_error());
    }
  }
}

function edit_list_form_modal($idList, $list_title)
{
  return '<div class="modal fade" id="editListForm'.$idList.'" tabindex="-1" role="dialog">'
          .'<div class="modal-dialog" role="document">'
            .'<div class="modal-content">'
              .'<div class="modal-header">'
                .'<h5 class="modal-title">Edit List</h5>'
                .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                  .'<span aria-hidden="true">&times;</span>'
                .'</button>'
              .'</div>'
              .'<div class="modal-body">'
                .'<form action="./controllers/lists.php" method="post">'
                  .'<input type="hidden" name="super_id_list" value="'.$idList.'">'
                  .'<div class="form-group">'
                    .'<label for="editListTittle'.$idList.'">Title</label>'
                    .'<input required type="text" class="form-control" name="editListTittle'.$idList.'" id="editListTittle'.$idList.'" value="'.$list_title.'">'
                  .'</div>'
                  .'<div class="form-group row justify-content-around">'
                    .'<input type="submit" class="btn btn-success btn-lg" name="editList" id="editList" value="Update">'
                    .'<input type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#editListForm'.$idList.'" value="Cancel">'
                  .'</div>'
                .'</form>'
              .'</div>'
            .'</div>'
          .'</div>'
        .'</div>';
}

function edit_list()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/config.php');
    session_start();
    $id_list = mysqli_real_escape_string($db, $_POST['super_id_list']);
    $new_title = mysqli_real_escape_string($db, $_POST['editListTittle'.$id_list]);
    
    $sql = 'UPDATE Lists SET Title = "'.$new_title.'" WHERE idLists = '.$id_list;
    if ($result = mysqli_query($db, $sql)) {
      header("Location: ../homepage.php");
    } else {
      die(mysqli_error());
    }
  }
}

function delete_list_form_modal($idList)
{
  return '<div class="modal fade" id="deleteListForm'.$idList.'" tabindex="-1" role="dialog">'
          .'<div class="modal-dialog" role="document">'
            .'<div class="modal-content">'
              .'<div class="modal-header">'
                .'<h5 class="modal-title">Delete List</h5>'
                .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                  .'<span aria-hidden="true">&times;</span>'
                .'</button>'
              .'</div>'
              .'<div class="modal-body">'
                .'<form action="./controllers/lists.php" method="post">'
                  .'<input type="hidden" name="super_id_list" value="'.$idList.'">'
                  .'<div class="form-group">'
                    .'<h2">Are you sure about this?</h2>'
                  .'</div>'
                  .'<div class="form-group row justify-content-around">'
                    .'<input type="submit" class="btn btn-success btn-lg" name="deleteList" id="deleteList" value="Simon">'
                    .'<input type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#deleteListForm'.$idList.'" value="Nelson">'
                  .'</div>'
                .'</form>'
              .'</div>'
            .'</div>'
          .'</div>'
        .'</div>';
}

function delete_list()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../config/config.php');
    session_start();
    $id_list = mysqli_real_escape_string($db, $_POST['super_id_list']);
    
    $sql = 'DELETE FROM Lists WHERE idLists = '.$id_list;
    if ($result = mysqli_query($db, $sql)) {
      header("Location: ../homepage.php");
    } else {
      die(mysqli_error());
    }
  }
}

function add_task_form_modal($idList)
{
  return '<div class="modal fade" id="newTaskForm'.$idList.'" tabindex="-1" role="dialog">'
          .'<div class="modal-dialog" role="document">'
            .'<div class="modal-content">'
              .'<div class="modal-header">'
                .'<h5 class="modal-title">Add Task</h5>'
                .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                  .'<span aria-hidden="true">&times;</span>'
                .'</button>'
              .'</div>'
              .'<div class="modal-body">'
                .'<form action="./controllers/tasks.php" method="post">'
                  .'<input type="hidden" name="super_id_list" value="'.$idList.'">'
                  .'<div class="form-group">'
                    .'<label for="newTaskTitle">Title</label>'
                    .'<input required type="text" class="form-control" name="newTaskTitle" id="newTaskTitle'.$idList.'" placeholder="Type something awesome!">'
                  .'</div>'
                  .'<div class="form-group">'
                    .'<label for="newTaskDescription">Description</label>'
                    .'<textarea type="text" class="form-control" name="newTaskDescription" id="newTaskDescription'.$idList.'" placeholder="What will you have to do?"></textarea>'
                  .'</div>'
                  .'<div class="form-group row justify-content-around">'
                    .'<input type="submit" class="btn btn-success btn-lg" name="addTask" id="addTask" value="Add">'
                    .'<input type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#newTaskForm'.$idList.'" value="Cancel">'
                  .'</div>'
                .'</form>'
              .'</div>'
            .'</div>'
          .'</div>'
        .'</div>';
}

function edit_task_form_modal($idTask, $task_title, $task_desc, $task_status)
{
  if ($task_status == 1) {
    $super_checkbox = '<input type="checkbox" checked class="form-check-input" name="editTaskStatus'.$idTask.'" id="editTaskStatus'.$idTask.'">';
  } else {
    $super_checkbox = '<input type="checkbox" class="form-check-input" name="editTaskStatus'.$idTask.'" id="editTaskStatus'.$idTask.'">';
  }
  return '<div class="modal fade" id="editTaskForm'.$idTask.'" tabindex="-1" role="dialog">'
          .'<div class="modal-dialog" role="document">'
            .'<div class="modal-content">'
              .'<div class="modal-header">'
                .'<h5 class="modal-title">Edit Task</h5>'
                .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                  .'<span aria-hidden="true">&times;</span>'
                .'</button>'
              .'</div>'
              .'<div class="modal-body">'
                .'<form action="./controllers/tasks.php" method="post">'
                  .'<input type="hidden" name="super_id_task" value="'.$idTask.'">'
                  .'<div class="form-group">'
                    .'<label for="editTaskTitle'.$idTask.'">Title</label>'
                    .'<input required type="text" class="form-control" name="editTaskTitle'.$idTask.'" id="editTaskTitle'.$idTask.'" value="'.$task_title.'">'
                  .'</div>'
                  .'<div class="form-group">'
                    .'<label for="editTaskDescription'.$idTask.'">Description</label>'
                    .'<textarea type="text" class="form-control" name="editTaskDescription'.$idTask.'" id="editTaskDescription'.$idTask.'" placeholder="What will you have to do?">'.$task_desc.'</textarea>'
                  .'</div>'
                  .'<div class="form-group form-check">'
                    .$super_checkbox
                    .'<label class="form-check-label" for="editTaskStatus'.$idTask.'">Task completed</label>'
                  .'</div>'
                  .'<div class="form-group row justify-content-around">'
                    .'<input type="submit" class="btn btn-success btn-lg" name="editTask" id="editTask" value="Update">'
                    .'<input type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#editTaskForm'.$idTask.'" value="Cancel">'
                  .'</div>'
                .'</form>'
              .'</div>'
            .'</div>'
          .'</div>'
        .'</div>';
}

function delete_task_form_modal($idTask)
{
  return '<div class="modal fade" id="deleteTaskForm'.$idTask.'" tabindex="-1" role="dialog">'
          .'<div class="modal-dialog" role="document">'
            .'<div class="modal-content">'
              .'<div class="modal-header">'
                .'<h5 class="modal-title">Delete Task</h5>'
                .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                  .'<span aria-hidden="true">&times;</span>'
                .'</button>'
              .'</div>'
              .'<div class="modal-body">'
                .'<form action="./controllers/tasks.php" method="post">'
                  .'<input type="hidden" name="super_id_task" value="'.$idTask.'">'
                  .'<div class="form-group">'
                    .'<h2">Are you sure about this?</h2>'
                  .'</div>'
                  .'<div class="form-group row justify-content-around">'
                    .'<input type="submit" class="btn btn-success btn-lg" name="deleteTask" id="deleteTask" value="Simon">'
                    .'<input type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#deleteTaskForm'.$idTask.'" value="Nelson">'
                  .'</div>'
                .'</form>'
              .'</div>'
            .'</div>'
          .'</div>'
        .'</div>';
}
?>
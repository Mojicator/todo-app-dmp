<form action="./controllers/lists.php" method="post">
  <div class="form-group">
    <label for="newListTitle">Title</label>
    <input required type="text" class="form-control" name="newListTitle" id="newListTitle" placeholder="Type something awesome!">
  </div>
  <div class="form-group row justify-content-around">
    <input type="submit" class="btn btn-success btn-lg" name="addList" id="addList" value="Add">
    <input type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#addListForm" value="Cancel">
  </div>
</form>

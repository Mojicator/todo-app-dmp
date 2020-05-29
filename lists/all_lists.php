<div>
  <div class="d-flex justify-content-between mb-2">
    <h4>Lists</h4>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addListForm">Add</button>
  </div>
  <div class="modal fade" id="addListForm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php require_once('./lists/new_list.php'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="nav nav-tabs">
    <?php
      include('./controllers/lists.php');
      show_lists();
    ?>
  </div>
</div>
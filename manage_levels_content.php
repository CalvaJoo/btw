<!-- manage_levels_content.php -->
<h2>Manage Levels</h2>
<div class="row">
  <div class="col-md-6">
    <h4><?= $edit ? 'Edit Level #' . $edit['number'] : 'Add Level'?></h4>
    <form method="post">
      <input type="hidden" name="<?= $edit ? 'edit_id' : ''?>" value="<?= $edit['id'] ?? ''?>">
      <div class="mb-3">
        <label class="form-label">Level Number</label>
        <input name="number" type="number" class="form-control" required
               value="<?= htmlspecialchars($edit['number'] ?? '')?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Answer</label>
        <input name="answer" class="form-control" required
               value="<?= htmlspecialchars($edit['answer'] ?? '')?>">
      </div>
      <button name="<?= $edit ? '' : 'add'?>" class="btn <?= $edit ? 'btn-primary' : 'btn-success'?>">
        <?= $edit ? 'Update' : 'Add'?>
      </button>
      <?php if($edit): ?>
        <a href="manage_levels.php" class="btn btn-secondary">Cancel</a>
      <?php endif;?>
    </form>
  </div>
  <div class="col-md-6">
    <h4>Existing Levels</h4>
    <table class="table">
      <thead><tr><th>#</th><th>Answer</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach($levels as $lvl): ?>
        <tr>
          <td><?= $lvl['number']?></td>
          <td><?= htmlspecialchars($lvl['answer'])?></td>
          <td>
            <a href="?edit=<?= $lvl['id']?>" class="btn btn-sm btn-warning">Edit</a>
            <form method="post" style="display:inline">
              <input type="hidden" name="delete_id" value="<?=$lvl['id']?>">
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>

<!-- manage_teams_content.php -->
<h2>Manage Teams</h2>
<div class="row">
  <div class="col-md-6">
    <h4>Add Team</h4>
    <form method="post">
      <input type="hidden" name="add" value="1">
      <div class="mb-3">
        <label class="form-label">Team Name</label>
        <input name="team_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-success">Add Team</button>
    </form>
  </div>
  <div class="col-md-6">
    <h4>Existing Teams</h4>
    <table class="table">
      <thead><tr><th>Team</th><th>Role</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach($teams as $t): ?>
        <tr>
          <td><?=htmlspecialchars($t['team_name'])?></td>
          <td><?= $t['role']==0 ? 'Admin' : 'Team'?></td>
          <td>
            <?php if($t['id'] != $_SESSION['team_id']): ?>
            <form method="post" style="display:inline">
              <input type="hidden" name="delete_id" value="<?=$t['id']?>">
              <button class="btn btn-sm btn-danger" onclick="return confirm('Remove this team?')">Delete</button>
            </form>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>

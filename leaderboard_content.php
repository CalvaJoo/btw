<?php
// leaderboard_content.php
// (this file is pulled into <div class="container"> by admin_base.php)
?>
<h2>Leaderboard (real-time)</h2>
<table class="table table-striped" id="leaderboard-table">
  <thead>
    <tr>
      <th>Team Name</th>
      <th>Current Level</th>
      <th>Finish Time</th>
      <th>Attempts</th>
    </tr>
  </thead>
  <tbody>
    <!-- populated via AJAX -->
  </tbody>
</table>

<!-- AJAX refresh script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function fetchLeaderboard() {
    $.ajax({
      url: 'leaderboard_data.php',
      dataType: 'json',
      cache: false,
      success: function(res) {
        var tbody = $('#leaderboard-table tbody').empty();
        res.progress_list.forEach(function(p) {
          $('<tr>')
            .append($('<td>').text(p.team_name))
            .append($('<td>').text(p.current_level))
            .append($('<td>').text(p.finish_time))
            .append($('<td>').text(p.attempts))
            .appendTo(tbody);
        });
      }
    });
  }

  // initial load + update every second
  fetchLeaderboard();
  setInterval(fetchLeaderboard, 1000);
</script>

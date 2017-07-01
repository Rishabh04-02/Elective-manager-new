<?php
    include_once('views/student/student_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
<form class="update" action="" method="post">
<button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" name="pubelec" value="pubelec" type="submit"> Published Electives </button> -
</form>
<form class="update" action="" method="post">
<button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" name="fillprior" value="fillprior" type="submit"> Apply for Elective </button>
</form>

<div class="mdl-grid">

<?php
      if(isset($_POST['pubelec']))  {
?>
<div class="mdl-cell">
  <div class="mdl-card__supporting-text">
    <h4>
      Published Electives - <a><?php   Database::publishedelectives();  ?></a>
    </h4>
  </div>
  <div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Department</th>
      <th class="mdl-data-table__cell--non-numeric">Subject code</th>
      <th class="mdl-data-table__cell--non-numeric">Subject name</th>
      <th>Semester</th>
      <th>Total seats</th>
    </tr>
  </thead>
  <tbody>
        <?php  Database::publishedelectivesdetails();   ?>
  </tbody>
</table>
</div>
</div>
<?php
    }

      if(isset($_POST['fillprior']))  {
?>
<form class="admlog" action="/student/profile/apply" method="post">
    <h1 class="dept">Apply for elective</h1>
    <center><!-- This drop down feature here allows the superuser of one department to create normaluser of another, this feature can be vulnerable. This feature can be easily substituted with a secure one. -->
      <select name="type" required>
      <option selected="true" disabled="disabled">Choose the type of Elective</option>
      <option value="open_elective">Open Elective</option>
      <option value="dept_elective">Departmental Elective</option>
      <option value="pg_elective">PG Elective</option>
      </select></center> <br><br>

    <button name="elective" value="elective" class="login" type="submit">Next</button>
</form>
<?php
    }
?>



</div>
</div>
</main>
</div>
</body>
</html>
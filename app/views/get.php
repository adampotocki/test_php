<?php

  require_once(dirname(__FILE__) . '/../controllers/student.php');

  $ctrl = new StudentController();
  $students = $ctrl->getStudents();

?>

<div class="col-sm-12 text-center">
  <h2>Student List</h2>
</div>
<table class="table table-striped table-condensed">
  <thead>
    <tr class="success">
      <th>#</th>
      <th>Name</th>
      <th>Birthdate</th>
      <th>Active</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($students)) { ?>
      <tr class="text-center">
        <td colspan="5">No students found</td>
      </tr>
    <?php } else { ?>
      <?php foreach ($students as $key => $value) { ?>
        <tr>
          <td>
            <a href="#" class="edit"><?= $value->getId() ?></a>
          </td>
          <td><?= $value->getName() ?></td>
          <td><?= $value->getDob() ?></td>
          <td><?= $value->getActive() == 1 ? 'Yes' : 'No' ?></td>
          <td>
            <a href="#" class="delete">
              <span class="glyphicon glyphicon-remove"></span>
            </a>
          </td>
        </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>
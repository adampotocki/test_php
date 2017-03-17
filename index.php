<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Directory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
  </head>
  <body>

    <div class="container">
      <div class="row-fluid">
        <p id="message" class="well-sm"></p>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3>Student Directory</h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" method="post" id="student_form">

              <div class="form-group">
                <label for="id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-9">
                  <input type="text" name="id" id="id" value="" class="form-control" disabled>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" id="name" value="" class="form-control" placeholder="Enter your name" autofocus>
                </div>
              </div>

              <div class="form-group">
                <label for="dob" class="col-sm-2 control-label">Birthdate</label>
                <div class="col-sm-9">
                  <input type="text" name="dob" id="dob" value="" class="form-control" placeholder="MM/DD/YYYY" autofocus>
                </div>
              </div>

              <div class="form-group">
                <label for="active" class="col-sm-2 control-label">Active?</label>
                <div class="col-sm-9">
                  <select name="active" id="active">
                    <option value="FALSE">No</option>
                    <option value="TRUE">Yes</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-10 col-sm-2">
                  <input type="submit" name="save" value="save" class="btn btn-success">
                </div>
              </div>

            </form>
          </div>
          <div class="panel-footer">
            <div class="row-fluid" id="studentList"></div>
          </div>
        </div>
      </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/public/js/students.js"></script>
  </body>
</html>
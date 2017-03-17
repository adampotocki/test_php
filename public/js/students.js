$(function() {
  $('#message').hide();
  getStudents();

  var validator = $('#student_form').validate({
    rules: {
      name: {
        required: true
      },
      dob: {
        required: true,
        date: true,
        minlength: 10,
        maxlength: 10
      },
      active: {
        required: true
      }
    },
    submitHandler: function(form) {
      $('#id').removeAttr('disabled');
      var data = $('#student_form').serialize();

      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/app/views/create.php',
        data: data,
        beforeSend: function(data) {
          clearMessage();
        },
        error: function(data) {
          showMessageError(data);
        },
        success: function(data) {
          showMessageSuccess(data);
          getStudents();
          $('#student_form')[0].reset();
          $('#name').focus();
          validator.resetForm();
          $('#id').attr('disabled', 'disabled');
        }
      });
      return false;
    }
  });
});

function getStudents() {
  $.ajax({
    type: 'POST',
    dataType: 'html',
    url: '/app/views/get.php',
    success: function(data) {
      $('#studentList').html(data);
    },
    error: function(data) {
      $('#studentList').html(data);
    }
  });
}

function showMessageSuccess(data) {
  $.each(data, function(key, value) {
    if (key == 'success') {
      $('#message').addClass('alert-success bg-success');
    } else {
      $('#message').addClass('alert-danger bg-danger');
    }
    $('#message').html(value);
  });
  $('#message').show();
}

function showMessageError(data) {
  $('#message').html(data.responseText);
  $('#message').addClass('alert-danger bg-danger');
  $('#message').show();
}

function clearMessage() {
  $('#message').html('');
  $('#message').removeClass('alert-danger alert-success bg-danger bg-success');
}

$(document).on('click', 'a.delete', function(e) {
  e.preventDefault();
  if (confirm('Are you sure?')) {
    var id = $(this).parent().parent().find('td:eq(0)').text();
    $.ajax({
      type: 'POST',
      dataType: 'json',
      data: { id: id },
      url: '/app/views/delete.php',
      beforeSend: function(data) {
        clearMessage();
      },
      success: function(data) {
        showMessageSuccess(data);
        getStudents();
      },
      error: function(data) {
        showMessageError(data);
      }
    });
  }
});

$(document).on('click', 'a.edit', function(e) {
  e.preventDefault();
  var id = $(this).parent().parent().find('td:eq(0)').text();
  $.ajax({
    type: 'POST',
    dataType: 'json',
    data: { id: id },
    url: '/app/views/update.php',
    beforeSend: function(data) {
      clearMessage();
    },
    success: function(data) {
      $('#id').val(data.id);
      $('#name').val(data.name);
      $('#dob').val(data.dob);
      data.active === true ? $('#active').val('TRUE') : $('#active').val('FALSE');
    },
    error: function(data) {
      showMessageError(data);
    }
  });
});
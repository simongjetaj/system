jQuery(document).ready(function() {
  $('#login_email').on('input', function() {
    var input = $(this);
    var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var is_email = re.test(input.val());
    if(is_email) { 
      input.removeClass("invalid").addClass("valid");
    }
    else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#register_email').on('input', function() {
    var input = $(this);
    var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var is_email = re.test(input.val());
    if(is_email) { 
      input.removeClass("invalid").addClass("valid");
    }
    else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#login_password').on('input', function() {
    var input=$(this);
    var pass = input.val().trim().length;
    if(pass >= 6) {
      input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");}
  });

    $('#register_password').on('input', function() {
      var input1 = $(this);
      var pass1 = input1.val().trim().length;
      if(pass1 >= 6) {
        input1.removeClass("invalid").addClass("valid");
      } else {
        input1.removeClass("valid").addClass("invalid");
      }
    });


  $('#register_password2').on('input', function() {
    var input2 = $(this);
    var password1 = $('#register_password').val().trim();
    var password2 = input2.val().trim();
    var pass2 = input2.val().trim().length;
    if(pass2 >= 6 && password1 === password2) {
      input2.removeClass("invalid").addClass("valid");
    } else {
      input2.removeClass("valid").addClass("invalid");}
  });

  $('#fullname').on('input', function() {
    var input = $(this);
    var fullname = input.val().trim().length;
    if(fullname>=5) {
       input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#department').on('input', function() {
    var input = $(this);
    var department = input.val().trim().length;
    if(department != '') {
       input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#dep').on('input', function() {
    var input = $(this);
    var dep = input.val().trim().length;
    if(dep != '') {
       input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#image').on('change', function() {
    var input = $(this);
    var image = input.val();
    if(image) {
       input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#role').on('change', function() {
    var input = $(this);
    var role = input.val();
    if(role) {
       input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $('#address').on('input', function() {
    var input = $(this);
    var address = input.val().trim().length;
    if(address>=6) {
       input.removeClass("invalid").addClass("valid");
    } else {
      input.removeClass("valid").addClass("invalid");
    }
  });

  $("#tree").jstree();          

  var table = $('#users_table').DataTable({     
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "admin/ajax_list",
        "type": "POST"
    },

    //Set column definition initialisation properties.
    "columnDefs": [
    { 
        "targets": [0, 1, 6], 
        "orderable": false, //set not orderable
    },
    ],
    "language": {                
      "infoFiltered": "",
      "infoPostFix": "<br><strong>All records shown are derived from users information.</strong>"
    },
});

$(document).on("click", '.deleteUser', function() {
  var id = $(this).attr("id");
  if(confirm("Are you sure you want to delete this user?")) {
    $.ajax({
      url: "admin/delete_user",
      method: "POST",
      data: {id: id},
      success: function(data) {
        table.ajax.reload();
      }
    });
  }
});

$("textarea#chat").keypress(function(e) {
  if(e.which == 13) {
    $("a#message").click();
    return false;
  }
});

$("a#message").click(function() {
  var chat_message_content = $("#chat").val().trim();

  if(chat_message_content == "") { return false; }
  $.post("chat/ajax_add_chat_message", { chat_message_content: chat_message_content, user_id: user_id }, function(data) {
    if(data.status == 'ok') {
      $("#output").html(data.content);
  } else {
      // error
      alert("Error!");
  }
  }, "json");
  $('textarea').val('');
  return false;
});



});


<?php require_once('partials/header.php'); ?>

<h1 class="text-center style">Chat Room</h1>

<?php if($this->session->userdata('department')) { ?>
  <div class="container">
    <a class="pull-left btn btn-warning btn-xs" href="admin"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  </div>
<?php } else { ?>
  <div class="container">
    <a class="pull-left btn btn-warning btn-xs" href="user"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
  </div>
<?php } ?>

<div class="container">
  <div class="well col-md-6">
    <textarea name="chat" id="chat" autofocus></textarea><br>
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <a href="#" id="message" class="btn btn-block btn-primary btn-lg"><i class="fa fa-weixin" aria-hidden="true"></i> Send</a>
  </div>
  <div id="output" class="well col-md-6">

  </div>
</div>

<?php require_once('partials/footer.php'); ?>
<script>
  var user_id = "<?php echo $user_id ?>";

  function get_chat_messages() {
  $.post("chat/ajax_get_chat_messages", function(data) {
    if(data.status == 'ok') {
       $("#output").html(data.content);
    } else {
      // error
      return false;
    }
  }, "json");
}

  get_chat_messages();
  setInterval(function() {
    get_chat_messages();
  }, 1500);

</script>
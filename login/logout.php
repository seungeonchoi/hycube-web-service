<?php session_destroy();
      echo '<script>
               location.href="../main.php"
      </script>';?>


<!-- 모달 만드는중 -->

<!--<script>
      window.onload = function(){
        $(document).ready(function(){
          location.href="../main.php"
          $('#LogoutModal').modal('show');
        });
      }
</script>

<div class="modal fade" id="LogoutModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="ModalTitle">System</h3>
      </div>
      <div class="modal-body">
        <p>로그아웃 되었습니다.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
-->

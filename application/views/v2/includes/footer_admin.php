          
        </div>
        <div class="w-100">
            <div class="row">
                <div class="col-12 d-flex mt-4">
                    <span class="content-subtitle">Copyright © 2020 nSmarTrac. All rights reserved.</span>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- Chart JS -->
    <script src="<?= base_url("assets/js/v2/chart.min.js") ?>"></script> 
    <!-- Boostrap JS -->
    <script src="<?= base_url("assets/js/v2/bootstrap.bundle.min.js") ?>" crossorigin="anonymous"></script>
    <!-- Sweetalert JS -->
    <script src="<?= base_url("assets/js/v2/sweetalert2.min.js") ?>"></script>
    <!-- Pusher JS -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Datepicker -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/bootstrap-datepicker.min.js") ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url("assets/plugins/select2/dist/js/select2.full.min.js"); ?>"></script>
    <!-- Switchery -->
    <script src="<?= base_url("assets/plugins/switchery/switchery.min.js"); ?>"></script>
    <!-- Main Script -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/main.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.draggable.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.table.js") ?>"></script>
    <!-- Bootstrap toggle -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
        var baseURL = '<?= base_url() ?>';        
        $(document).on('click', '.btn-company-user-switch', function(){
            $.ajax({
                url: baseURL + 'admin/ajax_switch_to_company_user',
                dataType: 'json',
                success: function (e) {
                    if( e.is_valid == 1 ){
                        location.href = '<?= base_url('dashboard'); ?>'
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Error!',
                          confirmButtonColor: '#32243d',
                          html: e.msg
                        });
                    }
                    
                }
            });
        });
    </script>
  </body>

</html>
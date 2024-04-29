<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/activity_logs_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Track and monitor user activities
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Logs">
                        </div>
                    </div>
                    <!-- <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">                            
                            <button type="button" name="btn_link" class="nsm-button btn-export-list">
                                <i class='bx bx-fw bx-export'></i> Export List
                            </button>
                        </div>
                    </div> -->
                </div>
                <table class="nsm-table" id="activity-logs">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="LogUser"></td>                            
                            <td data-name="LogDetails" style="width:70%;">Logs</td>
                            <td data-name="LogDate">Date</td>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($activityLogs)){ ?>
                            <?php foreach ($activityLogs as $log) { ?>
                              <tr>
                                <td><div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($log->user_id); ?>');"></div></td>
                                <td class="nsm-text-primary">
                                    <label class="d-block fw-bold"><?php echo $log->first_name . ' ' . $log->last_name ?></label>
                                    <label class="content-subtitle fst-italic d-block"><i class='bx bx-envelope'></i><?php echo $log->email; ?></label>
                                </td>                                
                                <td  class="nsm-text-primary"><?= $log->activity_name; ?></td>
                                <td><?= date("m/d/Y h:i:s A",strtotime($log->created_at)) ?></td>
                              </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No data found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      $("#activity-logs").nsmPagination({itemsPerPage:10});

      $("#search_field").on("input", debounce(function() {
          tableSearch($(this));
      }, 1000));
  });
</script>
<?php include viewPath('v2/includes/footer'); ?>
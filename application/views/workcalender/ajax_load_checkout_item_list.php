<style>
label>input {
  visibility: initial !important;
  position: initial !important; 
}
</style>
<table class="table table-hover" id="dtItemList">
  <thead>
      <tr>
          <th style="width: 40%;text-align: left;">Item Name</th>
          <th style="width: 30%;text-align: left;">Item Type</th>
          <th style="width: 20%;">Item Price</th>
          <th style="width: 10%;"></th>
      </tr>
  </thead>
  <tbody>
      <?php foreach($items as $i){ ?>
          <tr>
              <td align="left" style="font-size: 16px !important;"><?= $i->title; ?></td>
              <td align="left" style="font-size: 16px !important;"><?= ucwords($i->type); ?></td>
              <td align="right" style="font-size: 16px !important;">$<?= number_format($i->price,2); ?></td>
              <td>
                  <a class="btn btn-primary btn-sm btn-add-item-row" data-id="<?= $i->id; ?>" href="javascript:void(0);"><i class="fa fa-plus"></i></a>
              </td>
          </tr>
      <?php } ?>
  </tbody>
</table>
<script>
$(function(){
  var table = $('#dtItemList').DataTable({
      "searching" : true,
      "paging":   false,
      "order": [],
       "aoColumnDefs": [
        { "sWidth": "40%", "aTargets": [ 0 ] },
        { "sWidth": "20%", "aTargets": [ 1 ] },          
        { "sWidth": "20%", "aTargets": [ 2 ] },          
        { "sWidth": "10%", "aTargets": [ 3 ] },          
      ]
  });
});
</script>
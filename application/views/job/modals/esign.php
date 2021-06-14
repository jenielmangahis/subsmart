<div class="modal fade" id="confirmEsignModal" tabindex="-1" role="dialog" aria-labelledby="confirmEsignModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmEsignModalLabel">Choose what to do next</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary mr-1">
                Select eSign template
            </button>

            <button type="button" class="btn btn-secondary">
                Proceed to invoice
            </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="docusignTemplateModal" tabindex="-1" role="dialog" aria-labelledby="docusignTemplateModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="docusignTemplateModalLabel">Select Template</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<table id="templatesTable" class="table" style="width: 100%;">
				<thead>
					<tr>
						<th>Name</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		</div>
		</div>
	</div>
</div>

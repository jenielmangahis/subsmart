<div class="row">
    <div class="col-sm-12">
        <label class="mb-2">Customer</label>
        <div class="input-group mb-3">            
            <select class="edit-select-customer form-select form-control" name="customer_id" required="">
                <option value="<?= $customer->prof_id; ?>"><?= $customer->first_name . ' ' . $customer->last_name; ?></option>
            </select>
        </div>
    </div>    
    <div class="col-sm-12">
        <label class="mb-2">Notes</label>
        <div class="input-group mb-3">
            <textarea class="form-control" name="interal_notes" required=""><?= $internalNote->notes; ?></textarea>                            
        </div>
    </div>                 
</div>
<script>
$(function(){
    $('.edit-select-customer').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Select Customer',
        dropdownParent: $("#modal-edit-customer-internal-notes"),
        minimumInputLength: 0,
        templateResult: formatEditRepoCustomer,
        templateSelection: formatEditRepoCustomerSelection
    });

    function formatEditRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        let $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatEditRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            let customer_name = repo.first_name + ' ' + repo.last_name;
            let deal_name = customer_name + ' deal';
            $('#deal-title').val(deal_name);

            return customer_name;
        } else {
            return repo.text;
        }
    }
});
</script>
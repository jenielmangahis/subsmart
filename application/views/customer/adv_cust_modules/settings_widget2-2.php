<div class="card">
    <div class=" float-right">
        <a class="btn btn-primary" href="<?= isset($profile_info)? url('/customer/index/tab3/'.$profile_info->prof_id).'/mt3-cdl' : '#'; ?>">
            <span class="fa fa-arrow-left"></span> Back
        </a>
        <button type="button" class="btn btn-primary" onclick="printHtml()"> <span class="fa fa-print"></span> Print </button>

    </div>
    <div class="card-body">
        <div class="col-lg-12">
            <?php //print_r($letter_template); ?>
            <br>
            <div class="col-md-12 form-line">
                <div class="row">

                        <div class="col-md-12 form-line">
                            <div class="row">
                                <label for="letterTitle">Title : </label>
                                <input type="text" class="form-control" value="<?= isset($letter_template) ? $letter_template->title : ""; ?>" id="letterTitle">

                            </div>
                        </div>
                        <div class="col-md-12 form-line">
                            <div class="row">
                                <label for="letterTitle">Library : </label>
                                <input type="text" class="form-control" value="<?=isset($letter_template) ? $letter_template->title : ""?>" id="letterTitle">
                            </div>
                        </div>
                        <div class="col-md-12 form-line">
                            <div class="row">
                                <label for="letterTitle">Category : </label>
                                <input type="text" class="form-control" value="<?=isset($letter_template) ? $letter_template->category_id : ""?>" id="letterTitle">

                            </div>
                        </div>
                        <div class="col-md-12 form-line">
                            <div class="row">
                                <label for="">Status : </label>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="radio1">
                                        <input <?=isset($letter_template) && $letter_template->status ? "checked" : "" ?> type="radio" class="form-check-input" id="radio1" name="status" value="1" checked>Active
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label" for="radio2">
                                        <input <?=isset($letter_template) && !$letter_template->status ? "checked" : "" ?> type="radio" class="form-check-input" id="radio2" name="status" value="0">In Active
                                    </label>
                                </div>
                            </div>
                        </div>
                            <div id="print" class="print col-md-12 form-line">
                                <textarea id="summernote" name="template "></textarea>
                            </div>

                </div>
            </div>

            <br>
            <div class="float-left d-md-block">
                <div class="dropdown">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printHtml(){
        let currentHtml = $('#summernote').summernote('code');
        var a = window.open('', '_selfs', '');
        a.document.write('<html>');
        a.document.write('<body>');
        a.document.write(currentHtml);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
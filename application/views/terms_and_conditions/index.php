<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper w-100">
    <div __wrapper_section>
        <div class="card w-100" style="height: 1250px">
            <div class="text-left">
                <div class="row">
                    <h1 class="col-6">Tems and Conditions</h1>
                    <div class="col-6 text-right">
                        <a href="/terms-and-conditions/create" class="btn btn-success">Add New</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid w-100">
                <table class="table table-hover w-100" id="termsAndConditionsTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>

<script>
const getAll = () => {
    $.ajax({
        url: `${baseUrl}/terms-and-conditions/get-all`,
        method: 'GET',
        success: (res) => {
            const data = res.data;
            data.forEach(el => {
                $('#termsAndConditionsTable tbody').append(`
                    <tr>
                        <td>${el.title}</td>
                        <td>
                            <div class="btn-group d-block form-list-item-options">
                                <a class="btn btn-sm btn-primary" href="/terms-and-conditions/${el.id}"><i class="fa fa-eye"></i> View</a>
                                <a class="btn btn-sm btn-primary" href="/terms-and-conditions/edit/${el.id}"><i class="fa fa-edit"></i> Edit</a>
                                <button class="btn btn-sm btn-primary" onclick="handleDelete(${el.id})" href="/terms-and-conditions/destroy/${el.id}"><i class="fa fa-trash"></i> Delete</button>
                            </div>
                        <td>
                    </tr>
                `)
            });
        }
    })
}

getAll();

const handleDelete = (id) => {
    if (confirm(`Delete Terms and Conditions #${id}`)) {
        $.ajax({
            url: `${baseUrl}/terms-and-conditions/destroy/${id}`,
            method: 'POST',
            success: (res) => {
                alert(res.message);
                $('#termsAndConditionsTable tbody').html('');
                getAll();
            }
        })
    }
}
</script>
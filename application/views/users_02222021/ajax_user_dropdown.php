<?php if (!empty($users)) { ?>

    <select class="form-control col-md-3" id="select-user">

        <option value="">All Employees</option>

        <?php foreach ($users as $user) { ?>

            <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>

        <?php } ?>

    </select>

<?php } ?>
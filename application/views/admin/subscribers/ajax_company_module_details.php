<style>
.modules-list{
    list-style: none;
}
.modules-list li{
    display: inline-block;
    width: 30%;
    background-color: #DDDDDD;
    margin: 8px;
    padding: 10px;
    box-shadow: 10px 5px 8px #888888;
}
.toggle-off.btn {
    padding-left: 2.5rem !important;
}
.toggle-on.btn {
    padding-right: 2.5rem !important;
}
.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem !important; }
.toggle.ios .toggle-handle { border-radius: 20rem !important; }
</style>
<div style="height: 600px; overflow: auto; width: 100%;">
<ul class="modules-list">
    <?php foreach( $templateModules as $t ){ ?>
        <?php if( $t->industry_module_name != '' ){ ?>
        <li>
            <h3 style="font-size: 15px;margin-bottom: 0px;"><?= $t->industry_module_name; ?></h3>
            <p><?= $t->industry_module_description; ?></p>
            <hr />
            <div style="width: 100%;display: block;text-align: center;">
            <input type="checkbox" class="b-toggle" checked data-toggle="toggle" data-width="250" data-on="Activated" data-off="Deactivated" data-onstyle="success" data-offstyle="danger" data-style="ios">
            </div>
        </li>
        <?php } ?>
    <?php } ?>
</ul>
</div> 
<script>
$(function(){
    $(".b-toggle").bootstrapToggle();
});    
</script>
<div class="<?= $class ?>"  data-id="<?= $id ?>"  id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-tags" aria-hidden="true"></i> Tags
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                    <li><a href="#" class="float-right text-light">Create Tags</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="tagsBody" style="<?= $height; ?> overflow-y: scroll; padding:5px 15px;">

                </div>
                <div class="text-center">
                    <a class="text-info" href="#">View All</a>
                </div>

            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        loadJobTags();
        

    });
    Colors = {};
    Colors.names = {
        black: "#000000",
        blue: "#0000ff",
        brown: "#a52a2a",
        darkblue: "#00008b",
        darkcyan: "#008b8b",
        darkgreen: "#006400",
        darkkhaki: "#bdb76b",
        darkmagenta: "#8b008b",
        darkolivegreen: "#556b2f",
        darkorange: "#ff8c00",
        darkorchid: "#9932cc",
        darkred: "#8b0000",
        darksalmon: "#e9967a",
        darkviolet: "#9400d3",
        gold: "#ffd700",
        green: "#008000",
        indigo: "#4b0082",
        magenta: "#ff00ff",
        maroon: "#800000",
        navy: "#000080",
        olive: "#808000",
        orange: "#ffa500",
        pink: "#ffc0cb",
        purple: "#800080",
        violet: "#800080",
        red: "#ff0000",
        silver: "#c0c0c0"
    };
    function loadJobTags() {


        $.ajax({
            async:false,
            url: '<?php echo base_url(); ?>widgets/getJobTags',
            method: 'get',
            data: {},
            beforeSend: function () {
                // $('#timesheetBody').html('')
            },
            success: function (response) {
                $('#tagsBody').html(response);
                
                $('.tagsData').each(function(){
                    $(this).attr({'style': 'color:'+Colors.random()});
                });
            }

        });

    }
    ;
    
    Colors.random = function() {
    var result;
    var count = 0;
    for (var prop in this.names)
        if (Math.random() < 1/++count)
           result = prop;
    return result;
    };

</script>

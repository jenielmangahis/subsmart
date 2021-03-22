<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-calculator" aria-hidden="true"></i> Estimates
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div id="estimateBody" style="<?= $height; ?> overflow-y: scroll">
                    <canvas id="estimateCanvas" height="<?= $rawHeight - 130 ?>"></canvas>
                </div>
                <div class="text-center">
                    <a class="text-info" href="<?= base_url() ?>estimate">SEE ALL ESTIMATES</a>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var color = Chart.helpers.color;
    Chart.pluginService.register({
        beforeDraw: function (chart) {
            if (chart.config.options.elements.center) {
                // Get ctx from string
                var ctx = chart.chart.ctx;

                // Get options from the center object in options
                var centerConfig = chart.config.options.elements.center;
                var fontStyle = centerConfig.fontStyle || 'Arial';
                var txt = centerConfig.text;
                var color = centerConfig.color || '#000';
                var maxFontSize = centerConfig.maxFontSize || 75;
                var sidePadding = centerConfig.sidePadding || 20;
                var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
                // Start with a base font of 30px
                ctx.font = "30px " + fontStyle;

                // Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                var stringWidth = ctx.measureText(txt).width;
                var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

                // Find out how much the font can grow in width.
                var widthRatio = elementWidth / stringWidth;
                var newFontSize = Math.floor(30 * widthRatio);
                var elementHeight = (chart.innerRadius * 2);

                // Pick a new font size so it will not be larger than the height of label.
                var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
                var minFontSize = centerConfig.minFontSize;
                var lineHeight = centerConfig.lineHeight || 25;
                var wrapText = false;

                if (minFontSize === undefined) {
                    minFontSize = 20;
                }

                if (minFontSize && fontSizeToUse < minFontSize) {
                    fontSizeToUse = minFontSize;
                    wrapText = true;
                }

                // Set font settings to draw it correctly.
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                ctx.font = fontSizeToUse + "px " + fontStyle;
                ctx.fillStyle = color;

                if (!wrapText) {
                    ctx.fillText(txt, centerX, centerY);
                    return;
                }

                var words = txt.split(' ');
                var line = '';
                var lines = [];

                // Break words up into multiple lines if necessary
                for (var n = 0; n < words.length; n++) {
                    var testLine = line + words[n] + ' ';
                    var metrics = ctx.measureText(testLine);
                    var testWidth = metrics.width;
                    if (testWidth > elementWidth && n > 0) {
                        lines.push(line);
                        line = words[n] + ' ';
                    } else {
                        line = testLine;
                    }
                }

                // Move the center up depending on line height and number of lines
                centerY -= (lines.length / 2) * lineHeight;

                for (var n = 0; n < lines.length; n++) {
                    ctx.fillText(lines[n], centerX, centerY);
                    centerY += lineHeight;
                }
                //Draw text in center
                ctx.fillText(line, centerX, centerY);
            }
        }
    });
    $(document).ready(function () {
        var ctx3 = document.getElementById('estimateCanvas').getContext('2d');
        var mixedChart = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                datasets: [{
                        data: [
                            100,
                            50,
                            80,
                            0
                        ],
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.yellow,
                            window.chartColors.green,
                        ],
                    }],
                labels: [
                    'Created',
                    'Open',
                    'Lost',
                    'Won',
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    align: 'left',
                    labels: {
                        fontSize: 13
                    }
                },

                elements: {
                    center: {
                        text: 'Estimates',
                        color: '#FF6384', // Default is #000000
                        fontStyle: 'Arial', // Default is Arial
                        sidePadding: 20, // Default is 20 (as a percentage)
                        minFontSize: 12, // Default is 20 (in px), set to false and text will not wrap.
                        lineHeight: 25 // Default is 25 (in px), used for when text wraps
                    }
                },
                plugins: {
                    labels: {
                        render: 'percentage',
                        precision: 2,
                        showActualPercentages: true,
                        showZero: true,
                        position: 'outside'
                    }
                }
            }
        });
    });




</script>
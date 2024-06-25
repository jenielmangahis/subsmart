document.addEventListener('DOMContentLoaded', (event) => {
    var dragSrcEl = null;
    var dragSrcJqueryEl = null

    function handleDragStart(e) {
        this.style.opacity = '0.4';
        dragSrcEl = this;
        dragSrcJqueryEl = $(this);

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }

        e.dataTransfer.dropEffect = 'move';


        return false;
    }

    function handleDragEnter(e) {
        this.classList.add('over');
    }

    function handleDragLeave(e) {
        this.classList.remove('over');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (dragSrcEl != this) {
            dragSrcEl.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');

        }

        let chartSrc = dragSrcJqueryEl.find(".nsm-chart");
        let chartTarget = $(this).find(".nsm-chart");

        $.each(chartSrc, function(idx, obj) {
            chartType = $(this).attr("data-chart-type");
            initializeChart(chartType);

        });

        $.each(chartTarget, function(idx, obj) {
            chartType = $(this).attr("data-chart-type");

            initializeChart(chartType);
        });

        return false;
    }

    function handleDragEnd(e) {
        this.style.opacity = '1';

        items.forEach(function(item) {
            item.classList.remove('over');
        });
    }

    let items = document.querySelectorAll('.nsm-draggable-container .nsm-grid');
    items.forEach(function(item) {
        item.addEventListener('dragstart', handleDragStart, false);
        item.addEventListener('dragenter', handleDragEnter, false);
        item.addEventListener('dragover', handleDragOver, false);
        item.addEventListener('dragleave', handleDragLeave, false);
        item.addEventListener('drop', handleDrop, false);
        item.addEventListener('dragend', handleDragEnd, false);
    });
});


document.addEventListener('DOMContentLoaded', (event) => {
    var dragSrcEl = null;
    var dragSrcJqueryEl = null

    function handleDragStart(e) {
        this.style.opacity = '1';
        dragSrcEl = this;
        dragSrcJqueryEl = $(this);

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }

        e.dataTransfer.dropEffect = 'move';


        return false;
    }

    function handleDragEnter(e) {
        this.classList.add('over');
    }

    function handleDragLeave(e) {
        this.classList.remove('over');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (dragSrcEl != this) {
            dragSrcEl.innerHTML = this.innerHTML;
            this.innerHTML = e.dataTransfer.getData('text/html');

        }

        let chartSrc = dragSrcJqueryEl.find(".nsm-chart");
        let chartTarget = $(this).find(".nsm-chart");

        $.each(chartSrc, function(idx, obj) {
            chartType = $(this).attr("data-chart-type");

            initializeChart(chartType);

        });

        $.each(chartTarget, function(idx, obj) {
            chartType = $(this).attr("data-chart-type");

            initializeChart(chartType);
        });

        return false;
    }

    function handleDragEnd(e) {
        this.style.opacity = '1';

        items2.forEach(function(item) {
            item.classList.remove('over');
        });
    }

    let items2 = document.querySelectorAll('.nsm-draggable-container2 .nsm-grid2');
    items2.forEach(function(item) {
        item.addEventListener('dragstart', handleDragStart, false);
        item.addEventListener('dragenter', handleDragEnter, false);
        item.addEventListener('dragover', handleDragOver, false);
        item.addEventListener('dragleave', handleDragLeave, false);
        item.addEventListener('drop', handleDrop, false);
        item.addEventListener('dragend', handleDragEnd, false);
    });
});
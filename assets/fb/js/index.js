$(() => {
    getAllForms().then(res => {
        res.data.forEach(el => {
            appendContent(el);
        });
    });
});

const handleTRMouseOver = (e) => {
    const el = $(e.target).parent().find('.form-table-row-controls');
    el.css('display', 'block')
}

const handleTRMouseLeave = (e) => {
    const el = $(e.target).parent().find('.form-table-row-controls');
    el.css('display', 'none')
}

const appendContent = (obj) => {
    const tbody = $('#formsIndexTable tbody');
    
    el = `
    <tr class="form-table-row" onmouseover="handleTRMouseOver(event)" onmouseleave="handleTRMouseLeave(event)">
        <td class="form-name-column">
            ${obj.name}
            <div class="form-table-row-controls btn-group" role="group">
                <a href="/fb/edit/${obj.id}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                <a href="/fb/settings/${obj.id}" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i> Settings</a>
                <a href="/fb/edit/share" class="btn btn-sm btn-primary"><i class="fa fa-external-link-alt"></i> Share</a>
                <a href="/fb/edit/results" class="btn btn-sm btn-primary"><i class="fa fa-file-alt"></i> Results</a>
            </div>
        </td>
        <td>${0}</td>
        <td>${0}</td>
        <td>${obj.updated_at}</td>
    </tr>
    `
    tbody.append(el);
}
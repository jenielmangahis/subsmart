$(() => {
    getAllForms().then(res => {
        renderTable(res.data);
    });
    getAllFolders().then(res => {
        res.data.forEach(el => {
            appendFolderOptions(el);
        })
    });
});

const getQueryData = () => {
    const folder = $('#folderSelect').val();
    const search_string = $('#searchInput').val();
    return { folder, search_string };
}

const handleTRMouseOver = (e) => {
    const el = $(e.target).parent().find('.form-table-row-controls');
    el.css('display', 'block')
}

const handleTRMouseLeave = (e) => {
    const el = $(e.target).parent().find('.form-table-row-controls');
    el.css('display', 'none')
}

const appendContent = (obj) => {
    const tbody = $('#formsIndexTable tbody#tableContents');
    const is_folder_favorite = parseInt(obj.favorite) === 1 ? `<i class="fa fa-heart favorite-indicator" onclick="handleRemoveFromFavorites(${obj.id})"></i>` : `<i class="far fa-heart favorite-indicator" onclick="handleAddToFavorites(${obj.id})"></i>`;
    let controls = `<div class="form-table-row-controls btn-group" role="group">
                        <a href="/fb/edit/${obj.id}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                        <a href="/fb/settings/${obj.id}" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i> Settings</a>
                        <a href="/fb/edit/share" class="btn btn-sm btn-primary"><i class="fa fa-external-link-alt"></i> Share</a>
                        <a href="/fb/edit/results" class="btn btn-sm btn-primary"><i class="fa fa-file-alt"></i> Results</a>
                        <button class="btn btn-sm btn-outline-primary" onclick="showMoveFolderModal(${obj.id})"><i class="fa fa-folder"></i></button>            
                        <button class="btn btn-sm btn-outline-primary"><i class="fa fa-copy"></i></button>            
                        <button class="btn btn-sm btn-outline-primary" onclick="showDeleteFormModal('${obj.name}', ${obj.id})"><i class="fa fa-trash"></i></button>            
                    </div>`
    if(obj.folder_id == 2) {
        controls = `<div class="form-table-row-controls btn-group" role="group">
                        <button class="btn btn-sm btn-primary" onclick="handleFormRestore(${obj.id})"><i class="fa fa-trash-restore"></i> Restore</button>
                    </div>`
    }
    el = `
    <tr class="form-table-row" onmouseover="handleTRMouseOver(event)" onmouseleave="handleTRMouseLeave(event)">
        <td class="form-name-column">
            <p class="d-block mb-1">${obj.name}</p>
            ${controls}
        </td>
        <td>${0}</td>
        <td class="text-center">${is_folder_favorite}</td>
        <td>${0}</td>
        <td>${date_pipe(obj.updated_at)}</td>
    </tr>
    `
    tbody.append(el);
}

const clearContents = () => {
    const tbody = $('#formsIndexTable tbody#tableContents');
    tbody.empty();
}

const renderTable = (forms) => {
    clearContents();
    const empty_form_indicator = $('#emptyFormIndicator');
    if (forms.length) {
        empty_form_indicator.hide();
        forms.forEach(el => {
            appendContent(el);
        });
    } else {
        empty_form_indicator.show();
    }
}

const appendFolderOptions = (obj) => {
    const opt_group = $('#folderSelect > optgroup');
    const modal_select = $('#folderMoveTo');
    const el = `<option value="${obj.id}">${obj.name}</option>`
    opt_group.append(el);
    modal_select.append(el);
}

const filterForms = () => {
    const data = getQueryData();
    getAllForms(data).then(res => {
        renderTable(res.data);
    });
}

const handleAddToFavorites = (id) => {
    const data = {
        id,
        favorite: 1
    };
    console.log(data)
    updateForm(data).then(res => {
        console.log(res)
        filterForms();
    });
}

const handleRemoveFromFavorites = (id) => {
    const data = {
        id,
        favorite: 0
    };

    updateForm(data).then(res => {
        filterForms();
    });
}

const showMoveFolderModal = (id) => {
    $('#moveFolderFormID').val(id);
    $('#moveFolderModal').modal('show');
}

const showDeleteFormModal = (name, id) => {
    $('#deleteFormName').html(name);
    $('#deleteFormID').val(id)
    $('#formDeleteModal').modal('show');
}

const handleFormRestore = (id) => {
    const folder_id = 0;
    const data = {
        id,
        folder_id
    }
    updateForm(data).then(res => {
        $('#folderSelect').val(0)
        filterForms();
    });
}
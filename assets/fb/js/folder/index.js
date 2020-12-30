let folders = [];
let active_folder = 0;
$(() => {
    getAllFolders().then(res => {
        renderTable(res.data);
    });
});

const appendFolders = (folder) => {
    const tbody = $('#foldersTBody');
    el = `
        <tr class="bg-light folder-tr" onclick="setActiveFolder(${folder.id})" id="folder-${folder.id}-tr">
            <td class="w-75 py-3 px-1">${folder.name}</td>
            <td class="w-25 px-1 text-right btn-td"><button class="btn btn-sm btn-outline-secondary mr-0" onclick="showDeleteModal()"><i
                        class="fa fa-trash-alt"></i></button></td>
        </tr>
    `
    tbody.append(el);
}

const clearContents = () => {
    const tbody = $('#foldersTBody');
    tbody.empty();
}

const clearActiveFolder = () => {
    $('.folder-tr').removeClass('active');
    active_folder = 0;
}

const renderTable = (obj) => {
    clearContents();
    folders = [];
    if(obj.length) {
        let ctr = 0;
        obj.forEach((el) => {
            folders[el.id] = el;
            if(ctr === 0) {
                appendFolders(el);
                setActiveFolder(el.id);
            } else {
                appendFolders(el);
            }
            ctr++;
        });
    } else {
        handleNewFolderClicked();
    }
}

const setActiveFolder = (folder_id) => {
    hideNewFolder();
    clearActiveFolder();
    active_folder = folder_id;
    $(`#folder-${folder_id}-tr`).addClass('active');
    $('#folderName').val(folders[active_folder].name);
}

const handleFolderSave = () => {
    const id = active_folder;
    const name = $('#folderName').val();
    const data = {id, name};
    const save_method = id ? 'update' : 'create';
    showLoading();
    saveFolder(data, save_method).then(res => {
        showSuccess();
        getAllFolders().then(res => {
            renderTable(res.data);
        });
    }).catch(err => {
        showDanger();
    })
}

const handleNewFolderClicked = () => {
    clearActiveFolder();
    showNewFolder();
    $('#newFolderTBody .folder-tr').addClass('active');
    $('#folderName').val('');
}

const showNewFolder = () => {
    $('#newFolderTBody').removeClass('d-none');
}

const hideNewFolder = () => {
    $('#newFolderTBody').addClass('d-none');
}

const showDeleteModal = () => {
    $('#folderDeleteModal').modal('show');
}

const hideDeleteModal = () => {
    $('#folderDeleteModal').modal('hide');
}

const handleDeleteFolder = () => {
    showLoading();
    deleteFolder(active_folder).then(res => {
        showSuccess();
        hideDeleteModal();
        getAllFolders().then(res => {
            renderTable(res.data);
        });
    }).catch(err => {
        showDanger();
    })
}
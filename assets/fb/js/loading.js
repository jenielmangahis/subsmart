const showLoading = () => {
    hideSuccess();
    hideDanger();
    $('#loadingContainer').show();
}

const hideLoading = () => {
    $('#loadingContainer').hide();
}

const showDanger = () => {
    hideSuccess();
    hideLoading();
    $('#dangerIndicator').show();
}

const hideDanger = () => {
    $('#dangerIndicator').hide();
}

const showSuccess = () => {
    hideLoading();
    hideDanger();
    $('#successIndicator').show();
    setTimeout(() => {
        hideSuccess();
    }, 2000);
}

const hideSuccess = () => {
    $('#successIndicator').hide();
}
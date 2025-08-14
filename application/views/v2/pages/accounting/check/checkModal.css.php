<style>
    input[type="checkbox"],
    .columnButtonRemover,
    .hiddenColumnBadges,
    table > tbody > tr {
        cursor: pointer;
    }

    .columnButtonRemover {
        color: #ff000094;
    }

    .modalExitButton {
        position: absolute;
        top: 25px;
        right: 35px;
    }

    .hiddenColumnSection {
        display: none;
    }

    .hiddenColumnBadges:hover {
        background: red !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #6a4a86 !important;
        font-weight: bold;
    }

    .btn-light {
        border-color: lightgray !important;
    }

    .navPillSepator {
        margin: 0 15px;
    }

    .highlightTextDisable {
        user-select: none !important;
    }

    .width0  { width: 0% !important; }
    .width10 { width: 10%; }
    .width20 { width: 20%; }
    .width25 { width: 25%; }
    .width40 { width: 40%; }

    .checkAddBankAccountBalance,
    .checkEditBankAccountBalance {
        max-width: 140px;
    }

    .checkAddViewPayeeInfo,
    .checkEditViewPayeeInfo {
        display: none;
    }

    .checkAddCategoryBillableRow,
    .checkAddCategoryTaxRow,
    .checkAddItemBillableRow,
    .checkAddItemTaxRow,
    .checkEditCategoryBillableRow,
    .checkEditCategoryTaxRow,
    .checkEditItemBillableRow,
    .checkEditItemTaxRow {
        width: 20px;
        height: 20px;
        vertical-align: middle;
    }

    #checkAddRecentTransactionsOffCanvas,
    #checkEditRecentTransactionsOffCanvas {
        width: 750px;
    }

    #checkAddCategoryDetails_panel,
    #checkAddItemDetails_panel,
    #checkEditCategoryDetails_panel,
    #checkEditItemDetails_panel {
        border: 1px solid darkgray;
    }

    #checkAddCategoryDetails_panel > .accordion-button,
    #checkAddItemDetails_panel > .accordion-button,
    #checkEditCategoryDetails_panel > .accordion-button,
    #checkEditItemDetails_panel > .accordion-button {
        letter-spacing: 1px;
    }

    .checkAddBadge, 
    .checkEditBadge {
        top: 5px;
        left: 375px;
        display: none;
    }

    .checkAddNotificationDot,
    .checkEditNotificationDot {
        display: none;
    }

    .checkAddModalContent,
    .checkEditModalContent {
        display: none;
    }
</style>
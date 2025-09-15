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

    .addCheckModalExitButton,
    .editCheckModalExitButton {
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
    .width3 { width: 3%; }
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

    .virtualCheckAddContainer,
    .virtualCheckEditContainer {
        background-color: #f9f9f9;
        border: 2px solid #000;
        border-radius: 10px;
        font-family: Arial, sans-serif;
        height: 360px;
        margin: auto;
        padding: 20px;
        position: relative;
        top: 5px;
        width: 1299px;
    }

    .virtualCheckAddSection,
    .virtualCheckEditSection {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .virtualCheckAddNumberSection,
    .virtualCheckEditNumberSection {
        right: 0;
    }

    .virtualPrintLaterSection {
        right: 70px;
        top: 55px;
    }

    .virtualCheckAddDateSection,
    .virtualCheckEditDateSection {
        right: 26px;
        top: 100px;
    }

    .virtualCheckAddPayeeSection,
    .virtualCheckEditPayeeSection {
        top: 150px;
    }

    .virtualCheckAddAmountSection,
    .virtualCheckEditAmountSection {
        right: 26px;
        top: 150px;
    }

    .virtualCheckAddWrittenAmountSection,
    .virtualCheckEditWrittenAmountSection {
        top: 200px;
    }

    .virtualCheckAddBankNameSection,
    .virtualCheckEditBankNameSection {
        top: 250px;
    }

    .virtualCheckAddCategoryNameSection,
    .virtualCheckEditCategoryNameSection {
        left: 290px;
        top: 250px;
        width: 170px;
    }

    .virtualCheckAddExpenseAccountSection,
    .virtualCheckEditExpenseAccountSection {
        left: 560px;
        top: 250px;
        width: 240px;
    }

    .virtualCheckAddMemoSection,
    .virtualCheckEditMemoSection {
        bottom: 20px;
    }

    .virtualTopSection {
        margin-top: -18px;
        position: absolute;
    }

    #virtualCheckAddDateInput,
    #virtualCheckEditDateInput {
        width: 180px;
    }

    #virtualCheckAddAmountInput,
    #virtualCheckEditAmountInput {
        width: 150px;
    }

    #virtualCheckAddMemoInput,
    #virtualCheckEditMemoInput {
        background: unset;
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0;
        width: 1010px;
    }

    #virtualCheckAddNumberInput,
    #virtualCheckEditNumberInput {
        width: 59%;
    }

    .virtualCheckAddPayeeSelect,
    .virtualCheckEditPayeeSelect {
        width: 925px;
    }

    .virtualCheckAddBankNameSelect,
    .virtualCheckAddCategorySelect,
    .virtualCheckAddExpenseAccountSelect,
    .virtualCheckEditBankNameSelect,
    .virtualCheckEditCategorySelect,
    .virtualCheckEditExpenseAccountSelect {
        width: 260px !important;
    }

    #virtualCheckAddWrittenText,
    #virtualCheckEditWrittenText {
        letter-spacing: 4px;
    }

    .recentAddCheckAll, 
    .recentAddEntryCheckbox,
    .recentEditCheckAll, 
    .recentEditEntryCheckbox {
        width: 16px;
        height: 16px;
    }
</style>
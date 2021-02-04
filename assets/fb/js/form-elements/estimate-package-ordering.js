class EstimatePackageOrdering extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options'];
        this.option_elements = this.getOptions();
        this.products = [];
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `${this.initTable()}
                                        <div class="text-left w-100">
                                        <button class="btn btn-sm form-btn d-inline" onclick="${this.addOption}" id="addBtn-2283 type="button">Add Another Package</button>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6 offset-md-6">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <input type="text" class="form-control col-4" placeholder="Adjustment">
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <input type="number" name="" id="" class="form-control">
                                                        <div class="input-group-append">
                                                            <select name="" id="" class="form-control">
                                                                <option value="percentage">%</option>
                                                                <option value="dollar">$</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 offset-sm-1 my-auto">
                                                    <span>0.00</span>
                                                </div>
                                                <hr class="col-12">
                                                <div class="col-4 my-auto">
                                                    <span>Markup</span>
                                                </div>                           
                                                <div class="col-5 my-auto">
                                                    <button class="btn btn-sm form-btn d-inline" onclick="${this.addOption}" id="markupBtn-${this.id}" type="button">Set Markup</button>
                                                </div>
                                                <div class="col-2 offset-sm-1 my-auto">
                                                    <span>0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }

    getProductSelect(){
        const index = this.products.length;
        return `<select name="${this.element_type}-${this.id}-product-${index}" id="${this.element_type}-${this.id}-product-${index}" class="form-control">
                    ${this.option_elements}
                </select>`
    }

    getOptions() {
        let product_options = '';
        products.forEach(product => {
            const product_option = `<option value="${product.id}">${product.title}</option>`
            product_options += product_option;
        });
        return product_options;
    }

    getLocationSelect() {
        return `<select name="" id="" class="form-control">
        <option value="1">location 1</option>
    </select>`
    }

    initTable(){
        return `<table class="table-sm table" id="${this.element_type}-${this.id}">
                    <thead style="background-color: lightgray">
                        <tr style="height: 50px">
                            <th class="font-weight-bold" style="width: 40%; text-overflow: ellipsis">${this.question ? this.question : ''}</th>
                            <th class="font-weight-bold" style="width: 20%">QTY</th>
                            <th class="font-weight-bold" style="width: 20%">Price</th>
                            <th class="font-weight-bold" style="width: 10%">Tax</th>
                            <th class="font-weight-bold" style="width: 10%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${this.generateNewEntry()}
                    </tbody>
                </table>`
    }

    generateNewEntry() {
        const index = this.products.length;
        return `<tr>
                    <td class="product-select-td">${this.getProductSelect()}</td>
                    <td class="product-qty-td"><input type="number" value="1" name="${this.element_type}-${this.id}-product-qty-${index}" id="${this.element_type}-${this.id}-product-qty-${index}" class="form-control"></td>
                    <td class="product-price-td text-right"><input type="number" value="1" name="${this.element_type}-${this.id}-product-qty-${index}" id="${this.element_type}-${this.id}-product-qty-${index}" class="form-control"></td>
                    <td class="product-total-td text-right"><span>0.00 (7.5%)</span></td>
                    <td class="product-stock-td">0.00</td>
                </tr>`
    }
}
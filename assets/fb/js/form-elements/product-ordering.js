class ProductOrdering extends FormElement {
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
                                        <button type="button" class="btn btn-primary btn-sm" product_id="${this.id}">Add Items</button>
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
                    <thead>
                        <tr style="height: 50px">
                            <th class="font-weight-bold" style="width: 40%; text-overflow: ellipsis">${this.question ? this.question : ''}</th>
                            <th class="font-weight-bold" style="width: 10%">QTY</th>
                            <th class="font-weight-bold" style="width: 10%">Price</th>
                            <th class="font-weight-bold" style="width: 10%">Total</th>
                            <th class="font-weight-bold" style="width: 30%">Stock</th>
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
                    <td class="product-price-td text-right"><span>$ ${products[0].price}</span></td>
                    <td class="product-total-td text-right"><span>$ ${products[0].price}</span></td>
                    <td class="product-stock-td">${this.getLocationSelect()}</td>
                </tr>`
    }
}
class ZoneList extends FormElement {
    constructor(obj, editable = false) {
        super(obj, editable);
        this.settingItems = ['question', 'options'];
    }

    getElement() {
        const element_controls = this.getElementControls();
        const element_container = this.getElementContainer();
        element_container.content += `<label class="element-label" for="${this.id}">${this.question ? this.question : ''} <span class="text-danger">${this.required ? '*' : ''}</span></label>`;
        element_container.content += `    <table class="table table-sm">
        <thead>
            <tr>
                <th class="text-center" style="width: 15%;">Entry/Exit</th>
                <th class="text-center" style="width: 15%;">Zn#</th>
                <th class="text-center" style="width: 15%;">Verified</th>
                <th class="text-center" style="width: 55%;">Location</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>1</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>2</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>3</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>4</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>5</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>6</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>7</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>8</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>9</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>10</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>11</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>12</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>13</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>14</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td>15</td>
                <td class="text-center">
                    <input class="form-check-input position-static mx-auto" type="checkbox">
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>`;
        return element_container.open + ' ' + element_container.content + ' ' + element_controls + ' ' + element_container.close;
    }
}
<?= $invoice_template; ?>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        // target first main element
        const $mainElement = document.querySelector(".main");
        $mainElement.setAttribute("id", "print-content");

        const $button = document.createElement("button");
        $button.innerHTML = `<i class="bx bx-fw bx-chart"></i> Print Invoice`;
        $button.classList.add("print-btn");

        const $buttonContainer = document.createElement("div");
        $buttonContainer.classList.add("main");
        $buttonContainer.classList.add("print-btn-container");
        $buttonContainer.prepend($button);

        // Add print button styles
        const buttonCSS = `
            .print-btn-container {
                display: flex;
                justify-content: flex-end;
            }

            .print-btn {
                border: 1px solid #d3d3d3;
                border-radius: 5px;
                padding: 0.5em 0.7em;
                background-color: transparent;
                font-size: 14px;
                font-weight: 700;
                cursor: pointer;
                border-color: rgba(106, 74, 134, 0.1);
                background-color: rgba(106, 74, 134, 0.5);
                color: #6a4a86;
            }

            @media print {
                a.payinvoice {
                    print-color-adjust: exact;
                    -webkit-print-color-adjust: exact;
                }
            }
        `;
        const $buttonStyle = document.createElement('style');
        $buttonStyle.appendChild(document.createTextNode(buttonCSS));
        document.getElementsByTagName('head')[0].appendChild($buttonStyle);

        $button.addEventListener("click", () => {
            const printContents = $mainElement.innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });

        const $container = document.querySelector(".container");
        $container.prepend($buttonContainer);
    });
</script>
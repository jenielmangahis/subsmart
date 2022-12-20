<?php
defined("BASEPATH") or exit("No direct script access allowed");

class TCPDFReport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("tcpdf_lib");
        $this->load->model('general_model');

    }

    public function index()
    {   

        $DATA = array(
            'table' => 'acs_profile',
            'select' => 'CONCAT(first_name  , " ", last_name) AS CUSTOMER, phone_h AS PHONE_NUMBER, email AS EMAIL, mail_add AS BILLING_ADDRESS, CONCAT(city, " ", state, " ", zip_code) AS SHIPPING_ADDRESS',
            'where' => array(
                'fk_user_id' => logged('id'),
                'company_id' => logged('company_id')
            )
        );
        $REQUEST_DATA = $this->general_model->get_data_with_param($DATA);

        $BUSINESS_NAME = $this->input->get('BUSINESS_NAME');
        $REPORT_NAME = $this->input->get('REPORT_NAME');
        $PAGE_ORIENTATION = $this->input->get('PAGE_ORIENTATION');
        $PAGE_HEADER_REPEAT = $this->input->get('PAGE_HEADER_REPEAT');

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);

        // set document information
        $pdf->setCreator(PDF_CREATOR);
        $pdf->setAuthor($BUSINESS_NAME);
        $pdf->setTitle($REPORT_NAME);
        $pdf->setSubject("Report");
        // $pdf->setKeywords("TCPDF, PDF, example, test, guide");

        // set default header data
        $pdf->setHeaderData(
            PDF_HEADER_LOGO,
            PDF_HEADER_LOGO_WIDTH,
            $BUSINESS_NAME,
            $REPORT_NAME."\nnSmarTrac",
            // [0, 64, 255],
            [0, 64, 100]
        );
        // $pdf->setFooterData([0, 64, 0], [0, 64, 128]);

        // set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA]);

        // set default monospaced font
        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . "/lang/eng.php")) {
            require_once dirname(__FILE__) . "/lang/eng.php";
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        // $pdf->setFont('helve', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        // PAGE ORIENTATION
        if ($PAGE_HEADER_REPEAT == "false") { 
            $pdf->setPrintHeader(true); 
            if ($PAGE_ORIENTATION == "LANDSCAPE") { $pdf->AddPage("L"); } else { $pdf->AddPage("P"); }
            $pdf->setPrintHeader(false); 
        } else { 
            $pdf->setPrintHeader(true); 
            if ($PAGE_ORIENTATION == "LANDSCAPE") { $pdf->AddPage("L"); } else { $pdf->AddPage("P"); }
        }

        // set text shadow effect
        $pdf->setTextShadow([
            "enabled" => true,
            "depth_w" => 0.2,
            "depth_h" => 0.2,
            "color" => [196, 196, 196],
            "opacity" => 1,
            "blend_mode" => "Normal",
        ]);

        // Set some content to print
        $html .= "
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Billing Address</th>
                    <th>Shipping Address</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($REQUEST_DATA as $DATA) {
           $html .= "
           <tr>
                    <td>$DATA->CUSTOMER</td>
                    <td>$DATA->PHONE_NUMBER</td>
                    <td>$DATA->EMAIL</td>
                    <td>$DATA->BILLING_ADDRESS</td>
                    <td>$DATA->SHIPPING_ADDRESS</td>
           </tr>";
        }
        $html .= "
            </tbody>
        </table>";


$html .= "
        <style>
            table {
                width: 100%;
            }
            table, th, td {
                border: solid 1px #DDD; 
                border-collapse: collapse; 
                padding: 3px 5px;
                text-align: left; 
            }
        </style>";
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, "", "", $html, 0, 1, 0, true, "", true);
        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output("$BUSINESS_NAME $REPORT_NAME.pdf", "I");
        //============================================================+
        // END OF FILE
        //============================================================+
    }
}

/* End of file Tcpdf.php */
/* Location: ./application/controllers/Tcpdf.php */
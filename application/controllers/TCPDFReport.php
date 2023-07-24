<?php
defined("BASEPATH") or exit("No direct script access allowed");

class TCPDFReport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("pdf_helper");
        $this->load->model('general_model');
        tcpdf();
    }

    public function index() {   
        // get user type id (Admin = 7)
        $GET_USERDATA_PAYLOAD = array(
            'table' => 'users',
            'select' => 'user_type',
            'where' => array( 'id' => logged('id') )
        );
        $USERDATA_RESULT = $this->general_model->get_data_with_param($GET_USERDATA_PAYLOAD)[0];
        $CURRENT_USERTYPE_ID = $USERDATA_RESULT->user_type;
        $CURRENT_USERID = logged('id');
        $CURRENT_COMPANYID = logged('company_id');
        $PAGE = $this->input->get('PAGE');
        $REPORT_TYPE = $this->input->get('REPORT_TYPE');
        $BUSINESS_NAME = $this->input->get('BUSINESS_NAME');
        $REPORT_NAME = $this->input->get('REPORT_NAME');
        $PAGE_ORIENTATION = $this->input->get('PAGE_ORIENTATION');
        $PAGE_HEADER_REPEAT = $this->input->get('PAGE_HEADER_REPEAT');

        // Check the page directory of the report
        // show error msg if incorrect
        if ($PAGE == "ACCOUNTING" ) {

            // Check if User is currently logged-in and user type is admin (7) 
            if ($CURRENT_USERID && $CURRENT_USERTYPE_ID == 7) {

                // create new PDF document
                // $orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "", true, "UTF-8", false);

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
                    $REPORT_NAME."\n".date('M d, Y'),
                    [0, 0, 0]
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
                $pdf->setFont('helvetica', '', 11, '', true);

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

                // Set some content to print
                // $header = "
                //     <table border='0' cellspacing='0' cellpadding='0' width='100%'>
                //         <tr>
                //             <td width='0%'></td>
                //             <td align='center' colspan='2'><h2>$BUSINESS_NAME</h2></td>
                //             <td width='0%'></td>
                //         </tr>
                //         <tr>
                //             <td width='0%'></td>
                //             <td align='center' colspan='2'><span>$REPORT_NAME</span></td>
                //             <td width='0%'></td>
                //         </tr>
                //         <tr>
                //             <td width='0%'></td>
                //             <td align='center' colspan='2'><span>[DATE_FIELD]</span></td>
                //             <td width='0%'></td>
                //         </tr>
                //     </table>
                // ";

                $html = "";
                $html .= "
                <table border='1' class='sales_tax_table'>
                    <thead>
                        <tr>
                            <th>Tax Name</th>
                            <th>Gross Total</th>
                            <th>Non-Taxable</th>
                            <th>Taxable Amount</th>
                            <th>Tax Amount</th>
                        </tr>
                    </thead>
                    <tbody>";
                // foreach ($REQUEST_DATA as $DATA) {
                $html .= "
                   <tr>
                        <td>Florida State</td>
                        <td>$220,170.57</td>
                        <td>$150,009.82</td>
                        <td>$70,160.75</td>
                        <td>$4,068.29</td>
                   </tr>";
                // }
                $html .= "
                    </tbody>
                </table>";


                $html .= "
                <style>
                    table {
                        width: 100%;
                    }
                    table, th{
                        border: solid 1px #BBB; 
                        border-collapse: collapse; 
                        padding: 3px 5px;
                        text-align: left; 
                    }
                    td {
                        border: solid 1px #BBB; 
                        font-size: 12px;
                    }
                    h2, span {
                        text-align: center;
                    }
                </style>";
                // Print text using writeHTMLCell()
                $pdf->writeHTMLCell(0, 0, "", "", $html, 0, 1, 0, true, "", true);
                // ---------------------------------------------------------
                // Center the content horizontally
                
                // $pdf->SetX(($pdf->getPageWidth() - $pdf->GetStringWidth('Your Report Title')) / 2);

                // Close and output PDF document
                // This method has several options, check the source code documentation for more information.
                $pdf->Output("$BUSINESS_NAME $REPORT_NAME.pdf", "I");
                //============================================================+
                // END OF FILE
                //============================================================+

            } else { die('Unable to get report details'); }

        } else { die('Unable to get report details'); }

    }
}

/* End of file Tcpdf.php */
/* Location: ./application/controllers/Tcpdf.php */
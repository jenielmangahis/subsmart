<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**


* CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Chris Harvey
 * @license         MIT License
 * @link            https://github.com/chrisnharvey/CodeIgniter-  PDF-Generator-Library



*/

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
// require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends DOMPDF
{
/**
 * Get an instance of CodeIgniter
 *
 * @access  protected
 * @return  void
 */
protected function ci()
{
    return get_instance();
}

/**
 * Load a CodeIgniter view into domPDF
 *
 * @access  public
 * @param   string  $view The view to load
 * @param   array   $data The view data
 * @return  void
 */
    public function load_view($view, $data = array(), $filename, $orientation)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf(array('enable_remote' => true));
        $html = $this->ci()->load->view($view, $data, true);

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename);
    }

    public function save_pdf($view, $data = array(), $filename, $orientation)
    {
        $dompdf = new Dompdf();
        $html = $this->ci()->load->view($view, $data, true);

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('Letter', $orientation);

        // Render the HTML as PDF
        $dompdf->render();
        $content = $dompdf->output(array("Attachment" => 0));
        
        // Output the generated PDF to Browser
        // $dompdf->stream($filename, array("Attachment" => false));
        file_put_contents(FCPATH.'/assets/pdf/'.$filename, $content);
    }

    function createPDF($html, $filename='', $download=FALSE, $paper='A4', $orientation='portrait'){
        
        // $options = $dompdf->getOptions(); 
        // $options->set('isRemoteEnabled', TRUE);
        // $dompdf->setOptions($options);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        // $dompdf = new Dompdf($options);
        
        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        // $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->render();
        ob_end_clean();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }

}
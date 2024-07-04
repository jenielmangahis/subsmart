<?php 

defined('BASEPATH') or exit('No direct script access allowed');

require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

	private $LogoURL = K_PATH_IMAGES.'logo_example.jpg';
	private $showLogo = false;
	private $headerRepeat = true;
	private $headerPosition = "C";
    private $businessName = '';
    private $reportName = '';
    private $reportDate = '';
    private $footerPosition = 'C';
    private $footerContent = '';

    public function setHeaderContent($LogoURL, $showLogo, $headerRepeat, $headerPosition, $businessName, $reportName, $reportDate) {
        $this->LogoURL = $LogoURL;
        $this->showLogo = $showLogo;
        $this->headerRepeat = $headerRepeat;
        $this->headerPosition = $headerPosition;
        $this->businessName = $businessName;
        $this->reportName = $reportName;
        $this->reportDate = $reportDate;
        $this->footerContent = $footerContent;
    }

    public function setFooterContent($footerPosition, $footerContent) {
        $this->footerPosition = $footerPosition;
        $this->footerContent = $footerContent;
    }

	public function Header() {
	    if ($this->headerRepeat == true) {
	    	if ($this->headerPosition == "L") {
	    		($this->showLogo == true) ? $leftMargin = 35 : '';
		        $this->Ln(3);
		        $this->setFont('helvetica', 'B', 16.5);
		        ($this->showLogo == true) ? $this->SetX($leftMargin) : '';
		        $this->Cell(0, 0, $this->businessName, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        $this->setFont('helvetica', 'N', 12.3);
		        $this->Ln(8);
		        ($this->showLogo == true) ? $this->SetX($leftMargin) : '';
		        $this->Cell(0, 0, $this->reportName, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        $this->setFont('helvetica', 'N', 12.3);
		        $this->Ln(6);
		        ($this->showLogo == true) ? $this->SetX($leftMargin) : '';
		        $this->Cell(0, 0, $this->reportDate, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        ($this->showLogo == true) ? $this->Image($this->LogoURL, 10, 8, 20, '', '', '', 'T', true, 500, '', false, false, 0, false, false, false) : '';
	    	} 
	    	
	    	if ($this->headerPosition == "C") {
		        $this->Ln(3);
		        $this->setFont('helvetica', 'B', 16.5);
		        $this->Cell(0, 0, $this->businessName, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        $this->setFont('helvetica', 'N', 12.3);
		        $this->Ln(8);
		        $this->Cell(0, 0, $this->reportName, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        $this->setFont('helvetica', 'N', 12.3);
		        $this->Ln(6);
		        $this->Cell(0, 0, $this->reportDate, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        ($this->showLogo == true) ? $this->Image($this->LogoURL, 10, 8, 20, '', '', '', 'T', true, 500, '', false, false, 0, false, false, false) : '';
	    	}
			
			if ($this->headerPosition == "R") {
				$this->Ln(3);
		        $this->setFont('helvetica', 'B', 16.5);
		        $this->Cell(0, 0, $this->businessName, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        $this->setFont('helvetica', 'N', 12.3);
		        $this->Ln(8);
		        $this->Cell(0, 0, $this->reportName, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        $this->setFont('helvetica', 'N', 12.3);
		        $this->Ln(6);
		        $this->Cell(0, 0, $this->reportDate, 0, false, $this->headerPosition, 0, '', 0, false, '', 'M');
		        ($this->showLogo == true) ? $this->Image($this->LogoURL, 10, 8, 20, '', '', '', 'T', true, 500, '', false, false, 0, false, false, false) : '';
			} 
	    }

		if ($this->page == 1) {
			if ($this->headerRepeat == false) {
				$this->Image($this->LogoURL, 10, 8, 20, '', '', '', 'T', true, 500, '', false, false, 0, false, false, false);
			}
		}
	}

	public function Footer() {
	    $this->setY(-15);
	    $this->setFont('helvetica', 'N', 10);
	    $this->Cell(0, 10, $this->footerContent, 0, false, $this->footerPosition, 0, '', 0, false, '', 'M');
	}
}


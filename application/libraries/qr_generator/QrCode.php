<?php
namespace Qr;
include "qrlib.php";  
class QrCode{

	public $filename; 
	public $errorCorrectionLevel;
	public $matrixPointSize;
	public $qr_data;
	public $qr_email;
	public $qr_business_card = array();
	public $qr_wifi = array();
	public $url;
	public $title;
	public $phone;
	public $text_msg;
	
	const QR_FORMAT_EMAIL = 'Email';
	const QR_FORMAT_BUSINESS_CARD = 'Business Card';
	const QR_FORMAT_OTHER = 'Other';
	const QR_FORMAT_WIFI = 'Wifi';
	const QR_FORMAT_BOOKMARK = 'Bookmark';
	const QR_FORMAT_SMS = 'Sms';
	
	public $max_size = 4;

	public function generateQR() {	
		\QRcode::png($this->qr_data, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $this->qr_data;
	}

	public function generateQREmail() {
		$email = 'mailto:' . $this->qr_email;
		\QRcode::png($email, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $email;
	}

	public function generateQRSms() {
		$sms = "SMSTO:" . $this->phone . ":" . $this->text_msg;
		\QRcode::png($sms, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $sms;
	}

	public function generateQRBookmark() {
		$content = "MEBKM:TITLE:" . $this->title . ";URL:" . $this->url . ";;";
		\QRcode::png($content, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $content;
	}

	public function generateQRWifi() {
		$wifi = 'WIFI:T:' . $this->qr_wifi['network_type'] . ';S:' . $this->qr_wifi['ssid'] . ';P:' . $this->qr_wifi['password'] . ";;";
		\QRcode::png($wifi, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $wifi;
	}

	public function generateQRBusinessCard() {
		$avatarJpegFileName = "small-logo2.jpg"; 
		$codeContents  = 'BEGIN:VCARD'."\n";
	    $codeContents .= 'VERSION:2.1'."\n";	    
	    $codeContents .= 'FN:'.$this->qr_business_card['name']."\n";
	    $codeContents .= 'ORG:'.$this->qr_business_card['company_name']."\n";	    
	    $codeContents .= 'TEL;WORK;VOICE:'.$this->qr_business_card['office_number']."\n";
	    $codeContents .= 'TEL;FAX;VOICE:'.$this->qr_business_card['fax_number']."\n";	 
	    $codeContents .= 'EMAIL:'.$this->qr_business_card['email']."\n"; 
	    $codeContents .= 'PHOTO;JPEG;ENCODING=BASE64:'.base64_encode(file_get_contents("../" . $avatarJpegFileName))."\n"; 
	    $codeContents .= 'END:VCARD'; 	    

		\QRcode::png($codeContents, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $codeContents;
	}

	public function generateQRPhone() {
		$phone = 'tel:' . $this->qr_data;
		\QRcode::png($email, $this->filename, $this->errorCorrectionLevel, $this->matrixPointSize, 2);    	
		return $phone;
	}

	public function setFileName( $value ) {
		$this->filename = $value;
	}

	public function setQrData( $value ){
		$this->qr_data = $value;
	}

	public function setQREmail( $value ){
		$this->qr_email = $value;
	}

	public function setPhone( $value ){
		$this->phone = $value;
	}

	public function setTextMsg( $value ){
		$this->text_msg = $value;
	}

	public function setUrl( $value ){
		$this->url = $value;
	}

	public function setTitle( $value ) {
		$this->title = $value;
	}

	public function setQrWifiInfos( $values = array() ){
		$this->qr_wifi = $values;
	}

	public function setQRBusinessCardInfos( $values = array() ){
		$this->qr_business_card = $values;
	}

	public function setErrorCorrectionLevel( $value ) {
		$this->errorCorrectionLevel = $value;
	}

	public function setMatrixPointSize( $value ){
		$this->matrixPointSize = $value;
	}

	public function getQRECCOptions() {
		$options = [
			'L' => 'L - Smallest',
			'M' => 'M',
			'Q' => 'Q',
			'H' => 'H - Best'
		];

		return $options;
	}

	public function getQrFormatOptions() {
		$options = [
			self::QR_FORMAT_EMAIL => self::QR_FORMAT_EMAIL,
			self::QR_FORMAT_BUSINESS_CARD => self::QR_FORMAT_BUSINESS_CARD,
			self::QR_FORMAT_OTHER => self::QR_FORMAT_OTHER,
			self::QR_FORMAT_WIFI => self::QR_FORMAT_WIFI,
			self::QR_FORMAT_BOOKMARK => self::QR_FORMAT_BOOKMARK,
			self::QR_FORMAT_SMS => self::QR_FORMAT_SMS
		];

		return $options;
	}

	public function isFormatSms( $value ) {
		$return = false;
		if( $value == self::QR_FORMAT_SMS ){
			$return = true;
		}

		return $return;
	}

	public function isFormatBookmark( $value ) {
		$return = false;
		if( $value == self::QR_FORMAT_BOOKMARK ){
			$return = true;
		}

		return $return;
	}	

	public function isFormatEmail( $value ) {
		$return = false;
		if( $value == self::QR_FORMAT_EMAIL ){
			$return = true;
		}

		return $return;
	}

	public function isFormatBusinessCard( $value ) {
		$return = false;
		if( $value == self::QR_FORMAT_BUSINESS_CARD ){
			$return = true;
		}

		return $return;
	}

	public function isFormatWifi( $value ) {
		$return = false;
		if( $value == self::QR_FORMAT_WIFI ){
			$return = true;
		}

		return $return;
	}

	public function isFormatOther( $value ) {
		$return = false;
		if( $value == self::QR_FORMAT_OTHER ){
			$return = true;
		}

		return $return;
	}

	public function getMaxSize() {
		return $this->max_size;
	}

	public function getWifiNetworkTypeOptions() {
		$options = [
			'WEP' => 'WEP',
			'WPA/WPA2' => 'WPA/WPA2',
			'No encryption' => 'No encryption'
		];

		return $options;
	}
}


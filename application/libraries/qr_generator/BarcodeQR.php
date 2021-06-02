<?php
namespace Qr;
use Cake\Filesystem\File;
/**
 * BarcodeQR - Code QR Barcode Image Generator (PNG)
 *
 * @package BarcodeQR
 * @category BarcodeQR
 * @name BarcodeQR
 * @version 1.0
 * @author Shay Anderson 05.11
 * @link http://www.shayanderson.com/php/php-qr-code-generator-class.htm
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * This is free software and is distributed WITHOUT ANY WARRANTY
 */
final class BarcodeQR {
	/**
	 * Chart API URL
	 */
	const API_CHART_URL = "http://chart.apis.google.com/chart";

	const QR_FORMAT_EMAIL = 'Email';
	const QR_FORMAT_BUSINESS_CARD = 'Business Card';
	const QR_FORMAT_OTHER = 'Other';
	const QR_FORMAT_WIFI = 'Wifi';
	const QR_FORMAT_BOOKMARK = 'Bookmark';
	const QR_FORMAT_SMS = 'Sms';

	/**
	 * Code data
	 *
	 * @var string $_data
	 */
	private $_data;

	/**
	 * Bookmark code
	 *
	 * @param string $title
	 * @param string $url
	 */
	public function bookmark($title = null, $url = null) {
		$this->_data = "MEBKM:TITLE:{$title};URL:{$url};;";
	}

	/**
	 * MECARD code
	 *
	 * @param string $name
	 * @param string $address
	 * @param string $phone
	 * @param string $email
	 */
	public function contact($name = null, $address = null, $phone = null, $email = null) {
		$this->_data = "MECARD:N:{$name};ADR:{$address};TEL:{$phone};EMAIL:{$email};;";
	}

	/**
	 * Create code with GIF, JPG, etc.
	 *
	 * @param string $type
	 * @param string $size
	 * @param string $content
	 */
	public function content($type = null, $size = null, $content = null) {
		$this->_data = "CNTS:TYPE:{$type};LNG:{$size};BODY:{$content};;";
	}

	public function setData( $value ){
		$this->_data = $value;
	}

	/**
	 * Generate QR code image
	 *
	 * @param int $size
	 * @param string $filename
	 * @return bool
	 */
	public function draw($size = 150, $filename = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_CHART_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$img = curl_exec($ch);
		//debug($img);exit;
		curl_close($ch);

		if($img) {
			if($filename) {
				if(!preg_match("#\.png$#i", $filename)) {
					$filename .= ".png";
				}				
				$directory_name = WWW_ROOT . '/upload/qr_c/';      				
               
                //Store image to local upload folder
                $file = new File($directory_name . $filename, true);
                $file->write($img);                

				return $this->_data;
			} else {				
				header("Content-type: image/png");
				debug($img);exit;
				print $img;
				return true;
			}
		}

		return false;
	}

	/**
	 * Email address code
	 *
	 * @param string $email
	 * @param string $subject
	 * @param string $message
	 */
	public function email($email = null, $subject = null, $message = null) {
		$this->_data = "MATMSG:TO:{$email};SUB:{$subject};BODY:{$message};;";
	}

	/**
	 * Geo location code
	 *
	 * @param string $lat
	 * @param string $lon
	 * @param string $height
	 */
	public function geo($lat = null, $lon = null, $height = null) {
		$this->_data = "GEO:{$lat},{$lon},{$height}";
	}

	/**
	 * Telephone number code
	 *
	 * @param string $phone
	 */
	public function phone($phone = null) {
		$this->_data = "TEL:{$phone}";
	}

	/**
	 * SMS code
	 *
	 * @param string $phone
	 * @param string $text
	 */
	public function sms($phone = null, $text = null) {
		$this->_data = "SMSTO:{$phone}:{$text}";
	}

	/**
	 * Text code
	 *
	 * @param string $text
	 */
	public function text($text = null) {
		$this->_data = $text;
	}

	/**
	 * URL code
	 *
	 * @param string $url
	 */
	public function url($url = null) {
		$this->_data = preg_match("#^https?\:\/\/#", $url) ? $url : "http://{$url}";
	}

	/**
	 * Wifi code
	 *
	 * @param string $type
	 * @param string $ssid
	 * @param string $password
	 */
	public function wifi($type = null, $ssid = null, $password = null) {
		$this->_data = "WIFI:S:{$ssid};T:{$type};P:{$password};;";
	}

	/**
	 * QR Format
	 *
	 * @return array $options
	 *
	*/

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

	public function getWifiNetworkTypeOptions() {
		$options = [
			'WEP' => 'WEP',
			'WPA/WPA2' => 'WPA/WPA2',
			'No encryption' => 'No encryption'
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

	public function optionQRSizes() {
		$sizes = [			
			'80' => '80x80',
			'100' => '100x100',
			'150' => '150x150',
			'300' => '300x300',
			'450' => '450x450',		
		];

		return $sizes;
	}
}
?>
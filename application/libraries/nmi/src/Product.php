<?php

/*
 * This software contains Creditcall CardEase Software (CCS) (c) Creditcall
 * Ltd 2005 - 2021.  The CCS may not be decompiled, disassembled
 * or reverse engineered other than as permitted by statutory law.  The CCS
 * may not, other than as part of this software, be resold, leased, licensed
 * or sub-licensed.  The CCS may not, other than as part of the this software,
 * be used for anything other than your internal business purposes.
 */

/**
 * A class used to hold product information.
 *
 * @author Creditcall Ltd
 */
class Product {

	/**
	 * The price of the product.
	 * @private
	 */
	var $m_amount = null;

	/**
	 * The unit of the product price.
	 * @private
	 */
	var $m_amountUnit = AmountUnit_Minor;

	/**
	 * The category of the product.
	 * @private
	 */
	var $m_category = null;

	/**
	 * The code of the product.
	 * @private
	 */
	var $m_code = null;

	/**
	 * The currency of the price.
	 * @private
	 */
	var $m_currencyCode = null;

	/**
	 * The description of the product.
	 * @private
	 */
	var $m_description = null;

	/**
	 * The name of the product.
	 * @private
	 */
	var $m_name = null;

	/**
	 * The quantity of the product.
	 * @private
	 */
	var $m_quantity = null;

	/**
	 * The risk of the product.
	 * @private
	 */
	var $m_risk = ProductRisk_Medium;

	/**
	 * The type of the product.
	 * @private
	 */
	var $m_type = null;

	/**
	 * Creates a new product with the fields.
	 *
	 * @param amount The price of the product.
	 * @param amountUnit The unit of the product price.
	 * @param category The category of the product.
	 * @param code The code of the product.
	 * @param currencyCode The currency of the price.
	 * @param description The description of the product.
	 * @param name The name of the product.
	 * @param quantity The quantity of the product.
	 * @param risk The risk of the product.
	 * @param type The type of the product.
	 */
	function Product(
		$amount,
		$amountUnit,
		$category,
		$code,
		$currencyCode,
		$description,
		$name,
		$quantity,
		$risk,
		$type) {
		$this->m_amount = $amount;
		$this->m_amountUnit = $amountUnit;
		$this->m_category = $category;
		$this->m_code = $code;
		$this->m_currencyCode = $currencyCode;
		$this->m_description = $description;
		$this->m_name = $name;
		$this->m_quantity = $quantity;
		$this->m_risk = $risk;
		$this->m_type = $type;
	}

	/**
	 * Gets the price of the product.
	 * If null it is not set.
	 * @return string The price of the product.
	 * @see setAmount()
	 */
	function getAmount() {
		return $this->m_amount;
	}

	/**
	 * Gets the unit of the product price.
	 * If null it is not set.
	 * @return string The unit of the product price.
	 * @see setAmountUnit()
	 */
	function getAmountUnit() {
		return $this->m_amountUnit;
	}

	/**
	 * Gets the category of the product.
	 * If null it is not set.
	 * @return string The category of the product.
	 * @see setCategory()
	 */
	function getCategory() {
		return $this->m_category;
	}

	/**
	 * Gets the code of the product.
	 * If null it is not set.
	 * @return string The code of the product.
	 * @see setCode()
	 */
	function getCode() {
		return $this->m_code;
	}

	/**
	 * Gets the currency of the price.
	 * If null it is not set.
	 * @return string The currency of the price.
	 * @see setCurrencyCode()
	 */
	function getCurrencyCode() {
		return $this->m_currencyCode;
	}

	/**
	 * Gets the description of the product.
	 * If null it is not set.
	 * @return string The description of the product.
	 * @see setDescription()
	 */
	function getDescription() {
		return $this->m_description;
	}

	/**
	 * Gets the name of the product.
	 * If null it is not set.
	 * @return string The name of the product.
	 * @see setName()
	 */
	function getName() {
		return $this->m_name;
	}

	/**
	 * Gets the quantity of the product.
	 * If null it is not set.
	 * @return string The quantity of the product.
	 * @see setQuantity()
	 */
	function getQuantity() {
		return $this->m_quantity;
	}

	/**
	 * Gets the risk of the product.
	 * If null it is not set.
	 * @return string The risk of the product.
	 * @see setRisk()
	 */
	function getRisk() {
		return $this->m_risk;
	}

	/**
	 * Gets the type of the product.
	 * If null it is not set.
	 * @return string The type of the product.
	 * @see setType()
	 */
	function getType() {
		return $this->m_type;
	}

	/**
	 * Sets the price of the product.
	 * @param amount The price of the product.  If null it is removed.
	 * @see getAmount()
	 */
	function setAmount($amount) {
		$this->m_amount = $amount;
	}

	/**
	 * Sets the unit of the product price.
	 * @param amountUnit The unit of the product price.  If null it is removed.
	 * @see getAmountUnit()
	 */
	function setAmountUnit($amountUnit) {
		$this->m_amountUnit = $amountUnit;
	}

	/**
	 * Sets the category of the product.
	 * @param category The category of the product.  If null it is removed.
	 * @see getCategory()
	 */
	function setCategory($category) {
		$this->m_category = $category;
	}

	/**
	 * Sets the code of the product.
	 * @param code The code of the product.  If null it is removed.
	 * @see getCode()
	 */
	function setCode($code) {
		$this->m_code = $code;
	}

	/**
	 * Sets the currency of the price.
	 * @param currencyCode The currency of the price.  If null it is removed.
	 * @see getCurrencyCode()
	 */
	function setCurrencyCode($currencyCode) {
		$this->m_currencyCode = $currencyCode;
	}

	/**
	 * Sets the description of the product.
	 * @param description The description of the product.  If null it is removed.
	 * @see getDescription()
	 */
	function setDescription($description) {
		$this->m_description = $description;
	}

	/**
	 * Sets the name of the product.
	 * @param name The name of the product.  If null it is removed.
	 * @see getName()
	 */
	function setName($name) {
		$this->m_name = $name;
	}

	/**
	 * Sets the quantity of the product.
	 * @param quantity The quantity of the product.  If null it is removed.
	 * @see getQuantity()
	 */
	function setQuantity($quantity) {
		$this->m_quantity = $quantity;
	}

	/**
	 * Sets the risk of the product.
	 * @param risk The risk of the product.  If null it is removed.
	 * @see getRisk()
	 */
	function setRisk($risk) {
		$this->m_risk = $risk;
	}

	/**
	 * Sets the type of the product.
	 * @param type The type of the product.  If null it is removed.
	 * @see getType()
	 */
	function setType($type) {
		$this->m_type = $type;
	}

	/**
	 * Returns a string detailing the values of the product.
	 * @return string A string detailing the values of the product.
	 */
	function toString() {

		$str = '';
        $str .= htmlentities($this->m_amount, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_amountUnit, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_category, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_code, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_currencyCode, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_description, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_name, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_quantity, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_risk, ENT_QUOTES);
        $str .= ':';
        $str .= htmlentities($this->m_type, ENT_QUOTES);

        return $str;
	}
}

?>

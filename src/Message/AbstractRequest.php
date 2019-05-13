<?php
namespace Omnipay\EPay\Message;

/*
 * Class AbstractRequest
 * @package Omnipay\EPay\Message
 */

use Omnipay\Common\Message\ResponseInterface;
use SoapClient;

class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
	protected const Endpoint_Base			= 'https://ssl.ditonlinebetalingssystem.dk/';
	protected const Endpoint_API			= 'remote/payment.asmx?WSDL';

	protected $strOperation					= '';

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData()
	{
		return [
			'merchantnumber'	=> $this->getMerchantNumber(),
			'amount'			=> $this->getAmountInteger()
		];
	}

	/**
	 * Send the request with specified data
	 *
	 * @param mixed $data The data to send
	 * @return ResponseInterface
	 * @throws \SoapFault
	 */
	public function sendData($data): ResponseInterface
	{
		$strUrl		= self::Endpoint_Base.self::Endpoint_API;
		$oClient	= new SoapClient($strUrl);

		$oClient->__soapCall($this->strOperation, [$data]);
	}

	public function send()
	{
		$arrData	= $this->getData();
		$this->sendData($arrData);
	}

	/**
	 * @return int
	 */
	public function getMerchantNumber(): ?int
	{
		return $this->getParameter('merchant_number');
	}

	/**
	 * @param int $iMerchantNumber
	 */
	public function setMerchantNumber(int $iMerchantNumber): void
	{
		$this->setParameter('merchant_number', $iMerchantNumber);
	}

	/**
	 * @return string|null
	 */
	public function getPwd(): ?string
	{
		return $this->getParameter('pwd');
	}

	/**
	 * @param string $strPwd
	 */
	public function setPwd(string $strPwd): void
	{
		$this->setParameter('pwd', $strPwd);
	}
}
<?php
namespace Omnipay\EPay\Message;

use Omnipay\Common\Message\ResponseInterface;

/*
 * Class AbstractRequest
 * @package Omnipay\EPay\Message
 */
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
			'merchantnumber'	=> $this->getMerchantnumber(),
			'amount'			=> $this->getAmountInteger()
		];
	}

	/**
	 * Send the request with specified data
	 *
	 * @param mixed $data The data to send
	 * @return ResponseInterface
	 */
	public function sendData($data): ResponseInterface
	{
		parent::sendData($data);
	}

	public function send(): ResponseInterface
	{
		$arrData	= $this->getData();
		return $this->sendData($arrData);
	}

	/**
	 * @return int
	 */
	public function getMerchantnumber(): ?int
	{
		return $this->getParameter('merchantnumber');
	}

	/**
	 * @param int $iMerchantNumber
	 */
	public function setMerchantnumber(int $iMerchantNumber): void
	{
		$this->setParameter('merchantnumber', $iMerchantNumber);
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

	public function getCallbackurl(): ?string
	{
		return $this->getParameter('callbackurl');
	}

	public function setCallbackurl(string $strCallbackUrl): void
	{
		$this->setParameter('callbackurl', $strCallbackUrl);
	}

	public function getSecret(): ?string
	{
		return $this->parameters->get('secret');
	}

	public function setSecret(string $strSecret): void
	{
		$this->setParameter('secret', $strSecret);
	}

	public function setHash(): void
	{
		if($this->parameters->has('secret'))
		{
			$strSecret	= $this->getParameter('secret');
			$this->parameters->remove('secret');

			$strHash	= md5(implode('', $this->parameters->all()).$strSecret);
			$this->parameters->set('hash', $strHash);
		}
	}

	public function getDefaultParams(): array
	{
		return [
			'merchantnumber'	=> '',
			'secret'			=> '',
			'language'			=> 0,
			'windowstate'		=> 3,
			'paymentcollection'	=> 1
		];
	}

	public function setLanguage(int $iLanguage): void
	{
		$this->setParameter('language', $iLanguage);
	}

	public function getLanguage(): int
	{
		return $this->getParameter('language');
	}

	public function setPaymentCollection(int $iPaymentCollectionOption): void
	{
		$this->setParameter('paymentcollection', $iPaymentCollectionOption);
	}

	public function getPaymentCollection(): int
	{
		return $this->getParameter('paymentcollection');
	}

	public function getAmount(): int
	{
		return $this->getAmountInteger();
	}

	public function setInstantcallback(bool $bIsInstantcallback): void
	{
		$this->setParameter('instantcallback', $bIsInstantcallback);
	}

	public function getInstantcallback(): bool
	{
		return $this->getParameter('instantcallback');
	}
}
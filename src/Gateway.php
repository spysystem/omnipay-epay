<?php
namespace Omnipay\EPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\BadMethodCallException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\EPay\Message\CaptureRequest;
use Omnipay\EPay\Message\LinkRequest;
use Omnipay\EPay\Message\RefundRequest;
use Omnipay\EPay\Message\VoidRequest;

/**
 * class Gateway
 * @package Omnipay\Epay
 */
class Gateway extends AbstractGateway
{

	/**
	 * Get gateway display name
	 *
	 * This can be used by carts to get the display name for each gateway.
	 * @return string
	 */
	public function getName(): string
	{
		return 'ePay';
	}

	public function authorize(array $arrParams)
	{
		throw new BadMethodCallException('Method authorize() is not implemented as it is handled at the vendor gateway.');
	}

	public function supportsAuthorize(): bool
	{
		return false;
	}

	/**
	 * @param array $arrParams
	 * @return AbstractRequest|RequestInterface
	 */
	public function capture(array $arrParams)
	{
		return $this->createRequest(CaptureRequest::class, $arrParams);
	}

	/**
	 * @param array $arrParams
	 * @return AbstractRequest
	 */
	public function link(array $arrParams): AbstractRequest
	{
		return $this->createRequest(LinkRequest::class, $arrParams);
	}

	public function refund(array $arrParams)
	{
		return $this->createRequest(RefundRequest::class, $arrParams);
	}

	/**
	 * @param array $arrParams
	 * @return AbstractRequest|RequestInterface
	 */
	public function void(array $arrParams)
	{
		return $this->createRequest(VoidRequest::class, $arrParams);
	}

	public function createCard()
	{
		throw new BadMethodCallException('This Gateway does not support the function createCard().');
	}

	public function supportsCreateCard(): bool
	{
		return false;
	}

	public function updateCard()
	{
		throw new BadMethodCallException('This Gateway does not support the function updateCard()');
	}

	public function supportsUpdateCard(): bool
	{
		return false;
	}

	public function deleteCard()
	{
		throw new BadMethodCallException('This Gateway does not support the function deleteCard()');
	}

	public function supportsDeleteCard(): bool
	{
		return false;
	}

	public function fetchTransaction()
	{
		throw new BadMethodCallException('This Gateway does not support the function fetchTransaction()');
	}

	public function supportsFetchTransaction(): bool
	{
		return false;
	}

	public function acceptNotification()
	{
		throw new BadMethodCallException('This Gateway does not support the function acceptNotification()');
	}

	public function supportsAcceptNotification(): bool
	{
		return false;
	}

	public function completeAuthorize()
	{
		throw new BadMethodCallException('This Gateway does not support the function completeAuthorize()');
	}

	public function supportsCompleteAuthorize(): bool
	{
		return false;
	}

	public function purchase()
	{
		throw new BadMethodCallException('This Gateway does not support the function purchase()');
	}

	public function supportsPurchase(): bool
	{
		return false;
	}

	public function completePurchase()
	{
		throw new BadMethodCallException('This Gateway does not support the function completePurchase()');
	}

	public function supportsCompletePurchase(): bool
	{
		return false;
	}
}
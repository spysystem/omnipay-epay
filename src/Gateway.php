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

	/**
	 * @param array $arrParams
	 * @return RequestInterface|void
	 */
	public function authorize(array $arrParams): void
	{
		throw new BadMethodCallException('Method authorize() is not implemented as it is handled at the vendor gateway.');
	}

	/**
	 * @return bool
	 */
	public function supportsAuthorize(): bool
	{
		return false;
	}

	/**
	 * @param array $arrParams
	 * @return CaptureRequest|RequestInterface
	 */
	public function capture(array $arrParams): CaptureRequest
	{
		return $this->createRequest(CaptureRequest::class, $arrParams);
	}

	/**
	 * @param array $arrParams
	 * @return LinkRequest|RequestInterface
	 */
	public function link(array $arrParams): LinkRequest
	{
		return $this->createRequest(LinkRequest::class, $arrParams);
	}

	/**
	 * @param array $arrParams
	 * @return RefundRequest|RequestInterface
	 */
	public function refund(array $arrParams): RefundRequest
	{
		return $this->createRequest(RefundRequest::class, $arrParams);
	}

	/**
	 * @param array $arrParams
	 * @return VoidRequest|RequestInterface
	 */
	public function void(array $arrParams): VoidRequest
	{
		return $this->createRequest(VoidRequest::class, $arrParams);
	}

	/**
	 * @return RequestInterface|void
	 */
	public function createCard(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function createCard().');
	}

	/**
	 * @return bool
	 */
	public function supportsCreateCard(): bool
	{
		return false;
	}

	/**
	 * @return RequestInterface|void
	 */
	public function updateCard(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function updateCard()');
	}

	/**
	 * @return bool
	 */
	public function supportsUpdateCard(): bool
	{
		return false;
	}

	/**
	 * @return RequestInterface|void
	 */
	public function deleteCard(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function deleteCard()');
	}

	/**
	 * @return bool
	 */
	public function supportsDeleteCard(): bool
	{
		return false;
	}

	/**
	 * @return RequestInterface|void
	 */
	public function fetchTransaction(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function fetchTransaction()');
	}

	/**
	 * @return bool
	 */
	public function supportsFetchTransaction(): bool
	{
		return false;
	}

	/**
	 * @return NotificationInterface|void
	 */
	public function acceptNotification(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function acceptNotification()');
	}

	/**
	 * @return bool
	 */
	public function supportsAcceptNotification(): bool
	{
		return false;
	}

	/**
	 * @return RequestInterface|void
	 */
	public function completeAuthorize(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function completeAuthorize()');
	}

	/**
	 * @return bool
	 */
	public function supportsCompleteAuthorize(): bool
	{
		return false;
	}

	/**
	 * @return RequestInterface|void
	 */
	public function purchase(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function purchase()');
	}

	/**
	 * @return bool
	 */
	public function supportsPurchase(): bool
	{
		return false;
	}

	/**
	 * @return RequestInterface|void
	 */
	public function completePurchase(): void
	{
		throw new BadMethodCallException('This Gateway does not support the function completePurchase()');
	}

	/**
	 * @return bool
	 */
	public function supportsCompletePurchase(): bool
	{
		return false;
	}
}
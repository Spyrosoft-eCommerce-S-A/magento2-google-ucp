<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Service\Payment\Handler;

use Magento\Framework\UrlInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\Data\PaymentInterface;
use Magento\Quote\Api\Data\PaymentInterfaceFactory;
use Magento\Quote\Api\PaymentMethodManagementInterface;
use Magento\QuoteGraphQl\Model\Cart\Payment\AdditionalDataProviderPool;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use PayPro\Przelewy24\Gateway\Config\CommonConfig;
use PayPro\Przelewy24\Gateway\Config\GooglePayConfig;
use PayPro\Przelewy24\Model\GooglePay\RegisterGooglePayTransaction;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterface;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\HandlerInterfaceFactory;
use Spyrosoft\Ucp\Api\Data\Checkout\Payment\InstrumentInterface;
use Spyrosoft\Ucp\Service\Payment\HandlerProviderInterface;

class P24GooglePay implements HandlerProviderInterface
{
    private const HANDLER_ID = 'przelewy24_google_pay';

    public function __construct(
        private readonly HandlerInterfaceFactory $handlerFactory,
        private readonly GooglePayConfig $googlePayConfig,
        private readonly CommonConfig $commonConfig,
        private readonly PaymentInterfaceFactory $paymentFactory,
        private readonly AdditionalDataProviderPool $paymentDataProvider,
        private readonly PaymentMethodManagementInterface $paymentMethodManagement,
        private readonly RegisterGooglePayTransaction $registerGooglePayTransaction,
        private readonly StoreManagerInterface $storeManager
    ) {
    }

    public function getHandler(): ?HandlerInterface
    {
        if (!$this->googlePayConfig->isActive()) {
            return null;
        }

        /** @var HandlerInterface $handler */
        $handler = $this->handlerFactory->create();
        $handler->setId(self::HANDLER_ID);
        $handler->setName('com.google.pay');
        $handler->setVersion('2026-01-11');
        $handler->setSpec('https://pay.google.com/gp/p/ucp/2026-01-11/');
        $handler->setConfigSchema('https://pay.google.com/gp/p/ucp/2026-01-11/schemas/config.json');
        $handler->setInstrumentSchemas([
            'https://pay.google.com/gp/p/ucp/2026-01-11/schemas/card_payment_instrument.json',
        ]);
        $handler->setConfig([
            'api_version' => 2,
            'api_version_minor' => 0,
            'environment' => $this->commonConfig->isTestMode()
                ? GooglePayConfig::TEST_MODE
                : GooglePayConfig::PRODUCTION_MODE,
            'merchant_info' => [
                'merchant_id' => $this->googlePayConfig->getMerchantId(),
                'merchant_name' => $this->commonConfig->getMerchantName(),
                'merchant_origin' => $this->getMerchantOrigin()
            ],
            'allowed_payment_methods' => [
                [
                    'type' => 'CARD',
                    'parameters' => [
                        'allowed_auth_methods' => $this->googlePayConfig->getAuthMethods(),
                        'allowed_card_networks' => $this->googlePayConfig->getCardNetworks(),
                    ],
                    'tokenization_specification' => [
                        'type' => 'PAYMENT_GATEWAY',
                        'parameters' => [
                            'gateway' => 'przelewy24',
                            'gatewayMerchantId' => $this->googlePayConfig->getMerchantId()
                        ]
                    ]
                ]
            ]
        ]);

        return $handler;
    }

    public function handle(CartInterface $quote, InstrumentInterface $paymentData): void
    {
        $token = $paymentData->getCredential()?->getToken() ?? '';

        if (!$token) {
            return;
        }

        $additionalData = $this->paymentDataProvider->getData(
            self::HANDLER_ID,
            []
        );

        $paymentMethod = $this->paymentFactory->create(
            [
                'data' => [
                    PaymentInterface::KEY_METHOD => self::HANDLER_ID,
                    PaymentInterface::KEY_ADDITIONAL_DATA => $additionalData,
                ],
            ]
        );

        $this->paymentMethodManagement->set(
            (int)$quote->getId(),
            $paymentMethod
        );

        $this->registerGooglePayTransaction->execute(
            (string)$quote->getId(),
            $token
        );
    }

    private function getMerchantOrigin(): string
    {
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        $url = $store->getBaseUrl(UrlInterface::URL_TYPE_WEB);

        return rtrim(parse_url($url, PHP_URL_HOST) ?? '', '/');
    }
}

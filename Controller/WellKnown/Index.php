<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Controller\WellKnown;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\LocalizedException;
use Spyrosoft\Ucp\Model\Data\Ucp as UcpData;
use Spyrosoft\Ucp\Service\Builder\Payment;
use Spyrosoft\Ucp\Service\Builder\Ucp;
use Spyrosoft\Ucp\Service\Validator\Request\ValidatorInterface;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private readonly JsonFactory $resultJsonFactory,
        private readonly Ucp $ucpBuilder,
        private readonly Payment $paymentBuilder,
        private readonly ValidatorInterface $requestValidator
    ) {
    }

    public function execute(): Json
    {
        /** @var Json $result */
        $result = $this->resultJsonFactory->create();

        try {
            $this->requestValidator->validate();
        } catch (LocalizedException $e) {
            $result->setHttpResponseCode(400);
            $result->setData([
                'error' => true,
                'message' => $e->getMessage()
            ]);

            return $result;
        }

        /** @var UcpData $ucp */
        $ucp = $this->ucpBuilder->build();
        /** @var \Spyrosoft\Ucp\Model\Data\Checkout\Payment $payment */
        $payment = $this->paymentBuilder->build();

        $result->setData(
            [
                'ucp' => $ucp->toArray(),
                'payment' => $payment->toArray(),
            ]
        );

        return $result;
    }
}

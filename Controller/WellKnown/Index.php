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
use Spyrosoft\Ucp\Service\Builder\Ucp;
use Spyrosoft\Ucp\Service\Validator\Request\ValidatorInterface;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private readonly JsonFactory $resultJsonFactory,
        private readonly Ucp $ucpBuilder,
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
        $data = $ucp->toArray();

        if (isset($data['capabilities'])) {
            foreach ($data['capabilities'] as $key => $capability) {
                $data['capabilities'][$key] = [$capability];
            }
        }

        if (isset($data['payment_handlers'])) {
            foreach ($data['payment_handlers'] as $key => $handler) {
                $data['payment_handlers'][$key] = [$handler];
            }
        }

        $result->setData(
            [
                'ucp' => $data
            ]
        );

        return $result;
    }
}

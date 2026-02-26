<?php
/**
 * Copyright © SpyroSoft. All rights reserved.
 */
declare(strict_types=1);

namespace Spyrosoft\Ucp\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\ActionList;
use Magento\Framework\App\RouterInterface;
use Spyrosoft\Uci\Service\Config;

class Router implements RouterInterface
{
    public function __construct(
        private readonly ActionFactory $actionFactory,
        private readonly ActionList $actionList,
        private readonly Config $config
    ) {
    }

    public function match(RequestInterface $request): ?ActionInterface
    {
        $identifier = trim($request->getPathInfo(), '/');

        if ($identifier !== '.well-known/ucp' || !$this->config->isEnabled()) {
            return null;
        }

        $actionClassName = $this->actionList->get('Spyrosoft_Ucp', null, 'wellKnown', 'index');

        return $this->actionFactory->create($actionClassName);
    }
}

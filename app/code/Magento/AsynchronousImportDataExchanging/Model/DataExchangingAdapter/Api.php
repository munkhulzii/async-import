<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\AsynchronousImportDataExchanging\Model\DataExchangingAdapter;

use Magento\AsynchronousImportDataExchangingApi\Api\Data\ImportInterface;
use Magento\Framework\Validation\ValidationException;
use Magento\AsynchronousImportDataExchangingApi\Api\ExchangeAdapterInterface;

/**
 * Data Exchange adapter for Magento API connection
 *
 * @api
 */
class Api implements ExchangeAdapterInterface
{

    /**
     * Api constructor.
     * @param array $exchangingProperties
     */
    public function __construct(
        array $exchangingProperties = []
    ) {
        $this->exchangingProperties = $exchangingProperties;
    }

    /**
     * Execute processing
     *
     * @param ImportInterface $import
     * @param array $importData
     */
    public function execute(ImportInterface $import, array $importData): void{

        echo "do Export via API here";
        var_dump($this->exchangingProperties);
        exit;

    }

}

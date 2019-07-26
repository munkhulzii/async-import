<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\ImportService\Model;

use Magento\ImportService\Api\Data\SourceCsvInterface;
use Magento\ImportService\Api\Data\SourceUploadResponseInterface;
use Magento\ImportService\Api\SourceCsvUploadInterface;
use Magento\ImportService\Model\Import\SourceProcessorPool;

/**
 * Class SourceCsvUpload
 */
class SourceCsvUpload implements SourceCsvUploadInterface
{

    /**
     * @var SourceProcessorPool
     */
    private $sourceProcessorPool;

    /**
     * @var SourceUploadResponse
     */
    private $responseFactory;

    /**
     * @param SourceUploadResponseFactory $responseFactory
     * @param SourceProcessorPool $sourceProcessorPool
     */
    public function __construct(
        SourceUploadResponseFactory $responseFactory,
        SourceProcessorPool $sourceProcessorPool
    ) {
        $this->sourceProcessorPool = $sourceProcessorPool;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param SourceCsvInterface $source
     *
     * @return SourceUploadResponse
     */
    public function execute(SourceCsvInterface $source): SourceUploadResponseInterface
    {
        try {
            $source->setSourceType(SourceCsvInterface::CSV_SOURCE_TYPE);
            $processor = $this->sourceProcessorPool->getProcessor($source);
            $response = $this->responseFactory->create();
            $processor->processUpload($source, $response);
        } catch (\Exception $e) {
            $response = $this->responseFactory->createFailure($e->getMessage());
        }

        return $response;
    }
}

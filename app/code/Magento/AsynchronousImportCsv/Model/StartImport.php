<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\AsynchronousImportCsv\Model;

use Magento\AsynchronousImportDataConvertingApi\Api\ApplyConvertingRulesInterface;
use Magento\AsynchronousImportCsvApi\Api\Data\CsvFormatInterface;
use Magento\AsynchronousImportCsvApi\Api\StartImportInterface;
use Magento\AsynchronousImportCsvApi\Model\DataParserInterface;
use Magento\AsynchronousImportDataExchangingApi\Api\Data\ImportInterface;
use Magento\AsynchronousImportDataExchangingApi\Api\ExchangeImportDataInterface;
use Magento\AsynchronousImportSourceDataRetrievingApi\Api\Data\SourceInterface;
use Magento\AsynchronousImportSourceDataRetrievingApi\Api\RetrieveSourceDataInterface;

/**
 * @inheritdoc
 */
class StartImport implements StartImportInterface
{
    /**
     * @var RetrieveSourceDataInterface
     */
    private $retrieveSourceData;

    /**
     * @var DataParserInterface
     */
    private $dataParser;

    /**
     * @var ApplyConvertingRulesInterface
     */
    private $applyConvertingRules;

    /**
     * @var ExchangeImportDataInterface
     */
    private $exchangeImportData;

    /**
     * @param RetrieveSourceDataInterface $retrieveSourceData
     * @param DataParserInterface $dataParser
     * @param ApplyConvertingRulesInterface $applyConvertingRules
     * @param ExchangeImportDataInterface $exchangeImportData
     */
    public function __construct(
        RetrieveSourceDataInterface $retrieveSourceData,
        DataParserInterface $dataParser,
        ApplyConvertingRulesInterface $applyConvertingRules,
        ExchangeImportDataInterface $exchangeImportData
    ) {
        $this->retrieveSourceData = $retrieveSourceData;
        $this->dataParser = $dataParser;
        $this->applyConvertingRules = $applyConvertingRules;
        $this->exchangeImportData = $exchangeImportData;
    }

    /**
     * @inheritdoc
     */
    public function execute(
        SourceInterface $source,
        ImportInterface $import,
        CsvFormatInterface $format = null,
        array $convertingRules = []
    ): string {
        $sourceData = $this->retrieveSourceData->execute($source);
        foreach ($sourceData as $key => $batch) {
            $parsedData = $this->dataParser->execute($batch, $format);
            $importData = $this->applyConvertingRules->execute($parsedData, $convertingRules);
            $this->exchangeImportData->execute($import, $importData);
        }
        return 'UID';
    }
}


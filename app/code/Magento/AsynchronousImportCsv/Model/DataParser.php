<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\AsynchronousImportCsv\Model;

use Magento\AsynchronousImportCsvApi\Api\Data\CsvFormatInterface;
use Magento\AsynchronousImportCsvApi\Model\DataParserInterface;
use Exception;

/**
 * @inheritdoc
 */
class DataParser implements DataParserInterface
{
    /**
     * @var string
     */
    private $csvDelimiter;

    /**
     * @var string
     */
    private $csvEnclosure;

    /**
     * @var string
     */
    private $csvEscape;

    /**
     * @inheritdoc
     */
    public function execute(array $data, CsvFormatInterface $csvFormat = null): array
    {
        $parsedData = [];
        $headerValues = [];
        foreach ($data as $index => $row) {
            $rowParsed = str_getcsv($row, $csvFormat->getDelimiter(), $csvFormat->getEnclosure(), $csvFormat->getEscape());
            if ($index == 0) {
                $headerValues = $rowParsed;
                continue;
            }
            if (count($headerValues) != count($rowParsed)) {
                throw new Exception(__('Wrong amount of column in line %1', $index));
            }
            $parsedData[] = array_combine($headerValues, $rowParsed);
        }
        return $parsedData;
    }
}

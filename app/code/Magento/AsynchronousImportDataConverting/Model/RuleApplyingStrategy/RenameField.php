<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\AsynchronousImportDataConverting\Model\RuleApplyingStrategy;

use Magento\AsynchronousImportDataConvertingApi\Api\Data\ConvertingRuleInterface;
use Magento\AsynchronousImportDataConvertingApi\Model\ApplyConvertingRuleStrategyInterface;
use Magento\Framework\Exception\LocalizedException;

class RenameField implements ApplyConvertingRuleStrategyInterface
{
    public const RULE_IDENTIFIER = 'rename_field';

    /**
     * @inheritDoc
     */
    public function execute(
        array $importData,
        ConvertingRuleInterface $convertingRule
    ): array {
        $applyTo = $convertingRule->getApplyTo();
        $parameters = $convertingRule->getParameters();

        foreach ($importData as &$row) {
            foreach ($parameters as $currentName => $newName) {
                if (isset($row[$newName])) {
                    throw new LocalizedException(__('Not possible to rename field %1. The new field name %2 already exists.', $currentName, $newName));
                }
                if (isset($row[$currentName]) && isset($parameters[$currentName]) && $parameters[$currentName]) {
                    $row[$newName] =$row[$currentName];
                    unset($row[$currentName]);
                }
            }
        }
        unset($row);

        return $importData;
    }
}

<?php

declare(strict_types=1);

namespace Magento\AsynchronousImportDataConverting\Model\ConvertingRuleValidator;

use Magento\AsynchronousImportDataConvertingApi\Api\Data\ConvertingRuleInterface;
use Magento\AsynchronousImportDataConvertingApi\Model\ConvertingRuleValidatorInterface;
use Magento\AsynchronousImportDataConverting\Model\RuleApplyingStrategy\RenameField;
use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;

/**
 * Class RenameFieldParametersValidator
 */
class RenameFieldParametersValidator implements ConvertingRuleValidatorInterface
{
    /*
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @param ValidationResultFactory $validationResultFactory
     */
    public function __construct(ValidationResultFactory $validationResultFactory)
    {
        $this->validationResultFactory = $validationResultFactory;
    }

    /**
     * @inheritDoc
     */
    public function validate(ConvertingRuleInterface $convertingRule): ValidationResult
    {
        $errors = [];
        $identifier = (string)$convertingRule->getIdentifier();

        if (RenameField::RULE_IDENTIFIER === $identifier) {
            $parameters = $convertingRule->getParameters();
            foreach ($parameters as $key => $parameter) {
                if (!$parameter) {
                    $errors[] = __('Parameter "%field" cannot be empty.', ['field' => $key]);
                }
            }
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}

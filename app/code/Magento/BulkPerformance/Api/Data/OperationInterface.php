<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\BulkPerformance\Api\Data;

/**
 * Interface OperationInterface
 * @api
 * @since 100.2.0
 */
interface OperationInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const BULK_ID = 'bulk_uuid';
    const TOPIC_NAME = 'topic_name';
    const SERIALIZED_DATA = 'serialized_data';
    const RESULT_SERIALIZED_DATA = 'result_serialized_data';
    const STATUS = 'status';
    const RESULT_MESSAGE = 'result_message';
    const ERROR_CODE = 'error_code';
    const FINISHED_AT = 'finished_at';
    const CREATED_AT = 'created_at';

    /**#@-*/

    /**#@+
     * Status types
     */
    const STATUS_TYPE_COMPLETE = 1;
    const STATUS_TYPE_RETRIABLY_FAILED = 2;
    const STATUS_TYPE_NOT_RETRIABLY_FAILED = 3;
    const STATUS_TYPE_OPEN = 4;
    const STATUS_TYPE_REJECTED = 5;
    /**#@-*/

    /**
     * Operation id
     *
     * @return int|null
     * @since 100.2.0
     */
    public function getId(): ?int;

    /**
     * Set operation id
     *
     * @param int $id
     * @return $this
     * @since 100.2.0
     */
    public function setId(int $id): OperationInterface;

    /**
     * Get bulk uuid
     *
     * @return string|null
     * @since 100.2.0
     */
    public function getBulkUuid(): ?string;

    /**
     * Set bulk uuid
     *
     * @param string $bulkId
     * @return $this
     * @since 100.2.0
     */
    public function setBulkUuid(string $bulkId): OperationInterface;

    /**
     * Message Queue Topic
     *
     * @return string|null
     * @since 100.2.0
     */
    public function getTopicName(): ?string;

    /**
     * Set message queue topic
     *
     * @param string $topic
     * @return $this
     * @since 100.2.0
     */
    public function setTopicName(string $topic): OperationInterface;

    /**
     * Serialized Data
     *
     * @return string|null
     * @since 100.2.0
     */
    public function getSerializedData(): ?string;

    /**
     * Set serialized data
     *
     * @param string|null $serializedData
     * @return $this
     * @since 100.2.0
     */
    public function setSerializedData(?string $serializedData): OperationInterface;

    /**
     * Result serialized Data
     *
     * @return string|null
     * @since 100.3.0
     */
    public function getResultSerializedData(): ?string;

    /**
     * Set result serialized data
     *
     * @param string|null $resultSerializedData
     * @return $this
     * @since 100.3.0
     */
    public function setResultSerializedData(?string $resultSerializedData): OperationInterface;

    /**
     * Get operation status
     *
     * @return int|null
     * @since 100.2.0
     */
    public function getStatus(): ?int;

    /**
     * Set status
     *
     * @param int $status
     * @return $this
     * @since 100.2.0
     */
    public function setStatus(int $status): OperationInterface;

    /**
     * Get result message
     *
     * @return string|null
     * @since 100.2.0
     */
    public function getResultMessage(): ?string;

    /**
     * Set result message
     *
     * @param string|null $resultMessage
     * @return $this
     * @since 100.2.0
     */
    public function setResultMessage(?string $resultMessage): OperationInterface;

    /**
     * Get created at
     *
     * @return string|null
     * @since 100.2.0
     */
    public function getCreatedAt(): ?string;

    /**
     * Get finished at
     *
     * @return string|null
     * @since 100.2.0
     */
    public function getFinishedAt(): ?string;

    /**
     * Set finished at
     *
     * @param string|null $date
     * @return $this
     * @since 100.2.0
     */
    public function setFinishedAt(?string $date): OperationInterface;

    /**
     * Get error code
     *
     * @return int|null
     * @since 100.2.0
     */
    public function getErrorCode(): ?string;

    /**
     * Set error code
     *
     * @param int|null $errorCode
     * @return $this
     * @since 100.2.0
     */
    public function setErrorCode(?string $errorCode): OperationInterface;
}

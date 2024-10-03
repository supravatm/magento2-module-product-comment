<?php

namespace SMG\RestApiProductComment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ProductCommentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface[]
     */
    public function getItems();

    /**
     * @param SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
<?php

namespace Stackexchange\ProductComment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ProductCommentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return Stackexchange\ProductComment\Api\Data\ProductCommentSearchResultsInterface[]
     */
    public function getItems();

    /**
     * @param Stackexchange\ProductComment\Api\Data\ProductCommentSearchResultsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

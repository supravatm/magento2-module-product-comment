<?php

namespace Stackexchange\ProductComment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Stackexchange\ProductComment\Api\Data\ProductCommentInterface;

interface ProductCommentRepositoryInterface
{
    /**
     * @api
     * @param \Stackexchange\ProductComment\Api\Data\ProductCommentnterface $comment
     * @return \Stackexchange\ProductComment\Api\Data\ProductCommentnterface
     */
    public function save(ProductCommentInterface $comment);

    /**
     * @api
     * @param \Stackexchange\ProductComment\Api\Data\ProductCommentnterface $comment
     * @return \Stackexchange\ProductComment\Api\Data\ProductCommentSearchResultsInterface
     */
    public function delete(ProductCommentInterface $comment);

    /**
     * @api
     * @param \Stackexchange\ProductComment\Api\Data\ProductCommentnterface $id
     * @return void
     */
    public function deleteById($id);

    /**
     * @api
     * @param int $id
     * @return \Stackexchange\ProductComment\Api\Data\ProductCommentSearchResultsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Stackexchange\ProductComment\Api\Data\ProductCommentSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);
}

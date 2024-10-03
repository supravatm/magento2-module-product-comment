<?php

namespace SMG\RestApiProductComment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use SMG\RestApiProductComment\Api\Data\ProductCommentInterface;

interface ProductCommentRepositoryInterface
{
    /**
     * @api
     * @param \SMG\RestApiProductComment\Api\Data\ProductCommentInterface $comment
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentInterface
     */
    public function save(ProductCommentInterface $comment);

    /**
     * @api
     * @param \SMG\RestApiProductComment\Api\Data\ProductCommentInterface $comment
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface
     */
    public function delete(ProductCommentInterface $comment);

    /**
     * @api
     * @param \SMG\RestApiProductComment\Api\Data\ProductCommentInterface $id
     * @return void
     */
    public function deleteById($id);

    /**
     * @api
     * @param int $id
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);
}
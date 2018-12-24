<?php
namespace Stackexchange\ProductComment\Api;

use \Stackexchange\ProductComment\Api\Data\ProductCommentInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;

interface ProductCommentRepositoryInterface
{
    /**
     * @api
     * @param \Stackexchange\ProductComment\Api\Data\ProductCommentInterface $model
     * @return \Stackexchange\ProductComment\Api\Data\ProductCommentInterface
     */
    public function save(ProductCommentInterface $model);

    /**
     * @api
     * @param \Stackexchange\ProductComment\Api\Data\ModelInterface $model
     * @return \Stackexchange\ProductComment\Api\Data\ModelInterface
     */
    public function delete(ProductCommentInterface $model);

    /**
     * @api
     * @param \Stackexchange\ProductComment\Api\Data\ModelInterface $id
     * @return void
     */
    public function deleteById($id);

    /**
     * @api
     * @param int $id
     * @return \Stackexchange\ProductComment\Api\Data\ModelInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Stackexchange\ProductComment\Api\Data\ModelSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);
}

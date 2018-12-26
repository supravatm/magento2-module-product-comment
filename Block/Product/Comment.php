<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Stackexchange\ProductComment\Block\Product;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

/**
 * Product Review Tab
 *
 * @api
 * @author     Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class Comment extends Template implements IdentityInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Review resource model
     *
     * @var \Stackexchange\ProductComment\Model\ResourceModel\ProductComment\CollectionFactory
     */
    protected $_commentColFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Stackexchange\ProductComment\Model\ResourceModel\ProductComment\CollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Stackexchange\ProductComment\Model\ResourceModel\ProductComment\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_commentColFactory = $collectionFactory;
        parent::__construct($context, $data);

        $this->setTabTitle();
    }

    /**
     * Get current product id
     *
     * @return null|int
     */
    public function getProductId()
    {
        $product = $this->_coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    /**
     * Get URL for ajax call
     *
     * @return string
     */
    public function getProductCommentUrl()
    {
        return $this->getUrl(
            'productcomment/product/listAjax',
            [
                '_secure' => $this->getRequest()->isSecure(),
                'id' => $this->getProductId(),
            ]
        );
    }

    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle()
    {
        $title = $this->getCollectionSize()
            ? __('Comments %1', '<span class="counter">' . $this->getCollectionSize() . '</span>')
            : __('Comments');
        $this->setTitle($title);
    }

    /**
     * Get size of reviews collection
     *
     * @return int
     */
    public function getCollectionSize()
    {
        $collection = $this->_commentColFactory->create()->addFieldToFilter(
            'product_id',
            $this->getProductId()
        );
        return $collection->getSize();
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Stackexchange\ProductComment\Model\ProductComment::CACHE_TAG];
    }
}

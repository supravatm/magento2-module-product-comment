<?php

namespace SMG\RestApiProductComment\Model\ResourceModel\ProductComment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'comment_id';

    protected function _construct()
    {
        $this->_init(\SMG\RestApiProductComment\Model\ProductComment::class, \SMG\RestApiProductComment\Model\ResourceModel\ProductComment::class);
    }
}

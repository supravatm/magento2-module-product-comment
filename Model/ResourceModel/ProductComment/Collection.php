<?php

namespace Stackexchange\ProductComment\Model\ResourceModel\ProductComment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'comment_id';

    protected function _construct()
    {
        $this->_init('Stackexchange\ProductComment\Model\ProductComment', 'Stackexchange\ProductComment\Model\ResourceModel\ProductComment');
    }
}

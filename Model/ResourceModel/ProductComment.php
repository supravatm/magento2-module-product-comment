<?php

namespace SMG\RestApiProductComment\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductComment extends AbstractDb
{
    protected $_idFieldName = 'comment_id';

    protected function _construct()
    {
        $this->_init('smg_product_comment','comment_id');
    }
}

<?php

namespace SMG\RestApiProductComment\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use SMG\RestApiProductComment\Model\ProductCommentFactory as CommentFactory;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'SMG_RestApiProductComment::productcomment';

    /**
     * @var PageFactory
     */
    private $pageFactory;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    /**
     * ProductCommentFactory
     *
     * @var SMG\RestApiProductComment\Model\ProductCommentFactory
     */
    protected $commentFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $rawFactory
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        Registry $coreRegistry,
        CommentFactory $commentFactory
    ) {
        $this->pageFactory = $rawFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->commentFactory = $commentFactory;
        parent::__construct($context);
    }

    /**
     * Add the main Admin Grid page
     *
     * @return Page
     */
    public function execute(): Page
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('comment_id');
        $model = $this->commentFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Comment no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('comment_data', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Comment') : __('New Comment'),
            $id ? __('Edit Comment') : __('New Comment')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Comments'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Comment'));
        return $resultPage;

    }


    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('SMG_RestApiProductComment::productcomment')
            ->addBreadcrumb(__('SMG'), __('SMG'))
            ->addBreadcrumb(__('Product Comment'), __('Product Comment'));
        return $resultPage;
    }
}
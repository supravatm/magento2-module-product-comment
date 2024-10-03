<?php

namespace SMG\RestApiProductComment\Controller\Product;

use Magento\Framework\Controller\ResultFactory;

class Post extends \Magento\Framework\App\Action\Action
{

    /**
     * Index resultPageFactory
     * @var PageFactory
     */
    private $resultPageFactory;
    /**
     * @var
     */
    private $modelFactory;
    /**
     * @var
     */
    private $modelRepository;

    protected $_customerSession;
    protected $resultRedirect;
    protected $productCommentFactory;
    protected $productCommentRepository;
    protected $customerRepositoryInterface;



    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \SMG\RestApiProductComment\Model\ModelFactory $modelFactory
     * @param \SMG\RestApiProductComment\Model\ModelRepository $modelRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \SMG\RestApiProductComment\Model\ProductCommentFactory $productCommentFactory,
        \SMG\RestApiProductComment\Model\ProductCommentRepository $productCommentRepository,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\Redirect $resultRedirect,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->productCommentFactory = $productCommentFactory;
        $this->productCommentRepository = $productCommentRepository;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->resultRedirect = $resultRedirect;
        $this->_customerSession = $customerSession;
        return parent::__construct($context);


    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        $productId = (int)$this->getRequest()->getParam('id');
        $email = $this->getRequest()->getPost('email');
        try {
            $customer = $this->customerRepositoryInterface->get($email);
            $data = [
                "product_id" => $productId,
                "customer_id" => $customer->getId() ?: 0,
                "title" => $this->getRequest()->getPost('title'),
                "comment" => $this->getRequest()->getPost('comment')
            ];
            $obj = $this->productCommentFactory->create();
            $this->productCommentRepository->save($obj->addData($data)); // Service Contract
            $this->messageManager->addSuccess(__('You submitted your comment for moderation.'));

        } catch(\Magento\Framework\Exception\NoSuchEntityException $e) {
            
            $data = [
                "product_id" => $productId,
                "customer_id" => 0,
                "title" => $this->getRequest()->getPost('title'),
                "comment" => $this->getRequest()->getPost('comment')
            ];
            $obj = $this->productCommentFactory->create();
            $this->productCommentRepository->save($obj->addData($data)); // Service Contract
            $this->messageManager->addSuccess(__('You submitted your comment for moderation.'));
        }
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

}
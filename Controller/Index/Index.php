<?php

namespace SMG\RestApiProductComment\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;
    private $productCommentFactory;
    private $_customerSession;
    private $productCommentRepository;
    protected $customerSession;
    protected $resultRedirect;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \SMG\RestApiProductComment\Model\ProductCommentFactory $productCommentFactory,
        \SMG\RestApiProductComment\Model\ProductCommentRepository $productCommentRepository,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\Redirect $resultRedirect
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->productCommentFactory = $productCommentFactory;
        $this->productCommentRepository = $productCommentRepository;
        $this->resultRedirect = $resultRedirect;
        $this->_customerSession = $customerSession;
        return parent::__construct($context);


    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = [
            "comment_id" => 5,
            "product_id" => 1,
            "customer_id" => 1,
            "title" => "ttile of the comment",
            "comment" => "Test new comment commet ",
            "status" => 2
        ];
        $obj = $this->productCommentFactory->create();
        $obj->addData($data);
        //$obj->save($obj);
        $this->productCommentRepository->save($obj->addData($data)); // Service Contract
        die;
    }

}

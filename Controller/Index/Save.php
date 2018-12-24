<?php

namespace Stackexchange\ProductComment\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
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

    protected $customerSession;


    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Stackexchange\ProductComment\Model\ModelFactory $modelFactory
     * @param \Stackexchange\ProductComment\Model\ModelRepository $modelRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Stackexchange\ProductComment\Model\ProductCommentFactory $productCommentFactory,
        \Stackexchange\ProductComment\Model\ProductCommentRepository $productCommentRepository,
        \Magento\Customer\Model\Session $customerSession
) {
        $this->resultPageFactory = $resultPageFactory;
        $this->productCommentFactory = $productCommentFactory;
        $this->productCommentRepository = $productCommentRepository;
        $this->_customerSession = $customerSession;
        return parent::__construct($context);


    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $data = [
            "product_id" => $this->getRequest()->getPost('product_id'),
            "customer_email" => $this->getRequest()->getPost('customer_email'),
            "customer_comment" => $this->getRequest()->getPost('customer_comment')
        ];

        if($this->_customerSession->isLoggedIn()){
            $data['customer_id'] =$this->_customerSession->getCustomer()->getId();
            $data['customer_id'] = 0;
        } else {
            $data['customer_id'] = 0;
            $data['customer_id'] = 1;
        }

        $obj = $this->productCommentFactory->create();
        $this->productCommentRepository->save($obj->addData($data)); // Service Contract
        //$obj->addData($data)->save(); // ProductComment / Resource ProductComment
        $this->resultFactory->create("raw");
    }

}

<?php
declare(strict_types=1);

namespace YuryCompany\Hobby\Controller\Hobby;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Save extends AbstractAccount implements HttpPostActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $resultFactory;

    private $customerSession;

    protected $customerResource;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\ResourceModel\Customer $customerResource
    ) {
        $this->customerSession = $customerSession;
        $this->customerResource = $customerResource;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();
        if (!empty($post)) {

            $hobbyId = (int)$post['hobby'];

            $customer = $this->customerSession->getCustomer();
            $customer->setData('hobby', $hobbyId);

            try {
                //update customer
                $this->customerResource->save($customer);

                // Display the success form validation message
                $this->messageManager->addSuccessMessage('Customer\'s hobby has been updated!');

            } catch (AlreadyExistsException $e) {
                throw new AlreadyExistsException(__($e->getMessage()), $e);
            } catch (\Exception $e) {
                throw new \RuntimeException(__($e->getMessage()));
            }
        }

        // Redirect to your form page (or anywhere you want...)
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl('/hobby/hobby/index');

        return $resultRedirect;
    }
}

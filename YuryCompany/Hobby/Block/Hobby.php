<?php
declare(strict_types=1);

namespace YuryCompany\Hobby\Block;

use Magento\Eav\Model\Config;

class Hobby extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
    protected $eavConfig;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        Config $eavConfig,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->eavConfig = $eavConfig;
        parent::__construct($context, $data);
    }

    public function getFormAction()
    {
        return $this->getUrl('hobby/hobby/save');
    }

    public function getHobbyId(): ?int
    {
        return (int) $this->customerSession->getCustomer()->getHobby();
    }

    public function getHobbyOptions(): array
    {
        $attribute = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'hobby');

        return $attribute->getSource()->getAllOptions();
    }
}

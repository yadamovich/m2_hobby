<?php
declare(strict_types=1);

namespace YuryCompany\Hobby\CustomerData;

use Magento\Customer\CustomerData\Customer as OriginalCustomerData;
use Magento\Eav\Model\Config;

class Customer extends OriginalCustomerData
{

    protected $eavConfig;

    public function __construct(
        Config $eavConfig
    ) {
        $this->eavConfig = $eavConfig;
    }

    /**
     * AfterGetSectionData
     *
     * @param OriginalCustomerData $subject
     * @param array                $result
     *
     * @return array
     */
    public function afterGetSectionData(OriginalCustomerData $subject, array $result): array
    {
        $customerId = $subject->currentCustomer->getCustomerId();
        if ($customerId) {
            $customer = $subject->currentCustomer->getCustomer();

            $attribute = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'hobby');

            $result['hobby'] = $attribute->getSource()->getOptionText($customer->getCustomAttribute('hobby')->getValue());
        }

        return $result;
    }
}

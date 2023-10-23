<?php
declare(strict_types=1);

namespace YuryCompany\Hobby\Model\Resolver\Customer;

use Magento\Eav\Model\Config;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Hobby implements ResolverInterface
{
    protected $eavConfig;

    public function __construct(
        Config $eavConfig
    ) {
        $this->eavConfig = $eavConfig;
    }

    // This is the function which will get invoked when we request 'hobby' info in the graphql query
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): string
    {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }
        $customer = $value['model'];

        // Get the custom attribute info of the customer.
        $hobby = $this->getCustomerHobby($customer);

        return $hobby;
    }

    private function getCustomerHobby($customer): string
    {
        $attribute = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'hobby');

        return $attribute->getSource()->getOptionText($customer->getCustomAttribute('hobby')->getValue());
    }
}

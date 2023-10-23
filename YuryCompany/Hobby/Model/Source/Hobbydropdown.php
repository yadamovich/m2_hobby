<?php
declare(strict_types=1);

namespace YuryCompany\Hobby\Model\Source;

class Hobbydropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions(): array
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => '', 'label' => __('Please Select')],
                ['value' => '1', 'label' => __('Yoga')],
                ['value' => '2', 'label' => __('Traveling')],
                ['value' => '3', 'label' => __('Hiking')],
            ];
        }

        return $this->_options;

    }

    public function getOptionText($value): string
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label']->getText();
            }
        }

        return '';
    }
}

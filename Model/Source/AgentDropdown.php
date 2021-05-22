<?php
 
namespace AHT\Sales\Model\Source;

class AgentDropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_colection;

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $salesColectionFactory
    )
    {
        $this->_colection = $salesColectionFactory;
    }


    public function getAllOptions() {
        if ($this->_options === null) {
            $collection = $this->_colection->create();
            foreach ($collection as $item) {
                $this->_options[] = [
                    'label' => $item->getFirstname(),
                    'value' => $item->getEntity_id()
                ];
            }
        }
        return $this->_options;
    }

}
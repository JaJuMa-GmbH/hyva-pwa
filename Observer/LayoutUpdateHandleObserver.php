<?php

namespace Jajuma\HyvaPwa\Observer;

use Jajuma\HyvaPwa\Helper\Data;
use Magento\Framework\Event;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Layout as Layout;

/**
 *  AddCategoryLayoutUpdateHandleObserver
 */
class LayoutUpdateHandleObserver implements ObserverInterface
{
    /**
     * Category Custom Layout Name
     *
     * It's the filename of layout phisically located
     * at `[Vendor]/[ModuleName]/view/frontend/layout/catalog_category_view_custom_layout.xml`
     */

    /**
     * @var Data
     */
    protected $_pwaHelper;

    /**
     * LayoutUpdateHandleObserver constructor.
     * @param Data $pwaHelper
     */
    public function __construct(
        Data $pwaHelper
    )
    {
        $this->_pwaHelper = $pwaHelper;
    }

    /**
     * @param EventObserver $observer
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function execute(EventObserver $observer)
    {
        $event = $observer->getEvent();
        /** @var Layout $layout */
        $layout = $event->getData('layout');
        if ($this->_pwaHelper->isEnabled()){
            $layoutUpdate = $layout->getUpdate();
            if ($layoutUpdate->getHandles() && count($layoutUpdate->getHandles()) > 0) {
                $layoutUpdate->addHandle('jajuma-pwa-header');
            }
        }
        if (!$this->_pwaHelper->isEnabledManifest()) {
            $layoutUpdate = $layout->getUpdate();
            $layoutUpdate->addHandle('no-manifest');
        }
    }
}

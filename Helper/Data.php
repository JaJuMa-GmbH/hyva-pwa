<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\HyvaPwa\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Data
 * @package Jajuma\HyvaPwa\Helper
 */
class Data extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var File
     */
    protected $_fileDriver;

    /**
     * Data constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param File $fileDriver
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        File $fileDriver
    )
    {
        $this->_storeManager = $storeManager;
        $this->_fileDriver = $fileDriver;
        parent::__construct($context);
    }

    /**
     * @return StoreInterface
     * @throws NoSuchEntityException
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/general/enable',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function isEnabledManifest()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/general/enable_manifest',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestShortName()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/short_name',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestName()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/name',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestDescription()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/description',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestStartUrl()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/start_url',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestThemeColor()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/theme_color',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestBgColor()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/background_color',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestDisplayType()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/display_type',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestOrientation()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/orientation',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestIcon()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/icon',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getManifestIconSizes()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/manifest/icon_sizes',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function enableServiceWorker()
    {
        return $this->scopeConfig->getValue(
            'hyvapwa/service_worker/enable',
            ScopeInterface::SCOPE_STORE,
            $this->getStore()->getId()
        );
    }

    /**
     * @param $filePath
     * @return bool
     * @throws FileSystemException
     */
    public function checkFileExist($filePath)
    {
        if ($this->_fileDriver->isExists($filePath)) {
            return true;
        }
        return false;
    }

    /**
     * @return LoggerInterface
     */
    public function logger()
    {
        return $this->_logger;
    }

}

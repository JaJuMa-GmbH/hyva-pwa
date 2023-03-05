<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

namespace Jajuma\HyvaPwa\Observer;

use Exception;
use Jajuma\HyvaPwa\Helper\Data;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use const DIRECTORY_SEPARATOR;

/**
 * Class UpdateServiceWorker
 * @package Jajuma\HyvaPwa\Observer
 */
class UpdateServiceWorker implements ObserverInterface
{
    /**
     * @var Data
     */
    protected $_pwaHelper;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var Repository
     */
    private $assetRepo;

    /**
     * @var File
     */
    protected $file;

    /**
     * UpdateServiceWorker constructor.
     * @param Data $pwaHelper
     * @param UrlInterface $urlBuilder
     * @param DirectoryList $directoryList
     * @param Repository $assetRepo
     * @param File $file
     */
    public function __construct(
        Data $pwaHelper,
        UrlInterface $urlBuilder,
        DirectoryList $directoryList,
        Repository $assetRepo,
        File $file
    )
    {
        $this->_pwaHelper = $pwaHelper;
        $this->urlBuilder = $urlBuilder;
        $this->directoryList = $directoryList;
        $this->assetRepo = $assetRepo;
        $this->file = $file;
    }

    /**
     * @param Observer $observer
     * @throws FileSystemException
     * @throws NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        if (
            $this->_pwaHelper->isEnabled() &&
            $this->_pwaHelper->isModuleOutputEnabled('Jajuma_HyvaPwa')
        ) {
            $data =
"self.addEventListener('install',  event => {});
self.addEventListener('fetch', event => {});
";
            $ioAdapter = $this->file;
            $rootPath = $this->directoryList->getPath(DirectoryList::PUB) . DIRECTORY_SEPARATOR;

            try {
                if ($ioAdapter->fileExists($rootPath . 'serviceWorker.js')) {
                    $ioAdapter->rm($rootPath . 'serviceWorker.js');
                }
                $fileName = "serviceWorker.js";
                $ioAdapter->open(array('path' => $rootPath));
                $ioAdapter->write($fileName, $data, 0777);
            } catch (Exception $exception) {
                $this->_pwaHelper->logger()->error($exception);
            }
        }
    }

}

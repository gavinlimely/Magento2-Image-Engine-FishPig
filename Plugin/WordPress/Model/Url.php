<?php

namespace Limely\ImageEngineFishPig\Plugin\WordPress\Model;

use Limely\ImageEngine\Helper\Data;
use Magento\Store\Model\StoreManager;
use FishPig\WordPress\Model\Url as BaseUrl;

class Url {

    /**
     * Helper
     * 
     * @var Data
     */
    protected $helper;

    /**
     * Store manager
     *
     * @var StoreManager
     */
    protected $storeManager;

    /**
     * Constructor - inject dependencies
     * 
     * @param Data $helper
     * @param StoreManager $storeManager
     */
    public function __construct(
        Data $helper,
        StoreManager $storeManager
    ) {
        $this->helper = $helper;
        $this->storeManager = $storeManager;
    }

    /**
     * After get file upload url
     * 
     * @param BaseUrl $url
     * @param string $return
     * @return string
     */
    public function afterGetFileUploadUrl(BaseUrl $url, $return) {
        if ($this->helper->isEnabled()) {
            $store = $this->storeManager->getStore();
            if ($store && $this->isImage($return)) {
                $return = str_replace(rtrim($store->getBaseUrl(), '/'), $this->helper->getEngineUrl(), $return);
            }
        }
        return $return;
    }

}

<?php

namespace Limely\ImageEngineFishPig\Plugin\WordPress\Model;

use Limely\ImageEngine\Helper\Data;
use FishPig\WordPress\App\Url;
use Magento\Store\Model\StoreManager;
use FishPig\WordPress\Model\Post as BasePost;

class Post {
    
    /**
     * Helper
     * 
     * @var Data
     */
    protected $helper;
    
    /**
     * URL
     * 
     * @var Url
     */
    protected $url;
    
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
     * @param Url $url
     * @param StoreManager $storeManager
     */
    public function __construct(
        Data $helper,
        Url $url,
        StoreManager $storeManager
    ) {
        $this->helper = $helper;
        $this->url = $url;
        $this->storeManager = $storeManager;
    }
    
    /**
     * After get post content
     * 
     * @param BasePost $post
     * @param string $return
     * @return string
     */
    public function afterGetContent(BasePost $post, $return) {
        if ($this->helper->isEnabled()) {            
            $replace = $this->url->getWpContentUrl() . 'uploads/';
            $return = str_replace(
                $replace,
                $this->getReplacementUrl($replace),
                $return
            );            
        }
        return $return;
    }
    
    /**
     * Get replacement URL
     * 
     * @param string $url
     * @return string
     */
    protected function getReplacementUrl($url) {
        $store = $this->storeManager->getStore();
        if ($store) {
            return str_replace(rtrim($store->getBaseUrl(), '/'), $this->helper->getEngineUrl(), $url);
        } else {
            return $url;
        }
    }
    
}
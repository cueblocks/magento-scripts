<?php
require_once 'abstract.php';

class Mage_Shell_Admin404Check extends Mage_Shell_Abstract
{
    /**
     * Apply PHP settings to shell script
     *
     * @return void
     */
    protected function _applyPhpVariables()
    {
        parent::_applyPhpVariables();

        set_time_limit(0);
        error_reporting(E_ALL);
        ini_set( 'memory_limit', '2G' );
        ini_set( 'display_errors', 1 );
    }

    public function run()
    {
        if( isset( $this->_args['username'] ) ) {
            if($this->login($this->_args['username'])) {
                $startTime = microtime(true);
                $config = Mage::getModel('core/config');
                $settingAltered = false;
                if(Mage::getStoreConfig('admin/security/use_form_key') == "1") {
                    $config->saveConfig('admin/security/use_form_key',0);
                    $settingAltered = true;
                }
                $this->checkUrls();
                if($settingAltered) {
                    $config->saveConfig('admin/security/use_form_key',1);
                }
                $endTime = (int)(microtime(true) - $startTime);
                echo "Total time spent $endTime seconds \n";
            } else {
                echo "Unable too login in admin.";
            }
        } else {
            echo "Please specify admin username";
        }
    }

    public function processUrl($url) {
        $remove = '/admin404Check.php';
        if (strpos($url, $remove)) {
            $url = str_replace($remove,'',$url);
        }
        return $url;
    }

    public function checkUrls() {
        $menu = $this->buildMenuArray(null);
        $systemConfig = $this->getSystemConfig();
        $menu = array_merge($menu,$systemConfig);
        $notFoundPages = array();
        echo "Total pages need to be checked ".count($menu)."\n";
        foreach($menu as $url) {
            $startTime = microtime(true);
            echo "Checking Url: ".$url;
            Mage::log($url, null, 'pagesChecked.log', true);
            if($this->is404($url)){
                echo " --- 404";
                $notFoundPages[] = $url;
                Mage::log($url, null, '404pages.log', true);
            }
            $endTime = (int)(microtime(true) - $startTime);
            echo " --- Time taken $endTime seconds\n";
        }
        if(!empty($notFoundPages)) {
            echo "404 pages found .. check file 'var/404pages.log' for urls.\n";
        } else {
            echo "No 404 page found.\n";
        }
        echo "Please check file var/pagesChecked.log\n";
    }

    public function login($username) {
        $user = Mage::getModel('admin/user')->loadByUsername($username); // Here admin is the Username
        if (Mage::getSingleton('adminhtml/url')->useSecretKey()) {
            Mage::getSingleton('adminhtml/url')->renewSecretUrls();
        }

        $session = Mage::getSingleton('admin/session');
        $session->setIsFirstVisit(true);
        $session->setUser($user);
        $session->setAcl(Mage::getResourceModel('admin/acl')->loadAcl());
        if ($session->isLoggedIn()) {
            return true;
        }
        return false;
    }

    public function buildMenuArray($parent=null)
    {
        $menuArr = array();
        $config = Mage::getSingleton('admin/config');
        if (is_null($parent)) {
            $parent = $config->getAdminhtmlConfig()->getNode('menu');
        }

        foreach ($parent->children() as $childName => $child) {
            if (1 == $child->disabled) {
                continue;
            }
            if ($child->action) {
                $menuArr[] = $this->processUrl(Mage::getModel('adminhtml/url')->getUrl((string)$child->action, array('_cache_secret_key' => false)));
            }
            if ($child->children) {
                $result = $this->buildMenuArray($child->children);
                if(is_array($result)) {
                    $menuArr = array_merge($menuArr, $result);
                } else {
                    $menuArr[] = $result;
                }
            }
        }

        return $menuArr;
    }

    public function getSystemConfig() {
        //$adminUrl = strtok(Mage::getModel('adminhtml/url')->getUrl(),'?');
        $url = Mage::getModel('adminhtml/url');
        $prefix = 'adminhtml/system_config/edit/section/';
        $sections  = Mage::getSingleton('adminhtml/config')->getSections()->asArray();
        $result = array();
        foreach($sections as $sectionKey=>$section) {
            $result[] = $this->processUrl($url->getUrl($prefix, array('_current'=>false, 'section'=>$sectionKey)));
        }
        return $result;
    }

    public function is404($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
            return true;
        }

        curl_close($handle);
        return false;

    }

    /**
     * Retrieve Usage Help Message
     *
     * @return void
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php admin404Check.php -- [options]
  username           Specify admin username
USAGE;
    }
}

$shell = new Mage_Shell_Admin404Check();

$shell->run();
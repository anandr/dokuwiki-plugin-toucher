<?php
/**
 * DokuWiki Plugin toucher (Admin Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andriy Nych <nych.andriy@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class admin_plugin_toucher extends DokuWiki_Admin_Plugin
{
    public function getMenuSort()
    {
        return 13;
    }

    public function forAdminOnly()
    {
        return $this->getConf('admin_only');
    }

    protected function touchFiles()
    {
        touch(DOKU_CONF.'local.php'); // this is the core of this plugin
    }
 
    public function handle()
    {
        global $INFO;

        if ($this->getConf('admin_only')) {
            if (!$INFO['isadmin']) {
                msg('Plugin toucher failed: you must be admin to touch configuration', -1);
                return false;
            }
        }
        $this->touchFiles();
        msg('Plugin toucher touched configuration files', 1);
        return true;
    }

    public function html()
    {
        ptln('<h1>' . $this->getLang('menu') . '</h1>');
        ptln('<p>Configuration files have been just touched.</p>');
    }
}


<?php
/**
 * DokuWiki Plugin toucher (Admin Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Andriy Nych <nych.andriy@gmail.com>
 */

// must be run within Dokuwiki
if ( !defined ( 'DOKU_INC' ) ) die ( );

if ( !defined ( 'DOKU_LF' ) ) define ( 'DOKU_LF', "\n" );
if ( !defined ( 'DOKU_TAB' ) ) define ( 'DOKU_TAB', "\t" );
if ( !defined ( 'DOKU_PLUGIN' ) ) define ( 'DOKU_PLUGIN', DOKU_INC . 'lib/plugins/' );

require_once DOKU_PLUGIN . 'admin.php';

class admin_plugin_toucher extends DokuWiki_Admin_Plugin {

    public function getMenuSort ( ) {
        return 13;
    }

    public function forAdminOnly ( ) {
        return $this -> getConf ( 'admin_only' );
    }

    function touchFiles ( ) {
        touch ( DOKU_CONF . "local.php" ); // this is the core of this plugin
    }
 
    public function handle ( ) {
        global $INFO;

        if ( $this -> getConf ( 'admin_only' ) ) {
            if ( !$INFO [ 'isadmin' ] ) {
                msg ( $this -> getLang ( 'denied' ), -1);
                return false;
            }
        }
        $this -> touchFiles ( );
        msg ( $this -> getLang ( 'success' ), 1);
        return true;
    }

    public function html ( ) {
        ptln ( '<h1>' . $this -> getLang ( 'menu' ) . '</h1>' );
        ptln ( $this -> getLang ( 'success_p' ) );
    }
}
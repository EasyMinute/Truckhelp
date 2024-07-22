<?php
    require_once __DIR__ . '../../vendor/autoload.php';
    include __DIR__ . '../../vendor/otgs/installer/loader.php';
    
    WP_Installer_Setup(
        $wp_installer_instance,
        [
            'plugins_install_tab' => 1,
            'affiliate_id:wpml' => '99999',
            'affiliate_key:wpml' => 'NNNNNNNNNN',
            'src_name' => 'Proacto', 
            'src_author' => '',
        ]
    );
    
?>
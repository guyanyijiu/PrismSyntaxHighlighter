<?php

/**
 * 一个基于 prism.js 的语法着色工具
 *
 * @package PrismSyntaxHighlighter
 * @author  guyanyijiu
 * @version 1.0.0
 * @link    https://www.guyanyijiu.com
 */
class PrismSyntaxHighlighter_Plugin implements Typecho_Plugin_Interface {

    private static $name = 'PrismSyntaxHighlighter';

    public static function activate() {
        Typecho_Plugin::factory('Widget_Archive')->header = [__CLASS__, 'addCss'];
        Typecho_Plugin::factory('Widget_Archive')->footer = [__CLASS__, 'addJs'];
    }

    public static function deactivate() {
    }

    public static function config(Typecho_Widget_Helper_Form $form) {
        $theme = new Typecho_Widget_Helper_Form_Element_Select('theme',
            [
                'default'        => 'Default',
                'dark'           => 'Dark',
                'funky'          => 'Funky',
                'okaidia'        => 'Okaidia',
                'twilight'       => 'Twilight',
                'coy'            => 'Coy',
                'solarizedlight' => 'Solarized Light',
                'tomorrow'       => 'Tomorrow Night',
                'github'         => 'Github',
                'darcula'        => 'IntelliJ Darcula',
                'atom-dark'      => 'Atom dark',
            ],
            'default', _t('选择主题'), null);
        $form->addInput($theme);
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form) {
    }

    /**
     * 添加 css
     *
     * @throws Typecho_Plugin_Exception
     *
     * @author  guyanyijiu
     */
    public static function addCss() {
        $settings = Helper::options()->plugin(self::$name);
        $url = Helper::options()->pluginUrl . '/' . self::$name . '/css/prism-' . $settings->theme . '.css';
        echo '<link href="' . $url . '" rel="stylesheet" />';
    }

    /**
     * 添加 js
     *
     * @author  guyanyijiu
     */
    public static function addJs() {
        $url = Helper::options()->pluginUrl . '/' . self::$name . '/js/prism.js';;
        echo '<script type="text/javascript" src="' . $url . '"></script>';
    }
}
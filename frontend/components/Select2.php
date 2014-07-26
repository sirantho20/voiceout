<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013
 * @package yii2-widgets
 * @version 1.0.0
 */

namespace frontend\components;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Select2 widget is a Yii2 wrapper for the Select2 jQuery plugin. This
 * input widget is a jQuery based replacement for select boxes. It supports
 * searching, remote data sets, and infinite scrolling of results. The widget
 * is specially styled for Bootstrap 3.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://ivaynberg.github.com/select2/
 */
class Select2 extends \kartik\widgets\Select2
{
    /**
     * Embeds the input group addon
     */
    protected function embedAddon($input)
    {
        if (!empty($this->addon)) {
            $addon = $this->addon;
            $prepend = ArrayHelper::getValue($addon, 'prepend', '');
            $append = ArrayHelper::getValue($addon, 'append', '');
            $group = ArrayHelper::getValue($addon, 'groupOptions', []);
            $size = isset($this->size) ? ' input-group-' . $this->size : '';
            if ($this->pluginLoading) {
                Html::addCssClass($group, 'kv-hide group-' . $this->options['id']);
            }
            if (is_array($prepend)) {
                $content = ArrayHelper::getValue($prepend, 'content', '');
                if (isset($prepend['asButton']) && $prepend['asButton'] == true) {
                    $prepend = Html::tag('div', $content, ['class' => 'input-group-btn']);
                } else {
                    $prepend = Html::tag('span', $content, ['class' => 'input-group-addon']);
                }
                Html::addCssClass($group, 'input-group' . $size . ' select2-bootstrap-prepend');
            }
            if (is_array($append)) {
                $newappend = '';
                foreach ($append as $eachappend)
                {
                    $content = ArrayHelper::getValue($eachappend, 'content', '');
                    if (isset($eachappend['asButton']) && $eachappend['asButton'] == true) {
                        $newappend .= Html::tag('div', $content, ['class' => 'input-group-btn']);
                    } else {
                        $newappend .= Html::tag('span', $content, ['class' => 'input-group-addon']);
                    }
                    Html::addCssClass($group, 'input-group' . $size . ' select2-bootstrap-append');
                    
                    //original code
                    /* 
                    $content = ArrayHelper::getValue($append, 'content', '');
                    if (isset($append['asButton']) && $append['asButton'] == true) {
                        $append = Html::tag('div', $content, ['class' => 'input-group-btn']);
                    } else {
                        $append = Html::tag('span', $content, ['class' => 'input-group-addon']);
                    }
                    Html::addCssClass($group, 'input-group' . $size . ' select2-bootstrap-append');
                    */
                }
            }
            $addonText = $prepend . $input . $newappend;
            $contentBefore = ArrayHelper::getValue($addon, 'contentBefore', '');
            $contentAfter = ArrayHelper::getValue($addon, 'contentAfter', '');
            return Html::tag('div', $contentBefore . $addonText . $contentAfter, $group);
        }
        return $input;
    }
}

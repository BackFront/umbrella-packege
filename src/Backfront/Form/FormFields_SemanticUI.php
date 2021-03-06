<?php
/**
 * <h1>FormFieldsSemanticUI</h1>
 * 
 * Project Name: Backfront
 * Project URI: https://github.com/BackFront/umbrella-packege
 * Description: Generate the HTML fields
 * Version: 1.0.0
 * Author: Douglas Alves
 * Author URI: http://alvesdouglas.com.br/
 * License: Apache License 2.0
 * 
 * @package Backfront
 * @subpackage Form
 * @version 1.0.0
 * 
 * @author Douglas Alves <alves.douglaz@gmail.com>
 * @link https://github.com/BackFront/backfront-package Project Repository
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License 2.0
 * @since 1.0.0
 * 
 * FIELDS:
 * - text
 * - textarea
 * - number
 * - checkbox
 * - radio
 * - select
 * - file input/media
 * - image input
 * - submit
 * - button
 * - hidden
 * - title
 * - separator
 * - url
 * - color picker
 * - icon_picker
 * - date
 * - custom
 */

namespace Backfront\Form
{

    use Backfront\Form\IFormFields;

    class FormFields_SemanticUI implements IFormFields
    {

        public function __call($name, $arguments)
        {
            trigger_error("O field de tipo <i>{$name}</i> não pode ser gerado", E_USER_WARNING);
        }

        public static function text($args)
        {
            $default_args = array(
                "input" => [
                    "attrs" => [
                        "id" => '',
                        "name" => (!empty($args['name'])) ? $args['name'] : $args['id'],
                        "type" => 'text',
                    ]
                ]
            );

            $args_ = array_replace_recursive($default_args, $args);

            $attrs_input = (!empty($args_['input']['attrs'])) ? self::get_attrs($args_['input']['attrs']) : null;
            $attrs_label = (!empty($args_['label']['attrs'])) ? self::get_attrs($args_['label']['attrs']) : null;

            $html = "<label {$attrs_label} for=\"{$args['id']}\">{$args['label']}</label>";
            $html .= "<input {$attrs_input}>";

            return self::field_wrapp($html);
        }

        public static function textarea($args)
        {
            $default_args = array(
                "textarea" => [
                    "attrs" => [
                        "id" => $args['id'],
                        "name" => (!empty($args['name'])) ? $args['name'] : $args['id'],
                        "row" => 3,
                    ]
                ]
            );

            $args_ = array_replace_recursive($default_args, $args);

            $attrs_textarea = (!empty($args_['textarea']['attrs'])) ? self::get_attrs($args_['textarea']['attrs']) : null;
            $attrs_label = (!empty($args_['label']['attrs'])) ? self::get_attrs($args_['label']['attrs']) : null;

            $html = "<label {$attrs_label} for=\"{$args['id']}\">{$args['label']} </label>";
            $html .= "<textarea {$attrs_textarea}></textarea>";
            return self::field_wrapp($html);
        }

        public static function checkbox($args)
        {
            $default_args = array(
                "input" => [
                    "attrs" => [
                        "id" => $args['id'],
                        "name" => (!empty($args['name'])) ? $args['name'] : $args['id'],
                        "type" => 'checkbox',
                        "tabindex" => 0,
                        "class" => array('hidden')
                    ]
                ]
            );

            $args_ = array_replace_recursive($default_args, $args);

            $attrs_input = (!empty($args_['input']['attrs'])) ? self::get_attrs($args_['input']['attrs']) : null;

            $html = "<div class=\"ui toggle checkbox " . self::is_checked($args) . "\"> ";
            $html .= "<input {$attrs_input} " . self::is_disabled($args) . ">";
            $html .= "<label>{$args['label']}</label>";
            $html .= "</div>";

            return self::field_wrapp($html, array("class" => "inline field " . self::is_disabled($args)));
        }

        /**
         * <h3>radio</h3>
         * 
         * @param array $args['variation'] Different styles, choice between: slider | toggle | radio(default)
         */
        public static function radio($args)
        {
            $args['input']['attrs']['type'] = 'radio';
            $args['input']['attrs']['value'] = (isset($args['value'])) ? $args['value'] : null;
            $args['input']['attrs']['name'] = (!empty($args['name'])) ? $args['name'] : $args['id'];

            $args['variation'] = (isset($args['variation'])) ? $args['variation'] : 'radio';

            $attrs_input = (!empty($args['input']['attrs'])) ? self::get_attrs($args['input']['attrs']) : null;

            $html = "<div class=\"ui {$args['variation']} checkbox\">";
            $html .= "  <input {$attrs_input}" . self::is_checked($args) . self::is_disabled($args) . "> ";
            $html .= "  <label>{$args['label']}</label>";
            $html .= "</div>";

            return self::field_wrapp($html, array("class" => "inline field " . self::is_disabled($args)));
        }

        public static function select($args)
        {
            $args['select']['attrs']['id'] = $args['id'];
            $args['select']['attrs']['name'] = (!empty($args['input']['attrs']['name'])) ? $args['name'] : $args['id'];
            $args['select']['attrs']['class'][] = "ui search selection dropdown";

            $attrs_select = (!empty($args['select']['attrs'])) ? self::get_attrs($args['select']['attrs']) : null;
            $attrs_label = (!empty($args['label']['attrs'])) ? self::get_attrs($args['label']['attrs']) : null;

            $html = "  <label {$attrs_label} for=\"{$args['id']}\">{$args['label']}</label>";
            $html .= "<select {$attrs_select} " . self::is_multiple($args) . " data-dropdown>";
            foreach ($args['options'] as $key => $value) {
                if (!is_array($value)):
                    $html .= "<option value=\"{$key}\" " . self::is_selected($key, $args['selected']) . ">{$value}</option>";
                else:
                    $html .= "<option value=\"{$key}\" " . self::get_attrs($value['attrs']) . self::is_selected($key, $args['selected']) . ">{$value['value']}</option>";
                endif;
            }
            $html .="</select>";
            return self::field_wrapp($html);
        }

        public static function file_input($args)
        {
            $args['input']['attrs']['id'] = $args['id'];
            $args['input']['attrs']['name'] = (!empty($args['select']['attrs']['name'])) ? $args['name'] : $args['id'];
            $args['input']['attrs']['type'] = 'file';

            $attrs_label = (!empty($args['label']['attrs'])) ? self::get_attrs($args['label']['attrs']) : null;
            $attrs_input = (!empty($args['input']['attrs'])) ? self::get_attrs($args['input']['attrs']) : null;

            $html = "<label {$attrs_label} for=\"{$args['id']}\">{$args['label']} </label>";
            $html .= "<input {$attrs_input} " . self::is_multiple($args) . ">";
            return self::field_wrapp($html);
        }

        public static function submit($args)
        {
            
        }

        public static function button($args)
        {
            $args['button']['attrs']['type'] = "button";
            $args['button']['attrs']['id'] = $args['id'];
            $args['button']['attrs']['name'] = (!empty($args['button']['attrs']['name'])) ? $args['name'] : $args['id'];

            $args['button']['attrs']['class'] = (!isset($args['button']['attrs']['class'])) ? 'ui button' : $args['button']['attrs']['class'];

            $attrs_button = (!empty($args['button']['attrs'])) ? self::get_attrs($args['button']['attrs']) : null;

            return $html = "<button {$attrs_button}>{$args['label']}</button> ";
        }

        public static function title($args)
        {
            $title = $args['title'];
            $subtitle = (isset($args['subtitle'])) ? $args['subtitle'] : null;

            $attrs = (!empty($args['attrs'])) ? self::get_attrs($args['attrs']) : null;

            return sprintf("<h2 class=\"ui dividing header\" %s>%s <div class=\"sub header\">%s</div></h2>", $attrs, $title, $subtitle);
        }

        public static function separator()
        {
            return "<hr />";
        }

        public static function url($args)
        {
            $args['input']['attrs']['id'] = $args['id'];
            $args['input']['attrs']['name'] = (!empty($args['select']['attrs']['name'])) ? $args['name'] : $args['id'];
            $args['input']['attrs']['type'] = 'text';

            $attrs_input = (!empty($args['input']['attrs'])) ? self::get_attrs($args['input']['attrs']) : null;
            $attrs_label = (!empty($args['label']['attrs'])) ? self::get_attrs($args['label']['attrs']) : null;

            $html = sprintf("<label %s for=\"%s\">%s</label>", $attrs_label, $args['id'], $args['label']);
            $html .= "<div class=\"ui labeled fluid input\">";
            $html .= "  <div class=\"ui label\">http:// </div>";
            $html .= sprintf("  <input %s>", $attrs_input);
            $html .= "</div>";

            return self::field_wrapp($html);
        }

        /**
         * <h3>is_selected</h3>
         * 
         * Verify if the current value is selected
         * <small>use the database value in variable $selected</small>
         * 
         * @param string $current
         * @param string $selected
         * @param string $type
         * @return string
         */
        public static function is_selected($current, $selected, $type = "select")
        {
            if (is_array($selected) && in_array($current, $selected))
                return "selected=\"selected\" ";

            if ($current == $selected && $type == 'select')
                return "selected=\"selected\" ";

            if ($current == $selected && $type == 'check')
                return "checked=\"checked\" ";
            return;
        }

        public static function is_checked($args)
        {
            return (isset($args['checked']) && $args['checked'] === true) ? "checked" : null;
        }

        public static function is_disabled($args)
        {
            return (isset($args['disabled']) && $args['disabled'] === true) ? "disabled" : null;
        }

        public static function is_multiple($args)
        {
            return (isset($args['multiple']) && $args['multiple'] === true) ? "multiple" : null;
        }

        public static function field_wrapp($html_field, array $args = null)
        {
            $class = (!empty($args['class'])) ? $args['class'] : 'field'; //default: semantic-ui class
            return "<div class=\"{$class}\">{$html_field}</div>";
        }

        public static function get_attrs(array $attrs = null)
        {
            $str_attrs = null;
            foreach ($attrs as $key => $value):
                if (is_array($value)) {
                    $value = implode(" ", $value);
                }
                $str_attrs.= "{$key}=\"{$value}\" ";
            endforeach;
            return $str_attrs;
        }

    }
}

<?php
class Html 
{
    public static function options( $opts, $sel = null )
    { 
        $html = "";
        foreach ($opts as $k => $v) {
            if (is_array($v)) {
                $html .= "<optgroup label='{$k}'>";
                foreach ($v as $k2=>$v2) {
                    $selected = ( $sel!==null && $k2==$sel ) ? "selected" : "";
                    $html .= "<option value='{$k2}' {$selected}>{$v2}</option>";
                }
                $html .= "</optgroup>";
            } else {
                $selected = ( $sel!==null && $k2==$sel ) ? 'selected' : '';
                $html .= "<option value='{$k}' {$selected}>{$v}</option>";
            }
        }
        return $html;
    }
}
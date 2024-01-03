<?php
namespace FastFramework;

class Shortcode {
    private $shortcodes = [];
    
    public function addShortcode($tag, $callback) {
        $this->shortcodes[$tag] = $callback;
    }

    public function doShortcode($content) {
        foreach ($this->shortcodes as $tag => $callback) {
            $pattern = '/\\[' . preg_quote($tag) . '\\]/';
            $content = preg_replace_callback($pattern, function ($matches) use ($callback) {
                return call_user_func($callback);
            }, $content);
        }
        return $content;
    }
}

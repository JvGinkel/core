<?php
namespace core;

trait SanitizeStrippers {
    public static function numberchars() {
        return "/[^A-Za-z0-9]/";
    }
    public static function slug() {
        return "/[^A-Za-z0-9_\-]/";
    }
    public static function text() {
        return "/[^[:alnum:][:space:]_\-\(\)+]/u";
    }
    public static function chars() {
        return "/[^A-Za-z]/";
    }
}

class Sanitize {
    use SanitizeStrippers;

    /**
     * Strip off non-matching characters
     */
    public static function strip($txt, array $rules) {
        // Validation on test-env
        // TODO: Skip on live?
        if (count($rules) === 0) {
            user_error("DevErr: No rules given to Sanitize");
        }
        if (is_array($txt) || is_object($txt)) {
            user_error("DevErr: txt invalid");
        }
        $sane = $txt;
        foreach ($rules as $rule) {
            $sane = preg_replace(self::$rule(), '', $sane);
        }
        return $sane;
    }

    /**
     * Convert given string into generic key
     */
    public static function key($txt) {
        return strtoupper(self::strip($txt, ["chars"]));
    }
}

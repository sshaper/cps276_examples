<?php
/**
 * Validation.php — reusable format checks (regex)
 *
 * Controllers call checkFormat(). JavaScript does not re-implement these patterns.
 * PHP is the final validation layer because browser checks can be skipped.
 */
class Validation {
    private $errors = [];

    /**
     * @param string $value          The user input to test
     * @param string $type           A key in $patterns: name, phone, address, zip, email, none
     * @param string|null $customErrorMsg Optional message stored if the check fails
     * @return bool true if the value matches the pattern
     */
    public function checkFormat($value, $type, $customErrorMsg = null) {
        $patterns = [
            'name' => '/^[a-z\'\s-]{1,50}$/i',          // letters, space, hyphen, apostrophe
            'phone' => '/^\d{3}\.\d{3}\.\d{4}$/',         // 123.456.7890
            'address' => '/^[a-zA-Z0-9\s,.\'-]{1,100}$/',
            'zip' => '/^\d{5}(-\d{4})?$/',                // 12345 or 12345-6789
            'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'none' => '/.*/'                              // anything (rarely used here)
        ];

        // Unknown $type falls back to "match everything" so the call does not crash.
        $pattern = $patterns[$type] ?? '/.*/';

        if (!preg_match($pattern, $value)) {
            $errorMessage = $customErrorMsg ?? "Invalid $type format.";
            $this->errors[$type] = $errorMessage;
            return false;
        }
        return true;
    }

    // All messages stored by failed checkFormat calls
    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }
}
?>

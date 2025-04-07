<?php
/**
 * Validation Class
 * Provides validation functionality for form inputs using regex patterns
 * Handles common validation patterns like names, phone numbers, emails, etc.
 */

class Validation {
    // Array to store validation error messages
    private $errors = [];

    /**
     * Validates a value against a specified regex pattern
     * param string $value - The value to validate
     * param string $type - The type of validation to perform (name, phone, address, etc.)
     * param string|null $customErrorMsg - Optional custom error message to display
     * return bool - True if validation passes, false otherwise
     */
    public function checkFormat($value, $type, $customErrorMsg = null) {
        // Define regex patterns for different types of validation
        $patterns = [
            'name' => '/^[a-z\'\s-]{1,50}$/i',      // Allows letters, spaces, hyphens, and apostrophes
            'phone' => '/^\d{3}\.\d{3}\.\d{4}$/',   // Format: XXX.XXX.XXXX
            'address' => '/^[a-zA-Z0-9\s,.\'-]{1,100}$/', // Allows letters, numbers, spaces, and common address characters
            'zip' => '/^\d{5}(-\d{4})?$/',          // 5 digits or 5+4 format
            'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Standard email format
            'none' => '/.*/'                        // Accepts any input
        ];
            
        // Use a generic default pattern if the type is not defined
        $pattern = $patterns[$type] ?? '/.*/';

        // Check if the value matches the pattern
        if (!preg_match($pattern, $value)) {
            // Set error message (use custom message if provided, otherwise use default)
            $errorMessage = $customErrorMsg ?? "Invalid $type format.";
            $this->errors[$type] = $errorMessage;
            return false;
        }
        return true;
    }

    /**
     * Retrieves all validation errors
     * return array - Array of error messages indexed by validation type
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Checks if there are any validation errors
     * return bool - True if there are errors, false otherwise
     */
    public function hasErrors() {
        return !empty($this->errors);
    }
}
?>

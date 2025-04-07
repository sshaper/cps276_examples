<?php
/**
 * StickyForm Class
 * Extends the Validation class to provide form validation and rendering capabilities
 * This class handles form validation, maintains form values after submission, and renders form elements
 */

require_once 'Validation.php';

class StickyForm extends Validation {
    /**
     * Validates form inputs and retains their values after submission
     * param array $data - The submitted form data
     * param array $formConfig - Configuration array containing form element definitions
     * return array - Updated form configuration with validation results and retained values
     */
    public function validateForm($data, $formConfig) {
        foreach ($formConfig as $key => &$element) {
            // Store the submitted value for each form element

            //print_r($data[$key]);

            $element['value'] = $data[$key] ?? '';

            // Get custom error message if defined
            $customErrorMsg = $element['errorMsg'] ?? null;

            // Handle text and textarea inputs
            if (isset($element['type']) && in_array($element['type'], ['text', 'textarea']) && isset($element['regex'])) {
                // Check if required field is empty
                if ($element['required'] && empty($element['value'])) {
                    $element['error'] = $customErrorMsg ?? 'This field is required.';
                    $formConfig['masterStatus']['error'] = true;
                } elseif (!$element['required'] && empty($element['value'])) {
                    // Skip validation for optional empty fields
                } else {
                    // Validate field against regex pattern
                    $isValid = $this->checkFormat($element['value'], $element['regex'], $customErrorMsg);
                    if (!$isValid) {
                        $element['error'] = $this->getErrors()[$element['regex']];
                    }
                }
            }
            
            // Handle select dropdowns
            elseif (isset($element['type']) && $element['type'] === 'select') {
                $element['selected'] = $data[$key] ?? '';
                // Validate required select fields
                if (isset($element['required']) && $element['required'] && ($element['selected'] === '0' || empty($element['selected']))) {
                    $element['error'] = $customErrorMsg ?? 'This field is required.';
                    $formConfig['masterStatus']['error'] = true;
                }
            }
            
            // Handle checkbox inputs (both single and groups)
            elseif (isset($element['type']) && $element['type'] === 'checkbox') {
                if (isset($element['options'])) {
                    // Handle checkbox groups
                    $anyChecked = false;
                    foreach ($element['options'] as &$option) {
                        $option['checked'] = in_array($option['value'], $data[$key] ?? []);
                        if ($option['checked']) {
                            $anyChecked = true;
                        }
                    }
                    // Validate required checkbox groups
                    if (isset($element['required']) && $element['required'] && !$anyChecked) {
                        $element['error'] = $customErrorMsg ?? 'This field is required.';
                        $formConfig['masterStatus']['error'] = true;
                    }
                } else {
                    // Handle single checkbox
                    $element['checked'] = isset($data[$key]);
                    if (isset($element['required']) && $element['required'] && !$element['checked']) {
                        $element['error'] = $customErrorMsg ?? 'This field is required.';
                        $formConfig['masterStatus']['error'] = true;
                    }
                }
            }
            // Handle radio button groups
            elseif (isset($element['type']) && $element['type'] === 'radio') {
                $isChecked = false;
                foreach ($element['options'] as &$option) {
                    $option['checked'] = ($option['value'] === ($data[$key] ?? ''));
                    if ($option['checked']) {
                        $isChecked = true;
                    }
                }
                // Validate required radio groups
                if (isset($element['required']) && $element['required'] && !$isChecked) {
                    $element['error'] = $customErrorMsg ?? 'This field is required.';
                    $formConfig['masterStatus']['error'] = true;
                }
            }
        }
        return $formConfig;
    }

    /**
     * Generates HTML for select options
     * param array $options - Array of options with values as keys and labels as values
     * param string $selectedValue - Currently selected value
     * return string - HTML for select options
     */
    public function createOptions($options, $selectedValue) {
        $html = '';
        foreach ($options as $value => $label) {
            $selected = ($value == $selectedValue) ? 'selected' : '';
            $html .= "<option value=\"$value\" $selected>$label</option>";
        }
        return $html;
    }

    /**
     * Renders error message for a form element
     * param array $element - Form element configuration
     * return string - HTML for error message
     */
    private function renderError($element) {
        return !empty($element['error']) ? "<span class=\"text-danger\">{$element['error']}</span><br>" : '';
    }

    /**
     * Renders a text input field
     * param array $element - Form element configuration
     * param string $class - Additional CSS classes
     * return string - HTML for text input
     */
    public function renderInput($element, $class = '') {
        $errorOutput = $this->renderError($element);
        return <<<HTML
<div class="$class">
    <label for="{$element['id']}">{$element['label']}</label>
    <input type="text" class="form-control" id="{$element['id']}" name="{$element['name']}" value="{$element['value']}">
    $errorOutput
</div>
HTML;
    }

    /**
     * Renders a textarea field
     * param array $element - Form element configuration
     * param string $class - Additional CSS classes
     * return string - HTML for textarea
     */
    public function renderTextarea($element, $class = '') {
        $errorOutput = $this->renderError($element);
        return <<<HTML
<div class="$class">
    <label for="{$element['id']}">{$element['label']}</label>
    <textarea class="form-control" id="{$element['id']}" name="{$element['name']}">{$element['value']}</textarea>
    $errorOutput
</div>
HTML;
    }

    /**
     * Renders a group of radio buttons
     * param array $element - Form element configuration
     * param string $class - Additional CSS classes
     * param string $layout - Layout style ('vertical' or 'horizontal')
     * return string - HTML for radio button group
     */
    public function renderRadio($element, $class = '', $layout = 'vertical') {
        $errorOutput = $this->renderError($element);
        $optionsHtml = '';
        $layoutClass = $layout === 'horizontal' ? 'form-check-inline' : '';
        foreach ($element['options'] as $option) {
            $checked = $option['checked'] ? 'checked' : '';
            $optionsHtml .= <<<HTML
<div class="form-check $layoutClass">
    <input class="form-check-input" type="radio" id="{$element['id']}_{$option['value']}" name="{$element['name']}" value="{$option['value']}" $checked>
    <label class="form-check-label" for="{$element['id']}_{$option['value']}">{$option['label']}</label>
</div>
HTML;
        }
        return <<<HTML
<div class="$class">
    <label>{$element['label']}</label><br>
    $optionsHtml
    $errorOutput
</div>
HTML;
    }

    /**
     * Renders a single checkbox
     * param array $element - Form element configuration
     * param string $class - Additional CSS classes
     * param string $layout - Layout style ('vertical' or 'horizontal')
     * return string - HTML for checkbox
     */
    public function renderCheckbox($element, $class = '', $layout = 'vertical') {
        $checked = $element['checked'] ? 'checked' : '';
        $errorOutput = $this->renderError($element);
        $layoutClass = $layout === 'horizontal' ? 'form-check-inline' : '';
        return <<<HTML
<div class="$class">
    <div class="form-check $layoutClass">
        <input class="form-check-input" type="checkbox" id="{$element['id']}" name="{$element['name']}" $checked>
        <label class="form-check-label" for="{$element['id']}">{$element['label']}</label>
    </div>
    $errorOutput
</div>
HTML;
    }

    /**
     * Renders a group of checkboxes
     * param array $element - Form element configuration
     * param string $class - Additional CSS classes
     * param string $layout - Layout style ('vertical' or 'horizontal')
     * return string - HTML for checkbox group
     */
    public function renderCheckboxGroup($element, $class = '', $layout = 'vertical') {
        $errorOutput = $this->renderError($element);
        $optionsHtml = '';
        $layoutClass = $layout === 'horizontal' ? 'form-check-inline' : '';
        foreach ($element['options'] as $index => $option) {
            $checked = $option['checked'] ? 'checked' : '';
            $optionsHtml .= <<<HTML
<div class="form-check $layoutClass">
    <input class="form-check-input" type="checkbox" id="{$element['id']}_{$index}" name="{$element['name']}[]" value="{$option['value']}" $checked>
    <label class="form-check-label" for="{$element['id']}_{$index}">{$option['label']}</label>
</div>
HTML;
        }
        return <<<HTML
<div class="$class">
    <label>{$element['label']}</label><br>
    $optionsHtml
    $errorOutput
</div>
HTML;
    }

    /**
     * Renders a select dropdown
     * param array $element - Form element configuration
     * param string $class - Additional CSS classes
     * return string - HTML for select dropdown
     */
    public function renderSelect($element, $class = '') {
        $errorOutput = $this->renderError($element);
        $optionsHtml = $this->createOptions($element['options'], $element['selected']);
        return <<<HTML
<div class="$class">
    <label for="{$element['id']}">{$element['label']}</label>
    <select class="form-control" id="{$element['id']}" name="{$element['name']}">
        $optionsHtml
    </select>
    $errorOutput
</div>
HTML;
    }
}
?>

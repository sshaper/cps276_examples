<?php
require_once 'Validation.php';

class StickyForm extends Validation {
    // Validate form inputs and retain their values
    public function validateForm($data, $formConfig) {
        foreach ($formConfig as $key => &$element) {
            $element['value'] = $data[$key] ?? '';

            $customErrorMsg = $element['errorMsg'] ?? null;

            if (isset($element['type']) && in_array($element['type'], ['text', 'textarea']) && isset($element['regex'])) {
                if ($element['required'] && empty($element['value'])) {
                    $element['error'] = $customErrorMsg ?? 'This field is required.';
                    $formConfig['masterStatus']['error'] = true;
                } elseif (!$element['required'] && empty($element['value'])) {
                    // Do nothing if the field is not required and the value is empty
                } else {
                    $isValid = $this->checkFormat($element['value'], $element['regex'], $customErrorMsg);
                    if (!$isValid) {
                        $element['error'] = $this->getErrors()[$element['regex']];
                    }
                }
            }
            

            elseif (isset($element['type']) && $element['type'] === 'select') {
                $element['selected'] = $data[$key] ?? '';
                if (isset($element['required']) && $element['required'] && ($element['selected'] === '0' || empty($element['selected']))) {
                    $element['error'] = $customErrorMsg ?? 'This field is required.';
                    $formConfig['masterStatus']['error'] = true;
                }
            }
            

            elseif (isset($element['type']) && $element['type'] === 'checkbox') {
                if (isset($element['options'])) {
                    $anyChecked = false;
                    foreach ($element['options'] as &$option) {
                        $option['checked'] = in_array($option['value'], $data[$key] ?? []);
                        if ($option['checked']) {
                            $anyChecked = true;
                        }
                    }
                    if (isset($element['required']) && $element['required'] && !$anyChecked) {
                        $element['error'] = $customErrorMsg ?? 'This field is required.';
                        $formConfig['masterStatus']['error'] = true;
                    }
                } else {
                    $element['checked'] = isset($data[$key]);
                    if (isset($element['required']) && $element['required'] && !$element['checked']) {
                        $element['error'] = $customErrorMsg ?? 'This field is required.';
                        $formConfig['masterStatus']['error'] = true;
                    }
                }
            }
            elseif (isset($element['type']) && $element['type'] === 'radio') {
                $isChecked = false;
                foreach ($element['options'] as &$option) {
                    $option['checked'] = ($option['value'] === ($data[$key] ?? ''));
                    if ($option['checked']) {
                        $isChecked = true;
                    }
                }
                if (isset($element['required']) && $element['required'] && !$isChecked) {
                    $element['error'] = $customErrorMsg ?? 'This field is required.';
                    $formConfig['masterStatus']['error'] = true;
                }
            }
        }
        return $formConfig;
    }

    // Generate HTML for select options
    public function createOptions($options, $selectedValue) {
        $html = '';
        foreach ($options as $value => $label) {
            $selected = ($value == $selectedValue) ? 'selected' : '';
            $html .= "<option value=\"$value\" $selected>$label</option>";
        }
        return $html;
    }

    // Helper function to render error messages
    private function renderError($element) {
        return !empty($element['error']) ? "<span class=\"text-danger\">{$element['error']}</span><br>" : '';
    }

    // Render text input field
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

    // Render textarea field
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

    // Render radio buttons
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

    // Render checkbox
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

    // Render checkbox group
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

    // Render select box
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

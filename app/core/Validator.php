<?php
namespace App\Core;

class Validator {
    private $errors = [];
    private $data;

    public function validate($data, $rules) {
        $this->data = $data;
        $this->errors = [];

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $this->validateField($field, $rule);
            }
        }

        return empty($this->errors);
    }

    private function validateField($field, $rule) {
        $value = $this->data[$field] ?? null;

        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, 'Field is required');
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'Invalid email format');
                }
                break;

            case 'numeric':
                if (!is_numeric($value)) {
                    $this->addError($field, 'Must be a number');
                }
                break;

            case 'min:8':
                if (strlen($value) < 8) {
                    $this->addError($field, 'Minimum 8 characters required');
                }
                break;
        }
    }

    private function addError($field, $message) {
        $this->errors[$field][] = $message;
    }

    public function getErrors() {
        return $this->errors;
    }
}

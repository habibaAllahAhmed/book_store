<?php
require_once __DIR__ . "/database.php";

class validation
{
    private array $data;
    private array $rules;
    private array $errors = [];


    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): array
    {

        foreach ($this->rules as $field => $rules) {
            $value = $this->data[$field] ?? null;
            foreach ($rules as $rule) {
                if (is_string($rule)) {

                    if ($rule === 'required') {
                        $this->validateRequired($field, $value);
                    } else if ($rule === 'email') {
                        $this->validateEmail($field, $value);
                    } else if ($rule === 'egPhone') {
                        $this->validatePhone($field, $value);
                    }
                } else if (is_array($rule)) {
                    if ($rule[0] == 'min') {
                        $this->validateMin($field, $value, $rule[1]);
                    } else if ($rule[0] == 'unique') {
                        $this->validateUnique($field, $value, $rule[1], $rule[2] ?? null);
                    } else if ($rule[0] == 'exists') {
                        $this->validateExists($field, $value, $rule[1], $rule[2] ?? null);
                    }
                }
            }
        }

        return $this->errors;
    }

    private function addError(string $field, string $msg): void
    {
        $this->errors[$field][] = $msg;
    }

    private function validateRequired(string $field, mixed $value): void
    {
        if ($value === null || trim((string)$value) === "") {

            $this->addError($field, "{$field} is required.");
        }
    }

    private function validatePhone(string $field, mixed $value)
    {
        if (empty($value)) {
            return;
        }

        $regex = "/^(02)?01(0|1|2|5)[0-9]{8}$/";

        if (!preg_match($regex, $value)) {
            $this->addError($field, "{$field} must be Egyptian Phone");
        }
    }

    private function validateEmail(string $field, mixed $value): void
    {
        if (empty($value)) {
            return;
        }

        $regex = "/^[A-Za-z_][A-Za-z_0-9\.\-]+@(gmail|yahoo)\.(com|org)$/";

        if (!preg_match($regex, $value)) {
            $this->addError($field, "{$field} must be valid email.");
        }
    }


    private function validateMin(string $field, mixed $value, int $min = 8): void
    {
        if (empty($value)) {
            return;
        }

        if (strlen($value) < $min) {
            $this->addError($field, "{$field} must be at least {$min} characters.");
        }
    }

    private function validateUnique(string $field, mixed $value, string $tableName, ?int $exceptId = null): void
    {
        $DB = database::getConnection();

        $subQuery = "";

        if ($exceptId !== null) {
            $subQuery = "AND id != '{$exceptId}'";
        }


        $stmt = $DB->query("SELECT * FROM {$tableName} WHERE {$field} = '{$value}' {$subQuery};");

        $result = $stmt->fetchAll();

        if (!empty($result)) {
            $this->addError($field, "{$field} is already exists");
        }
    }


    private function validateExists(string $field, mixed $value, string $tableName, string $columnName): void
    {
        $DB = database::getConnection();

        $stmt = $DB->query("SELECT * FROM {$tableName} WHERE {$columnName} = '{$value}';");

        $result = $stmt->fetchAll();

        if (empty($result)) {
            $this->addError($field, "{$field} is not exists");
        }
    }
}

<?php

namespace App\Helper;

use Illuminate\Support\Str;

class FormControlHelper
{
    public static function text(
        string $name,
        int $column_length,
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                $attribute .= $val ? $key . ' ' : '';
            } elseif ($key == 'readonly') {
                $attribute .= $val ? $key . ' ' : '';
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $is_currency = false;
        if (in_array('form-currency', $class)) {
            $is_currency = true;
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
            'is_currency' => $is_currency,
        ];

        return view('partials.form-control.text', $data);
    }

    public static function password(
        string $name,
        int $column_length,
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                $attribute .= $val ? $key . ' ' : '';
            } elseif ($key == 'readonly') {
                $attribute .= $val ? $key . ' ' : '';
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.password', $data);
    }

    public static function email(
        string $name,
        int $column_length,
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                $attribute .= $val ? $key . ' ' : '';
            } elseif ($key == 'readonly') {
                $attribute .= $val ? $key . ' ' : '';
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.email', $data);
    }

    public static function date(
        string $name,
        int $column_length,
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                $attribute .= $val ? $key . ' ' : '';
            } elseif ($key == 'readonly') {
                $attribute .= $val ? $key . ' ' : '';
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $is_range = false;
        if (in_array('form-date-range', $class)) {
            $is_range = true;
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
            'is_range' => $is_range,
        ];

        return view('partials.form-control.date', $data);
    }

    public static function select(
        string $name,
        int $column_length,
        bool $optgroup = false,
        array $items = array(),
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                if ($val) {
                    $attribute .= $key . '=true ';
                } else {
                    $attribute .= $key . '=false ';
                }
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'optgroup' => $optgroup,
            'items' => $items,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.select', $data);
    }

    public static function checkbox(
        string $name,
        int $column_length,
        array $items = array(),
        string $label = null,
        $value = array(),
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                if ($val) {
                    $attribute .= $key . '=true ';
                } else {
                    $attribute .= $key . '=false ';
                }
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'items' => $items,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.checkbox', $data);
    }

    public static function radiobox(
        string $name,
        int $column_length,
        array $items = array(),
        string $label = null,
        $value = array(),
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                if ($val) {
                    $attribute .= $key . '=true ';
                } else {
                    $attribute .= $key . '=false ';
                }
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'items' => $items,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.radiobox', $data);
    }

    public static function file(
        string $name,
        int $column_length,
        array $filetypes = array(),
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                $attribute .= $val ? $key . ' ' : '';
            } elseif ($key == 'readonly') {
                $attribute .= $val ? $key . ' ' : '';
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        if (!empty($filetypes)) {
            $filetypes = implode(', ', $filetypes);
            $filetypes = 'accept="' . $filetypes . '"';
        } else {
            $filetypes = '';
        }

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'filetypes' => $filetypes,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.file', $data);
    }

    public static function switch(
        string $name,
        int $column_length,
        string $label = null,
        $value = null,
        $tooltip = null,
        array $class = array(),
        array $attrs = array()
    ) {
        if ($label === null) {
            $label = Str::ucfirst($name);
        }

        $column_length = 'col-sm-12 col-md-' . $column_length;

        $attribute = '';
        $required = false;
        foreach ($attrs as $key => $val) {
            if ($key == 'required') {
                $required = $val;
                $attribute .= $val ? $key . ' ' : '';
            } elseif ($key == 'readonly') {
                $attribute .= $val ? $key . ' ' : '';
            } else {
                $attribute .= $key . '=' . $val . ' ';
            }
        }

        $class = implode(' ', $class);

        $data = [
            'name' => $name,
            'column_length' => $column_length,
            'label' => $label,
            'value' => $value,
            'tooltip' => $tooltip,
            'attribute' => $attribute,
            'class' => $class,
            'required' => $required,
        ];

        return view('partials.form-control.switch', $data);
    }
}

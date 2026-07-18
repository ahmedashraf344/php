<?php

use \Illuminate\Support\Facades\URL;

if (!function_exists('is_active')) {
    function is_active($name)
    {
        return request()->routeIs($name) ? 'active' : '';
    }
}

if (!function_exists('is_active_url')) {
    function is_active_url($route,$params)
    {
        return URL::current() == route($route,$params) ? 'active' : null;
    }
}

if (!function_exists('is_collapse')) {
    function is_collapse($name)
    {
        return !request()->routeIs($name) ? 'collapse' : '';
    }
}

if (!function_exists('is_active_collapse')) {
    function is_active_collapse($name, $type)
    {
        return (request()->routeIs($name) && request()->get('type') == $type) ? 'active' : '';
    }
}

if (!function_exists('active_single_collapse')) {
    function active_single_collapse($name)
    {
        return request()->routeIs($name) ? 'active' : '';
    }
}

if (!function_exists('show_collapsed')) {
    function show_collapsed($name)
    {
        return is_active($name) ? 'show' : '';
    }
}

if (!function_exists('area_expand')) {
    function area_expand($name)
    {
        return request()->routeIs($name) ? 'true' : '';
    }
}

if (!function_exists('has_error')) {
    function has_error($errors, $input)
    {
        if ($errors->any()) {
            return $errors->has($input) ? 'has-danger' : 'has-success';
        }
    }
}

if (!function_exists('is_invalid')) {
    function is_invalid($errors, $input)
    {
        if ($errors->any()) {
            return $errors->has($input) ? 'is-invalid' : 'is-valid';
        }
    }
}

if (!function_exists('input_error')) {
    function input_error($errors, $input)
    {
        if ($errors->has($input)) {
            echo '<div class="clearfix"></div><span id="' . $input . '-error" class="help-block error-help-block">' .
                $errors->first($input)
                . '</span>';
        }
    }
}

if (!function_exists('tooltip')) {
    function tooltip($title, $placement = 'top')
    {
        echo 'data-toggle="tooltip" data-placement="' . $placement . '" title="' . $title . '"';
    }
}

if (!function_exists('select_input_val')) {
    function select_input_val($value, $old = null, $exist = null)
    {
        if ($old) {
            echo $old == $value ? 'selected' : null;
        } else {
            echo $exist == $value ? 'selected' : null;
        }
    }
}

if (!function_exists('select_array_input_val')) {
    function select_array_input_val($value, $old = [], $exist = [])
    {
        if ($old) {
            echo in_array($value, $old) ? 'selected' : null;
        } else {
            echo in_array($value, $exist) ? 'selected' : null;
        }
    }
}

if (!function_exists('checkbox_input_val')) {
    function checkbox_input_val($value, $old = [], $exist = [])
    {
        if ($old) {
            echo in_array($value, $old) ? 'checked' : null;
        } else {
            echo in_array($value, $exist) ? 'checked' : null;
        }
    }
}

if (!function_exists('isset_property')) {
    function isset_property(\Illuminate\Database\Eloquent\Model $variable, string $property)
    {
        return isset($variable) ? optional($variable)[$property] : null;
    }
}


if (!function_exists('old_or_exist')) {
    function old_or_exist(\Illuminate\Database\Eloquent\Model $variable, string $property, $old = null)
    {
        if ($old == null) $old = $property;
        return old($old) ? old($old) : isset_property($variable, $property);
    }
}


//if (!function_exists('inputVal')) {
//    function inputVal($input, $variable = null, $columnName = null)
//    {
//        $columnName ?? $columnName = $input;
//
//        if (old($input)) {
//            echo old($input);
//        } else {
//            if ($variable) echo $variable->$columnName;
//        }
//    }
//}


if (!function_exists('hidden_on_create')) {
    function hidden_on_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? 'd-none' : null;
    }
}

if (!function_exists('hidden_on_show')) {
    function hidden_on_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? 'd-none' : null;
    }
}

if (!function_exists('hidden_on_edit')) {
    function hidden_on_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? 'd-none' : null;
    }
}


if (!function_exists('hidden_if')) {
    function hidden_if($booleanCheck)
    {
        return $booleanCheck ? 'd-none' : '';
    }
}

if (!function_exists('hidden_if_not')) {
    function hidden_if_not($booleanCheck)
    {
        return !$booleanCheck ? 'd-none' : '';
    }
}

if (!function_exists('readonly_on_create')) {
    function readonly_on_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? 'readonly' : '';
    }
}


if (!function_exists('readonly_on_show')) {
    function readonly_on_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? 'readonly' : '';
    }
}


if (!function_exists('readonly_on_edit')) {
    function readonly_on_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? 'readonly' : '';
    }
}

if (!function_exists('readonly_if')) {
    function readonly_if($booleanCheck)
    {
        return $booleanCheck ? 'readonly' : '';
    }
}

if (!function_exists('readonly_if_not')) {
    function readonly_if_not($booleanCheck)
    {
        return !$booleanCheck ? 'readonly' : '';
    }
}

if (!function_exists('disable_on_create')) {
    function disable_on_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? 'disabled' : '';
    }
}


if (!function_exists('disable_on_show')) {
    function disable_on_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? 'disabled' : '';
    }
}


if (!function_exists('disable_on_edit')) {
    function disable_on_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? 'disabled' : '';
    }
}

if (!function_exists('disable_if')) {
    function disable_if($booleanCheck)
    {
        return $booleanCheck ? 'disabled' : '';
    }
}

if (!function_exists('disable_if_not')) {
    function disable_if_not($booleanCheck)
    {
        return !$booleanCheck ? 'disabled' : '';
    }
}

if (!function_exists('tinymce_input')) {
    function tinymce_input()
    {
        return is_show() ? 'disabled-tinymce' : 'tinymce';
    }
}

if (!function_exists('exist_file_data')) {
    function exist_file_data($filePath = null, $action = 'target', $label = null, $enableDelete = false, $updatedObject = null, $modelName = null, $updatedColumn = null, $downloadName = null)
    {
        if ($filePath) {
            $target = ($action == 'target' || !$action) ? 'target=__blank' : null;
            $download = ($action == 'download') ? ('download=' . ($downloadName ?? 'download')) : null;
            $label = $label ?? __('preview');
            $displayDiv = '<a href="' . asset($filePath) . '" ' . $target . ' ' . $download .
                ' class="text-info font-weight-bold ' . (is_show() ?: "mb-2") . '">' . $label . '</a>';
            $deleteButton = null;
            if ($enableDelete) {
                $deleteButton = '<button class="delete-item delete text-danger icon-del pl-2 pr-0 mr-3"
                    route="' . route('dashboard.v1.attachments.custom-destroy', ['attachment_path' => base64_encode($filePath),
                        'updated_object' => $updatedObject, 'model_name' => $modelName, 'updated_column' => $updatedColumn]) . '"'
                    . 'data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '"' . '>'
                    . '<img src="' . asset('assets/images/del.svg') . '" class="lazyload">
                      </button>';
            }
            if ($enableDelete) {
                echo '<div class="preview-exist-file ' . (is_show() ?? "mb-2") . '"> '
                    . $displayDiv . ' ' . $deleteButton
                    . '</div>';
            } else {
                echo '<div class="preview-exist-file ' . (is_show() ?? "mb-2") . '"> ' . $displayDiv . '</div>';
            }
        } else {
            echo '<div class="clearfix"></div><a href="javascript:void(0);" class="text-danger font-weight-bold ' . (is_show() ?: "mb-2") . '">'
                . __('No file uploaded till now') .
                '</a>';
        }
    }
}

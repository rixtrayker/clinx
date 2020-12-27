<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Form::macro('rawLabel', function ($name, $value = null, $options = array()) {
            $label = Form::label($name, '%s', $options);
            return sprintf($label, $value);
        });
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) >= 10;
        });
        Validator::replacer('phone', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Invalid phone number: at least 10 characters');
        });
        Validator::extend('complex', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $value) && strlen($value) >= 8;
        });
        Validator::replacer('complex', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Your password must contain 1 lower case character 1 upper case character one number and not less than 8 character');
        });
        Validator::extend('customDate', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^((20)\d\d)-(0?[1-9]|1[012])-(0?[1-9]|[12][0-9]|3[01])$/', $value) && strlen($value) >= 8;
        });
        Validator::replacer('customDate', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Field format is invalid date');
        });

    }
}

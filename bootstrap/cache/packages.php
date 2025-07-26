<?php return array (
  'barryvdh/laravel-dompdf' => 
  array (
    'aliases' => 
    array (
      'PDF' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
      'Pdf' => 'Barryvdh\\DomPDF\\Facade\\Pdf',
    ),
    'providers' => 
    array (
      0 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
  ),
  'cviebrock/eloquent-sluggable' => 
  array (
    'providers' => 
    array (
      0 => 'Cviebrock\\EloquentSluggable\\ServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/termwind' => 
  array (
    'providers' => 
    array (
      0 => 'Termwind\\Laravel\\TermwindServiceProvider',
    ),
  ),
  'php-flasher/flasher-laravel' => 
  array (
    'aliases' => 
    array (
      'Flasher' => 'Flasher\\Laravel\\Facade\\Flasher',
    ),
    'providers' => 
    array (
      0 => 'Flasher\\Laravel\\FlasherServiceProvider',
    ),
  ),
  'php-flasher/flasher-toastr-laravel' => 
  array (
    'aliases' => 
    array (
      'Toastr' => 'Flasher\\Toastr\\Laravel\\Facade\\Toastr',
    ),
    'providers' => 
    array (
      0 => 'Flasher\\Toastr\\Laravel\\FlasherToastrServiceProvider',
    ),
  ),
);
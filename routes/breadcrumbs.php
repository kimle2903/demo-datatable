<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;



// Home > Blog
Breadcrumbs::for('customer', function (BreadcrumbTrail $trail) {
   
    $trail->push('Consumers', route('home'));
});

// Home > Blog > [Category]
Breadcrumbs::for('customerDetail', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('customer');
    $trail->push("Consumer detail", route('customer.detail', ['id' => $id]));
});


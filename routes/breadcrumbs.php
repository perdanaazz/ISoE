<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('employee', function (BreadcrumbTrail $trail) {
    $trail->push('Employee', route('employee.index'));
});
Breadcrumbs::for('employee-list', function (BreadcrumbTrail $trail) {
    $trail->parent('employee');
    $trail->push('List', route('employee.index'));
});
Breadcrumbs::for('employee-create', function (BreadcrumbTrail $trail) {
    $trail->parent('employee');
    $trail->push('Create', route('employee.create'));
});
Breadcrumbs::for('employee-show', function (BreadcrumbTrail $trail) {
    $trail->parent('employee');
    $trail->push('Show', route('employee.index'));
});
Breadcrumbs::for('employee-show-id', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('employee-show');
    $trail->push($id, route('employee.show', $id));
});
Breadcrumbs::for('employee-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('employee');
    $trail->push('Edit', route('employee.index'));
});
Breadcrumbs::for('employee-edit-id', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('employee-edit');
    $trail->push($id, route('employee.edit', $id));
});
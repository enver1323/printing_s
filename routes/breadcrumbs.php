<?php

use App\Domain\Brand\Entities\Brand;
use App\Domain\Category\Entities\Category;
use App\Domain\Country\Entities\Country;
use App\Domain\Country\Entities\Region;
use App\Domain\Product\Entities\Product;
use App\Domain\Product\Entities\ProductOption;
use App\Domain\Translation\Entities\Language;
use App\Domain\User\Entities\User;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Crumbs;

Breadcrumbs::for('home', function (Crumbs $crumbs) {
    $crumbs->push(__('breadcrumbs.home'), route('home'));
});

Breadcrumbs::for('login', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(__('breadcrumbs.login'), route('login'));
});

Breadcrumbs::for('password.request', function (Crumbs $crumbs) {
    $crumbs->parent('login');
    $crumbs->push(__('breadcrumbs.reset_password'), route('password.request'));
});

Breadcrumbs::for('password.reset', function (Crumbs $crumbs) {
    $crumbs->parent('password.request');
    $crumbs->push(__('breadcrumbs.change'), route('password.reset'));
});

Breadcrumbs::for('for', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(__('breadcrumbs.for'), route('for'));
});

/** Cabinet */
Breadcrumbs::for('cabinet.home', function (Crumbs $crumbs) {
    $crumbs->parent('home');
    $crumbs->push(__('breadcrumbs.cabinet'), route('cabinet.home'));
});

Breadcrumbs::for('admin.home', function (Crumbs $crumbs) {
    $crumbs->push(__('breadcrumbs.dashboard'), route('admin.home'));
});

/** Admin Users */
Breadcrumbs::for('admin.users.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(__('breadcrumbs.users'), route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.users.index');
    $crumbs->push(__('breadcrumbs.create'), route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.index');
    $crumbs->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::for('admin.users.edit', function (Crumbs $crumbs, User $user) {
    $crumbs->parent('admin.users.show', $user);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.users.edit', $user));
});

/** Admin Languages */
Breadcrumbs::for('admin.languages.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(__('breadcrumbs.languages'), route('admin.languages.index'));
});

Breadcrumbs::for('admin.languages.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.languages.index');
    $crumbs->push(__('breadcrumbs.create'), route('admin.languages.create'));
});

Breadcrumbs::for('admin.languages.show', function (Crumbs $crumbs, Language $language) {
    $crumbs->parent('admin.languages.index');
    $crumbs->push($language->name, route('admin.languages.show', $language));
});

Breadcrumbs::for('admin.languages.edit', function (Crumbs $crumbs, Language $language) {
    $crumbs->parent('admin.languages.show', $language);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.languages.edit', $language));
});

/** Admin Country */
Breadcrumbs::for('admin.countries.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(__('breadcrumbs.countries'), route('admin.countries.index'));
});

Breadcrumbs::for('admin.countries.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.countries.index');
    $crumbs->push(__('breadcrumbs.create'), route('admin.countries.create'));
});

Breadcrumbs::for('admin.countries.show', function (Crumbs $crumbs, Country $country) {
    $crumbs->parent('admin.countries.index');
    $crumbs->push($country->name, route('admin.countries.show', $country));
});

Breadcrumbs::for('admin.countries.edit', function (Crumbs $crumbs, Country $country) {
    $crumbs->parent('admin.countries.show', $country);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.countries.edit', $country));
});

/** Admin Regions */
Breadcrumbs::for('admin.regions.create', function (Crumbs $crumbs, Country $country, Region $region = null) {
    if (isset($region))
        $crumbs->parent('admin.regions.show', $region);
    else
        $crumbs->parent('admin.countries.show', $country);

    $crumbs->push(__('breadcrumbs.create'), route('admin.regions.create', [$country, $region]));
});


Breadcrumbs::for('admin.regions.show', function (Crumbs $crumbs, Region $region) {
    if ($parent = $region->parent)
        $crumbs->parent('admin.regions.show', $parent);
    else
        $crumbs->parent('admin.countries.show', $region->country);

    $crumbs->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::for('admin.regions.edit', function (Crumbs $crumbs, Region $region) {
    $crumbs->parent('admin.regions.show', $region);

    $crumbs->push(__('breadcrumbs.edit'), route('admin.regions.edit', $region));
});

/** Admin Categories */
Breadcrumbs::for('admin.categories.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(__('breadcrumbs.categories'), route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function (Crumbs $crumbs, Category $category = null) {
    if (isset($category))
        $crumbs->parent('admin.categories.show', $category);
    else
        $crumbs->parent('admin.categories.index');

    $crumbs->push(__('breadcrumbs.create'), route('admin.categories.create', $category));
});

Breadcrumbs::for('admin.categories.show', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.index');

    foreach ($category->ancestorsAndSelf($category->id) as $catItem)
        $crumbs->push($catItem->name, route('admin.categories.show', $catItem));
});

Breadcrumbs::for('admin.categories.edit', function (Crumbs $crumbs, Category $category) {
    $crumbs->parent('admin.categories.show', $category);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.categories.edit', $category));
});

/** Admin Categories */
Breadcrumbs::for('admin.brands.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(__('breadcrumbs.brands'), route('admin.brands.index'));
});

Breadcrumbs::for('admin.brands.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.brands.index');
    $crumbs->push(__('breadcrumbs.create'), route('admin.brands.create'));
});

Breadcrumbs::for('admin.brands.show', function (Crumbs $crumbs, Brand $brand) {
    $crumbs->parent('admin.brands.index');
    $crumbs->push($brand->name, route('admin.brands.show', $brand));
});

Breadcrumbs::for('admin.brands.edit', function (Crumbs $crumbs, Brand $brand) {
    $crumbs->parent('admin.brands.show', $brand);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.brands.edit', $brand));
});

/** Admin Products */
Breadcrumbs::for('admin.products.index', function (Crumbs $crumbs) {
    $crumbs->parent('admin.home');
    $crumbs->push(__('breadcrumbs.products'), route('admin.products.index'));
});

Breadcrumbs::for('admin.products.create', function (Crumbs $crumbs) {
    $crumbs->parent('admin.products.index');
    $crumbs->push(__('breadcrumbs.create'), route('admin.products.create'));
});

Breadcrumbs::for('admin.products.show', function (Crumbs $crumbs, Product $product) {
    $crumbs->parent('admin.products.index');
    $crumbs->push($product->name, route('admin.products.show', $product));
});

Breadcrumbs::for('admin.products.edit', function (Crumbs $crumbs, Product $product) {
    $crumbs->parent('admin.products.show', $product);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.products.edit', $product));
});

/** Admin Product Options */
Breadcrumbs::for('admin.products.options.create', function (Crumbs $crumbs, Product $product) {
    $crumbs->parent('admin.products.show', $product);
    $crumbs->push(__('breadcrumbs.create'), route('admin.products.options.create', $product));
});

Breadcrumbs::for('admin.products.options.show', function (Crumbs $crumbs, ProductOption $option) {
    $crumbs->parent('admin.products.show', $option->product);
    $crumbs->push($option->name, route('admin.products.options.show', $option));
});

Breadcrumbs::for('admin.products.options.edit', function (Crumbs $crumbs, ProductOption $option) {
    $crumbs->parent('admin.products.options.show', $option);
    $crumbs->push(__('breadcrumbs.edit'), route('admin.products.options.edit', $option));
});

/** Admin Product Data Keys */
Breadcrumbs::for('admin.products.data.keys.create', function (Crumbs $crumbs, Category $category = null) {
    if(isset($category))
        $crumbs->parent('admin.categories.show', $category);
    else
        $crumbs->parent('admin.products.index');

    $crumbs->push(__('breadcrumbs.create'), route('admin.products.data.keys.create', $category));
});

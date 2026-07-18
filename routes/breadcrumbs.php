<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Announcement;
use App\Models\Post;
use App\Models\User;

Breadcrumbs::for('v1Dashboard', function ($trail) {
    $trail->push(__('Dashboard'), route('dashboard.v1.index'));
});

//--------------------- Categories --------------------

Breadcrumbs::for('v1CategoryIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Categories'), route('dashboard.v1.categories.index'));
});

Breadcrumbs::for('v1CategoryCreate', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Create category'), route('dashboard.v1.categories.create'));
});

Breadcrumbs::for('v1CategoryShow', function ($trail, Category $category) {
    $trail->parent('v1CategoryIndex');
    $trail->push(__('Subcategories of') . ' ' . str_limit($category['name']),
        route('dashboard.v1.categories.show', $category));
});

Breadcrumbs::for('v1CategoryEdit', function ($trail, Category $category) {
    $trail->parent('v1CategoryIndex');
    $trail->push(__('Edit') . ' ' . str_limit($category['name']),
        route('dashboard.v1.categories.edit', $category));
});

//--------------------- Shops --------------------

Breadcrumbs::for('v1ShopIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Shops'), route('dashboard.v1.shops.index'));
});

Breadcrumbs::for('v1ShopCreate', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Create shop'), route('dashboard.v1.shops.create'));
});

Breadcrumbs::for('v1ShopShow', function ($trail, Shop $shop) {
    $trail->parent('v1ShopIndex');
    $trail->push(__('details of') . ' ' . str_limit($shop['name']),
        route('dashboard.v1.shops.show', $shop));
});

Breadcrumbs::for('v1ShopEdit', function ($trail, Shop $shop) {
    $trail->parent('v1ShopIndex');
    $trail->push(__('Edit') . ' ' . str_limit($shop['name']),
        route('dashboard.v1.shops.edit', $shop));
});

//--------------------- Posts --------------------

Breadcrumbs::for('v1PostIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Posts'), route('dashboard.v1.shops.index'));
});

Breadcrumbs::for('v1PostCreate', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Create category'), route('dashboard.v1.shops.create'));
});

Breadcrumbs::for('v1PostShow', function ($trail, Post $posts) {
    $trail->parent('v1PostIndex');
    $trail->push(__('details of') . ' ' . str_limit($posts['name']),
        route('dashboard.v1.shops.show', $posts));
});

Breadcrumbs::for('v1PostEdit', function ($trail, Post $posts) {
    $trail->parent('v1PostIndex');
    $trail->push(__('Edit') . ' ' . str_limit($posts['name']),
        route('dashboard.v1.shops.edit', $posts));
});

//--------------------- Announcements --------------------

Breadcrumbs::for('v1AnnouncementIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Announcements'), route('dashboard.v1.announcements.index'));
});

Breadcrumbs::for('v1AnnouncementCreate', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Create announcement'), route('dashboard.v1.announcements.create'));
});

Breadcrumbs::for('v1AnnouncementShow', function ($trail, Announcement $announcement) {
    $trail->parent('v1AnnouncementIndex');
    $trail->push(__('Data of') . ' ' . str_limit($announcement['name']),
        route('dashboard.v1.announcements.show', $announcement));
});

Breadcrumbs::for('v1AnnouncementEdit', function ($trail, Announcement $announcement) {
    $trail->parent('v1AnnouncementIndex');
    $trail->push(__('Edit') . ' ' . str_limit($announcement['name']),
        route('dashboard.v1.announcements.edit', $announcement));
});

//--------------------- Users  --------------------

Breadcrumbs::for('v1UserIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Users'), route('dashboard.v1.users.index'));
});

Breadcrumbs::for('v1UserCreate', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Create user'), route('dashboard.v1.users.create'));
});

Breadcrumbs::for('v1UserShow', function ($trail, User $user) {
    $trail->parent('v1UserIndex');
    $trail->push(__('Data of') . ' ' . str_limit($user['name']),
        route('dashboard.v1.users.show', $user));
});

Breadcrumbs::for('v1UserEdit', function ($trail, User $user) {
    $trail->parent('v1UserIndex');
    $trail->push(__('Edit') . ' ' . str_limit($user['name']),
        route('dashboard.v1.users.edit', $user));
});

//--------------------- Contact us  --------------------

Breadcrumbs::for('v1ContactUsIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Contact us forms'), route('dashboard.v1.contact-us-forms.index'));
});

//--------------------- Settings --------------------

Breadcrumbs::for('v1AboutUsPage', function ($trail, string $group) {
    $trail->parent('v1Dashboard');
    $trail->push(__('About us page settings'), route('dashboard.v1.settings.show', $group));
});

Breadcrumbs::for('v1TermsPage', function ($trail, string $group) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Terms page settings'), route('dashboard.v1.settings.show', $group));
});

Breadcrumbs::for('v1SettingsPage', function ($trail, string $group) {
    $trail->parent('v1Dashboard');
    $trail->push(__('General settings'), route('dashboard.v1.settings.show', $group));
});

Breadcrumbs::for('v1NotificationIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Notifications'), route('dashboard.v1.notification.index'));
});

Breadcrumbs::for('v1CompetitionIndex', function ($trail) {
    $trail->parent('v1Dashboard');
    $trail->push(__('Competitions'), route('dashboard.v1.competition.index'));
});
# HaychKew (HQ) - A personal home page app
## /eɪtʃˈkjuː/

HaychKew is a simple, personal home page app to allow you to create a quick starting page
containing comminly visited links, reading list, and other modules.

The project is based on the [Laravel](http://www.laravel.com/) framework, version 4.

## Server requirements

PHP >= 5.3.7

## Installation

- Clone the repository to your preferred location
- Allow write permissions on the app/storage folder and subfolders
- [Install composer](http://getcomposer.org/download/)
- run `php composer.phar install`
- It is recommended to change the `key` value in the `app/config/app.php` file
- Create a new database, and add the details to the database in the database.php file
- run `php artisan migrate`

## Administration

Browse to /admin for your installation, and login with 'admin:0000'. The password can be changed if need be in the settings.

## Setting as browser home page

### Google Chrome

Use the following plugin to allow new tabs to show a specific URL: [New Tab Redirect!](https://chrome.google.com/webstore/detail/new-tab-redirect/icpgjfneehieebagbmdbhnlpiopdcmna?utm_source=chrome-ntp-icon)

## Contributing to HaychKew

Contributions are encouraged and welcome; to keep things organised, all bugs and requests should be
opened in the github issues tab for the main project, at [duellsy/haychkew/issues](https://github.com/duellsy/haychkew/issues)

All issues should have either [bug], [request], or [suggestion] prefixed in the title.

All pull requests should be made to the develop branch, so they can be tested before being merged into the master branch.

## License

HaychKew is open-sourced software licensed under the MIT License.

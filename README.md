Using this project

After cloning/forking this project you should do the following:

    Initiate containers:
        ddev start
    Install dependencies:
        ddev composer install
    Install site using existing config:
        ddev exec drush si minimal --db-url=mysql://db:db@db/db --config-dir=../config/sync
    Import config
        ddev exec drush cim -y
    Import default content:
        ddev exec drush dcdi

Composer template for Drupal projects

Build Status

This project template provides a starter kit for managing your site dependencies with Composer.

If you want to know how to use it as replacement for Drush Make visit the Documentation on drupal.org.
Usage

First you need to install composer.

    Note: The instructions below refer to the global composer installation. You might need to replace composer with php composer.phar (or similar) for your setup.

After that you can create the project:

composer create-project drupal-composer/drupal-project:8.x-dev some-dir --no-interaction

With composer require ... you can download new dependencies to your installation.

cd some-dir
composer require drupal/devel:~1.0

The composer create-project command passes ownership of all files to the project that is created. You should create a new git repository, and commit all files not excluded by the .gitignore file.
What does the template do?

When installing the given composer.json some tasks are taken care of:

    Drupal will be installed in the web-directory.
    Autoloader is implemented to use the generated composer autoloader in vendor/autoload.php, instead of the one provided by Drupal (web/vendor/autoload.php).
    Modules (packages of type drupal-module) will be placed in web/modules/contrib/
    Theme (packages of type drupal-theme) will be placed in web/themes/contrib/
    Profiles (packages of type drupal-profile) will be placed in web/profiles/contrib/
    Creates default writable versions of settings.php and services.yml.
    Creates web/sites/default/files-directory.
    Latest version of drush is installed locally for use at vendor/bin/drush.
    Latest version of DrupalConsole is installed locally for use at vendor/bin/drupal.
    Creates environment variables based on your .env file. See .env.example.

Updating Drupal Core

This project will attempt to keep all of your Drupal Core files up-to-date; the project drupal-composer/drupal-scaffold is used to ensure that your scaffold files are updated every time drupal/core is updated. If you customize any of the "scaffolding" files (commonly .htaccess), you may need to merge conflicts if any of your modified files are updated in a new release of Drupal core.

Follow the steps below to update your core files.

    Run composer update drupal/core webflo/drupal-core-require-dev "symfony/*" --with-dependencies to update Drupal Core and its dependencies.
    Run git diff to determine if any of the scaffolding files have changed. Review the files for any changes and restore any customizations to .htaccess or robots.txt.
    Commit everything all together in a single commit, so web will remain in sync with the core when checking out branches or running git bisect.
    In the event that there are non-trivial conflicts in step 2, you may wish to perform these steps on a branch, and use git merge to combine the updated core files with your customized files. This facilitates the use of a three-way merge tool such as kdiff3. This setup is not necessary if your changes are simple; keeping all of your modifications at the beginning or end of the file is a good strategy to keep merges easy.

Generate composer.json from existing project

With using the "Composer Generate" drush extension you can now generate a basic composer.json file from an existing project. Note that the generated composer.json might differ from this project's file.
FAQ
Should I commit the contrib modules I download?

Composer recommends no. They provide argumentation against but also workrounds if a project decides to do it anyway.
Should I commit the scaffolding files?

The drupal-scaffold plugin can download the scaffold files (like index.php, update.php, …) to the web/ directory of your project. If you have not customized those files you could choose to not check them into your version control system (e.g. git). If that is the case for your project it might be convenient to automatically run the drupal-scaffold plugin after every install or update of your project. You can achieve that by registering @composer drupal:scaffold as post-install and post-update command in your composer.json:

"scripts": {
    "post-install-cmd": [
        "@composer drupal:scaffold",
        "..."
    ],
    "post-update-cmd": [
        "@composer drupal:scaffold",
        "..."
    ]
},

How can I apply patches to downloaded modules?

If you need to apply patches (depending on the project being modified, a pull request is often a better solution), you can do so with the composer-patches plugin.

To add a patch to drupal module foobar insert the patches section in the extra section of composer.json:

"extra": {
    "patches": {
        "drupal/foobar": {
            "Patch description": "URL or local path to patch"
        }
    }
}

How do I switch from packagist.drupal-composer.org to packages.drupal.org?

Follow the instructions in the documentation on drupal.org.
How do I specify a PHP version ?

This project supports PHP 5.6 as minimum version (see Drupal 8 PHP requirements), however it's possible that a composer update will upgrade some package that will then require PHP 7+.

To prevent this you can add this code to specify the PHP version you want to use in the config section of composer.json:

"config": {
    "sort-packages": true,
    "platform": {
        "php": "5.6.40"
    }
},
# WP Foundation Theme

A WordPress Starter Theme for creating completely custom themes, built using Underscores (_s) and Foundation 5. Grunt and Bower are used for maintaining components and preparing assets.

This theme is aimed at developers and people who want to become more familiar with using tools like SASS and Grunt in their projects.

## Requirements

* [WordPress](https://wordpress.org/)
* [NodeJS](https://nodejs.org/)

## Usage

* First clone the Theme from this repository, setting the folder to something relevant for your new theme. Alternatively, you can [download](https://github.com/PeterBooker/wp-foundation-theme/archive/master.zip) the latest version and unzip it manually.

```

git clone https://github.com/PeterBooker/wp-foundation-theme.git custom-folder-name

```

* Next we will perform several Find & Replace actions to customise the Theme (ignore double quotes in my examples, use case sensitivity)

 * ```Find "WP Foundation Theme" replace with "CustomName" (replaces package name)```

 * Find "foundation_" replace with "customname_" (replaces function prefixes)

 * Find "'foundation" replace with "'customname" (replaces textdomain and file handles)

 * Find "FOUNDATION_" replace with "CUSTOMNAME_" (replaces constants)

* Then you need to customise the values inside of the package.json file (you can leave the bottom half under 'devDependencies'. These values are used to build the comments at the top of the style.css file (among other things), which tells WordPress about your theme.


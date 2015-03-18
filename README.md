# WP Foundation Theme


A WordPress Starter Theme for creating completely custom themes, built using Underscores (_s), Foundation 5 and Font Awesome. Grunt and Bower are used for maintaining components and preparing assets.

This theme is aimed at developers and people who want to become more familiar with using tools like SASS and Grunt in their projects.

## Requirements


* [WordPress] (https://wordpress.org/)
* [NodeJS] (https://nodejs.org/)

## Usage


* First clone the Theme from this repository, setting the folder to something relevant for your new theme. Alternatively, you can [download](https://github.com/PeterBooker/wp-foundation-theme/archive/master.zip) the latest version and unzip it manually.

```

git clone https://github.com/PeterBooker/wp-foundation-theme.git custom-folder-name

```


* Next we will perform several find & replace actions to customise the Theme (ignore double quotes in my examples, use case sensitivity)

 * ```Find "WP Foundation Theme" replace with "CustomName"``` (replaces package name)

 * ```Find "foundation_" replace with "customname_"``` (replaces function prefixes)

 * ```Find "'foundation" replace with "'customname"``` (replaces textdomain and file handles)

 * ```Find "FOUNDATION_" replace with "CUSTOMNAME_"``` (replaces constants)


* Then you need to customise the values inside of the ```package.json``` file (you can leave the bottom half under 'devDependencies'). These values are used to build the comments at the top of the ```style.css``` file (among other things), which tells WordPress about your theme.


* Now we need to make sure the relevant dependencies are installed. Navigate to the theme folder in the command line and run:

 ```
 npm install -g bower grunt-cli
 bower install
 npm install
 ```

 This will install all the dependencies required by the Theme.


* Now you can run ```grunt``` or ```grunt watch``` from the command line to begin the default ```watch``` task. This watches the SASS and Javascript files (anything inside ```assets/js/src/```) for changes, and combines them into ```style.css``` and ```assets/js/scripts.min.js``` respectively.


* Now you are ready to begin customising the theme for your specific project. The styling (CSS) is altered using SASS, which imports the Foundation styling automatically. You can add your own custom styles to the ```assets/scss/_theme.scss``` using SASS or plain CSS.

## License


The license is carried over from WordPress, GNU GPL v2.
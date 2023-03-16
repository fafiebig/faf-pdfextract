# DEPRECATED - DO NOT USE IT ANY LONGER!


# faf-pdfextract

Wordpress Plugin to extract PDF content (with pdftotext) and copy it into media content field
You have to install poppler utils on serverside.


# Installation

* Unzip and upload the plugin to the **/wp-content/plugins/** directory
* Activate the plugin in WordPress

# Installation with composer

* Add the repo to your composer.json

```json

"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/fafiebig/faf-pdfextract.git"
    }
],

```

* require the package with composer

```shell

composer require fafiebig/faf-pdfextract 1.*

```

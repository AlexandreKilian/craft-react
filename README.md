# Craft React

Craft CMS React Renderer lets you implement React.js client and server-side rendering in your Craft CMS projects.

It is an implementation of [ReactBundle](https://github.com/Limenius/ReactRenderer) for CraftCMS. For a complete documentation of the core functionality and client examples, as well as problems related to the Renderer itself, please check out [ReactBundle](https://github.com/Limenius/ReactRenderer) or [Symfony React Sandbox](https://github.com/Limenius/symfony-react-sandbox).

## Why Server-Side rendering?
By rendering your react components on the server, you not only increase performance and search engine readability for SEO but also enable users with slower connections to be able to access your information before your client bundle has completely loaded.

## How it works
Please checkout the [Walkthrough](https://github.com/Limenius/symfony-react-sandbox#walkthrough) for a step by step explanation of the client and twig-side of this plugin. For a JSON-API, we recommend [Elements API for Craft CMS](https://github.com/craftcms/element-api).

## Installation

To install the plugin, follow these instructions:
1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin: 

        composer require alexk/craft-react
        
In the Control Panel, go to Settings → Plugins and click the “Install” button for Craft React.

## Setup

In the plugin settings `.env` file, add the following entries:

`Environment: "client_side", "server_side" or "both"`

`Server Bundle: "PATH_TO_SERVER_BUNDLE"`

or override the settings globally in `config/react.php`


```php
<?php

return [
    'env' => 'client_side',
    'serverBundle' => 'app/server-bundle.js',
];

```


In your template, add the following TWIG-function where you want your react application to be rendered into:
```twig
    {{ react_component('MyApp', {'props': {entry: entry}}) }}
```

In the props, pass whatever props you want to pass to your root component.


## Serialization

In order to serialize your entries to create a store or props, the new twig function `serialize(entry, schema = 'entry', group = 'default') ` has been introduced. This allows you to create a php file to serialize your entries. Files should be located in `config/react` and should be named `[schema].php`.
If unspecified, the schema will default to `entry.php` and the group to `default`.

```php entry.php
<?php
# config/react/entry.php

use craft\elements\Entry;

return [
    'default' => function(Entry $entry){// named after the group
        return [
            'id' => $entry->id,
            'title' => $entry->title,
            'customField' => $entry->customField,
         ];
    }
];
```

To use it in twig, just pass your current entry and use the result in your store:

```twig 
{# _entry.twig #}

{% set serializedBlogPost = serialize(entry,'blog', 'detail') %}
{{ react_component('MyApp', {'props': {blogpost: serializedBlogPost}}) }}
```

This will use the file `config/react/blog.php`

```php
<?php
# config/react/blog.php

use craft\elements\Entry;

return [
    'detail' => function(Entry $entry){
        return [
            'id' => $entry->id,
            'title' => $entry->title,
            'content' => $entry->content,// custom field
         ];
    }
];

```

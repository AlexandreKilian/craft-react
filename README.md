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

        composer require craftcms/craft-react
        
In the Control Panel, go to Settings → Plugins and click the “Install” button for Craft React.

## Setup

In your `.env` file, add the following entries:

```
REACT_RENDER="both" // options: "client_side", "server_side" or "both"

REACT_SERVER_BUNDLE= 'app/server-bundle.js' // the location of your server bundle from your craft CMS root directory

```


In your template, add the following TWIG-function where you want your react application to be rendered into:

    {{ react_component('MyApp', {'props': {entry: entry}}) }}


In the props, pass whatever props you want to pass to your root component.

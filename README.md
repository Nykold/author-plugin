# Nyk Authors Plugin

The **Nyk Authors** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav).

It is designed to work from within the [Admin plugin](http://github.com/getgrav/grav-plugin-admin) and to provide simpler options to display authors' names in pages in Grav-powered blogs.

> NOTE: The plugin was originally designed to work with my particular setup in [my blog](https://ideal-social.com). For now, it serves that purpose. **It is still in early development and its functionality is still limited.** The way to use it in its current state is described in the [usage section](#usage). I intend to make it more versatile in the future.

## Installation

Installing the Nyk Authors plugin can be done in one of three ways:
1. The **admin method** lets you do so via the [Admin plugin](http://github.com/getgrav/grav-plugin-admin), with which the plugin is designed to work
2. The **GPM (Grav Package Manager) installation method** lets you quickly install the plugin with a simple terminal command
3. The **manual method** lets you do so via a zip file

### Admin Plugin (Preferred)

This plugin is designed to work from within the [Admin plugin](http://github.com/getgrav/grav-plugin-admin). So, if you are going to be using the Admin plugin, you can simply install the plugin directly by browsing the `Plugins` menu and clicking on the `Add` button.

### GPM Installation

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install nyk-authors

This will install the Nyk Authors plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/nyk-authors`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `nyk-authors`. You can find these files on [GitHub](https://github.com/Nykold/nyk-authors) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/nyk-authors
	
> NOTE: This plugin is a modular component for Grav and requires other plugins to operate, please see its dependencies on the [blueprints.yaml file on GitHub](https://github.com/Nykold/nyk-authors/blob/master/blueprints.yaml).

## Configuration

Before configuring this plugin, you should copy the `user/plugins/nyk-authors/nyk-authors.yaml` to `user/config/plugins/nyk-authors.yaml` and only edit that copy.

**Note that by using the [Admin plugin](http://github.com/getgrav/grav-plugin-admin), this step can be ignored.** A file with your configuration named nyk-authors.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the Admin Plugin.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true                     # Turn plugin on or off

author_taxonomy: '0'              # Taxonomy type where authors are added
automatic_username_enabled: true  # Automatically add current user as author
blacklist_enabled: false          # Enable blacklist
blacklist: null                   # Usernames excluded from being used as authors
whitelist_enabled: false          # Enable whitelist
whitelist: null                   # Only usernames that will be used as authors
extra_authors: null               # Additional authors without a user account or display name overwrites

lang: en                          # Language used for the conjunction before the last author in string
custom_lang_conjunction: null     # If lang is set to custom, a custom conjunction

page_link_enabled: true           # Automatically add links to author pages that have already been created
page_link_attributes:             # HTML attributes added to the <a> tag of links to author pages
  rel: author
  target: _blank
page_path: /author/               # Path to folder with author pages
```

<a id="usage"></a>

## Usage

The plugin was originally designed to work with my particular setup in [my blog](https://ideal-social.com). For now, it serves that purpose. **It is still in early development and its functionality is still limited.** However, if you intend to use it for similar purposes, here is how you can do it:

0. For now, **the plugin is designed to only work from within the [Admin plugin](http://github.com/getgrav/grav-plugin-admin)**.

1. The plugin works by adding usernames to a taxonomy type (chosen in settings) in pages you are creating. It then compares those usernames to Grav's user database to find authors. **Make sure each of your authors has a user account in your Grav installation** (or has been added to the *"additional authors"* section of settings). The most relevant fields for each user are their *username* (which you will use in taxonomy and which will be a part of the author's page URL) and their *full name* (will be used as the author's name to be displayed in the page).

2. When you create a new page, **the plugin may automatically add the current username to the page's taxonomy** (configurable).

3. As you're editing the page, you can **add as many taxonomies as you want, authors or not**.

4. Once you save the page, **the plugin will make a string with the full list of authors** in natural language (separated by commas, with the last author separated by the chosen conjunction) and save it to the page's frontmatter. If enabled, each author's name may have a link to an author page (page located at a path with the respective username inside of a customizable folder – `/customizable-folder-path/username`).

5. **Place the automatically created string anywhere in your page or template** by using the Twig tag `{{ page.header.authorString|raw }}` (*you must turn on Twig processing for the tag to work*).

## To Do
The plugin was originally designed to work with my particular setup in [my blog](https://ideal-social.com). For now, it serves that purpose. The priority now is to make it a bit more versatile. With that in mind, the next steps, in order, are:

- [x] Write an actually usable config page for the plugin
- [x] Add language options for the final author separator (conjunction) (EN, FR, DE, PT, ES for now)
- [x] Besides languages, add option for a custom conjunction
- [x] Make a toggle for the automatic addition of the current username to a newly created page
- [x] Make the inclusion of links to author's page optional
- [x] Allow for custom paths for author page's link
- [x] Add check to verify if author page exists before adding link
- [x] Allow custom attributes in the `<a>` tag for author page links
- [x] Add blacklist to exclude certain authors from the plugin
- [x] Add whitelist to only include certain authors
- [x] Add possibility of including authors without a user account
- [x] Add options other than categories to store authors

As well as these steps, I continue to use the plugin on a daily basis and will constantly search for ways to make it more user-friendly.


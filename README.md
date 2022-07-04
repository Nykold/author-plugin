# Nyk Authors Plugin

The **Nyk Authors** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav).

It is designed to work from within the [Admin Plugin](http://github.com/getgrav/grav-plugin-admin) and it helps with displaying authors' names in pages in Grav-powered blogs.

> NOTE: The plugin was originally designed to work with my particular setup in [my blog](https://ideal-social.com). For now, it serves that purpose. **It is still in early development and its functionality is still limited.** The way to use it in its current state is described in the [usage section](#usage). I intend to make it more versatile in the future.

## Installation

Installing the Nyk Authors plugin can be done in one of three ways:
1. The **admin method** lets you do so via the Admin Plugin, with which the plugin is designed to work
2. The **GPM (Grav Package Manager) installation method** lets you quickly install the plugin with a simple terminal command
3. The **manual method** lets you do so via a zip file

### Admin Plugin (Preferred)

This plugin is designed to work from within the Admin Plugin. So, if you are going to be using the Admin plugin, you can simply install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

### GPM Installation

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install nyk-authors

This will install the Nyk Authors plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/nyk-authors`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `nyk-authors`. You can find these files on [GitHub](https://github.com/Nykold/nyk-authors) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/nyk-authors
	
> NOTE: This plugin is a modular component for Grav and requires other plugins to operate, please see its dependencies on the [blueprints.yaml file on GitHub](https://github.com/Nykold/nyk-authors/blob/master/blueprints.yaml).

## Configuration

Before configuring this plugin, you should copy the `user/plugins/nyk-authors/nyk-authors.yaml` to `user/config/plugins/nyk-authors.yaml` and only edit that copy.

**Note that by using the Admin Plugin, this step can be ignored.** A file with your configuration named nyk-authors.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the Admin Plugin.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
automatic_username: true
lang: en
custom_lang_conjunction: null
```

<a id="usage"></a>

## Usage

The plugin was originally designed to work with my particular setup in [my blog](https://ideal-social.com). For now, it serves that purpose. **It is still in early development and its functionality is still limited.** However, if you intend to use it for similar purposes, here is how you can do it:

0. The plugin works by adding categories to the taxonomy of the pages you're creating. It then compares those categories to Grav's user database to know which categories are authors. **Make sure each of your authors has a user account in your Grav installation.** The most relevant fields for each user are their *username* (which you will use as a category and which will be a part of the author's page URL) and their *full name* (will be used as the author's name to be displayed in the page).

1. When you create a new page, **the plugin may automatically add the current username to the page's categories** (configurable).

2. As you're editing the page, you can **add as many categories as you want, including other authors**.

3. Once you save the page, **the plugin will make a string with the full list of authors** in natural language (separated by commas, with the last author separated by the chosen conjunction) and save it to the page's frontmatter. Each author's name will have a link to an author page (at `/autor/username` – *currently in portuguese, will be customizable soon*).

4. **Place the automatically created string anywhere in your page or template** by using the Twig tag: `{{ page.header.authorString }}`

## To Do
The plugin was originally designed to work with my particular setup in [my blog](https://ideal-social.com). For now, it serves that purpose. The priority now is to make it a bit more versatile. With that in mind, the next steps, in order, are:

- [x] Write an actually usable config page for the plugin
- [x] Add language options for the final author separator (conjunction) (EN, FR, DE, PT, ES for now)
- [x] Besides languages, add option for a custom conjunction
- [x] Make a toggle for the automatic addition of the current username to a newly created page
- [ ] Make the inclusion of links to author's page optional
- [ ] Allow for custom paths for author page's link
- [ ] Add check to verify if author page exists before adding link
- [ ] Add blacklist to exclude certain authors from the plugin
- [ ] Add whitelist to include authors without an user account
- [ ] Add options other than categories to store authors
- [ ] Use shortcodes to create a simpler way to add the author list into the page

As well as these steps, I continue to use the plugin on a daily basis and will constantly search for ways to make it more user-friendly.


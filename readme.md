# Page Keys

Have you ever wanted to access a specific page from inside a template file? Of course, you could query it by its title. But what if someone wanted to rename the page? Okay, so we choose the slug. But maybe that someone also thought editing the slug as well to make it fit the new title was a very good idea. Yes, I know, it is not. But that someone either didn't know, or didn't care. Okay, so let's use the page ID. Oh, wait, now that someone, _by mistake_, permanently deleted that page. After having visited the frontend that someone created a new page, with the exact same title and the exact same slug as the original page. But that damn page still won't show.

This is exactly when _Page Keys_ kicks in.

## Installation

1. [Download ZIP](https://github.com/tfrommen/page-keys/archive/master.zip).
1. Upload contents to the `/wp-content/plugins` directory on your web server.
1. Activate the plugin through the _Plugins_ menu in WordPress.
1. Find the new _Page Keys_ menu item in the _Pages_ menu in your WordPress backend.

## Usage

What this plugin is all about is providing a means to accessing specific pages by unique and therefore individual keys. And doing this is quite simple. On the _Page Keys_ admin page, you can add as many unique page keys as you like. For each of these page keys, you then select a (published) page. Hit the _Save Changes_ button, and you're done already.

Suppose you now want to access a specific page in one of your theme's template file. After having defined a page key and having assigned a page to it, you can get the according `WP_Post` object by calling `get_page_by_key( $key )`. In the rare case where you already have a function of that name defined within the global namespace, you would have to set up such a function by yourself. In principle, this is just a copy of what you can find in the `functions.php` file **of this plugin**.

### Filters

In order to customize certain aspects of the plugin, it provides you with several filters. For each of these, a short description as well as a code example on how to alter the default behavior is given below. Just put the according code snippet in your theme's `functions.php` file or your _customization_ plugin, or to some other appropriate place.

#### `edit_page_keys_capability`

Editing the page keys is restricted to a certain capability, which is by default `edit_published_pages`. The reason for this choice lies with the fact that user, who is capable of editing a published page (e.g., changing its status to `draft`), implicitly is able to compromise any page key mapped to the page.

```php
/**
 * Filter the capability required to edit the page keys.
 *
 * @param string $capability Capability required to edit the page keys.
 */
add_filter( 'edit_page_keys_capability', function() {
	
	return 'manage_options';
} );
```

#### `list_page_keys_capability`

Accessing the plugin's settings page is restricted, too. In order to distinguish between users who are only allowed to see the existing page keys as well as their respective page, and users, who are able to edit page keys, there are two individual capabilities. The default for accessing the settings page is `edit_pages`.

```php
/**
 * Filter the capability required to list the page keys.
 *
 * @param string $capability Capability required to list the page keys.
 */
add_filter( 'list_page_keys_capability', function() {
	
	return 'read';
} );
```

#### `page_keys_show_admin_notice`

Depending on how exactly you are working with the plugin, the admin notice informing you about page keys that don't have a page assigned might be more annoying than helping. Gladly, there is a filter to turn this off.

```php
add_filter( 'page_keys_show_admin_notice', '__return_false' );
```

## Contribution

If you have a feature request, or if you have developed the feature already, please feel free to use the Issues and/or Pull Requests section.

Of course, you can also provide me with translations if you would like to use the plugin in another not yet included language.

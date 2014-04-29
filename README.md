# Lastache

Lastache is a port of [Kostache](https://github.com/zombor/KOstache), a Kohana 3 module. With this package you can use [Mustache](http://mustache.github.com/) templates in your application.

## Usage

To use, simply create a POPO (Plain Old PHP Object) like so:

```php
<?php

class TestView
{
	public $hello = 'world';

	public function testing()
	{
		return 'foobar';
	}
}
```

And create a mustache renderer. The parameter to the engine method is the template name to use.

```php
<?php

$renderer = Lastache::factory();
```

And render it:

```php
<?php

$this->response->body($renderer->render(new TestView));
```

## Templates

Templates should go in the `app/templates/` directory. They should have a .mustache extension.

## Partials

Partials are loaded automatically based on the name used in the template. So if you reference `{{>foobar}}` in your template, it will look for that partial in `app/templates/partials/foobar.mustache`.

# Layouts

Lastache supports layouts. To use, just add a `app/templates/layout.mustache` file (a simple one is already provided), and use `Lastache_Layout` for your renderer instead of `Lastache`. You'll probably want to put a `$title` property in your view class. The layout should include a `{{>content}}` partial to render the body of the page.

# Additional Information

For specific usage and documentation, see:

[PHP Mustache](http://github.com/bobthecow/mustache.php)

[Original Mustache](http://mustache.github.com/)

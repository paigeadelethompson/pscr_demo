[![Latest Stable Version](http://poser.pugx.org/phpunit/phpunit/v)](https://packagist.org/packages/phpunit/phpunit) [![Total Downloads](http://poser.pugx.org/phpunit/phpunit/downloads)](https://packagist.org/packages/phpunit/phpunit) [![Latest Unstable Version](http://poser.pugx.org/phpunit/phpunit/v/unstable)](https://packagist.org/packages/phpunit/phpunit) [![License](http://poser.pugx.org/phpunit/phpunit/license)](https://packagist.org/packages/phpunit/phpunit) [![PHP Version Require](http://poser.pugx.org/phpunit/phpunit/require/php)](https://packagist.org/packages/phpunit/phpunit)
![screenshot](https://raw.githubusercontent.com/paigeadelethompson/pscr_demo/master/screenshots/1.png "screenshot")

# What is PSCR?

PSCR stands for Prgoressive Solutions Content Renderer; A web development framework written in object oriented PHP. Mainly, this framework features my own content creation extension a native object oriented representation of an HTML document for creating web pages from scratch. 

## Why create another web framework?

In 2007 it wasn't exactly a stereotype that I was aware of at least but it spoke to an idea of creating a web application development experience that 
I could relate to for other's to enjoy. I was also relatively new to writing computer programs and wanted to hold myself to a high standard. In 2018, 
I decided to revisit this project for a couple of days giving it a complete rewrite and applying at the time my most recent knowledge of knowledge 
of object oriented design concepts with what is available in PHP.

## Installation (docker)

- `docker build -t pscr:latest .`
- `docker run -d --rm pscr`
- Navigate a browser to the container's IP address to test if it works

## Installation (compose)

- `compose install`
- `php -S 0.0.0.0:80 index.php`

## How to build a page
The framework is designed to avoid having to use inline HTML. The `pscr_content` class is a mostly complete representation of what can be accomplished with HTML.

### create a class and extend pscr\extensions\pscr_content\model\pscr_content:

```
              
namespace pscr\apps\my_app;

use pscr\extensions\pscr_content\model\pscr_content;
use pscr\extensions\pscr_content\html;

/**
 * Class index
 * @package pscr\apps\my_app
 */
class index extends pscr_content {
   function generate()
    {
    }
}
```

### Use the HTML factory classes to generate the document:

```
$head                     = $this->html->head();
$head->title()->innerText = "Progressive Solutions Content Renderer";

$head->stylesheet("css/style.css"); 

$content_root_div = $this->html->body()->div("content-root");
$header_bar       = $content_root_div->div('header');
$side_bar         = $content_root_div->div('side-bar');
$content_area     = $content_root_div->div('content-area');
$footer_bar       = $content_root_div->div('footer');
```
            

### you can stylize your page with CSS inline on the fly:

```
$header_bar_style                   = $header_bar->style();
$header_bar_style->float            = "left";
$header_bar_style->min_height       = "50px";
$header_bar_style->position         = "fixed";
$header_bar_style->background_color = "black";
$header_bar_style->color            = "white";
$header_bar_style->width            = "100%";
$header_bar_style->display          = "block";
$header_bar_style->padding          = "20px";
```
            

### you can add style blocks using nowdoc:

```
$head->style_tag(<<< 'EOT'
        body {
            font-family: Verdana,sans-serif;
            font-size: 15px;
            background-color: #fdfffc;
            color: #011627;
        }
        hr {
             margin-top = "10px";
             margin-bottom = "10px";
              border: 0; 
              height: 1px; 
              background: #333; 
              background-image: linear-gradient(to right, #ccc, #333, #ccc);
        }
        p {
            width: 100%;
            text-align: center;
            
        }        
        li { 
            margin-top: 20px;
        }
        .section {
            width: 100%;
        }
        .content-area {
            float: left;
            background-color: #fdfffc;
            color: #011627;
            width: 90%;
            margin-top: 30px;
        }
        .title {
            margin-top:5px;
            color: #41ead4;            
        }
        .company {
            margin-top:5px;
            color: #f71735;
            float: left;
            margin-right: 5px;
        }
        .footer {
            background-color: #011627;
            color: #ff9f1c;
        }
 EOT
 );
            
```

### More examples
- The [PSCR Home](https://github.com/paigeadelethompson/pscr_home/tree/master/apps/home) module isn't a bad place to start
- In the [PSCR Content](https://github.com/paigeadelethompson/pscr_content/tree/master/extensions/pscr_content/html) extension you can see what classes are available for use in content modules.

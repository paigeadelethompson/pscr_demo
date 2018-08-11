
# Screenshot
![alt text](https://github.com/netcrave/pscr/raw/master/screenshots/1.png "screenshot")

# What is PSCR?

A web development framework written in object oriented PHP from scratch. It's designed to make your life easier and to make web development fun and easy. It features a flexible API for making web pages and designs on the fly. It adopts many design patterns from 
other MVC Frameworks as well.

PSCR comes with a few default extensions to make creating web applications easy and intuitive. They are designed to make managing a common codebase for many different web applications while not hendering the ability to create unique functionality on a per 
application basis.
Features

    * Extensible classes (interfaces, abstracts)
    * consistently namespaced hierarchy (namespaces are consistent with files/directories for easier auto-inclusion.)
    * Easy to use global logging class (singleton)

## Making pages is easy with pscr_content

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

For better examples have a look in the home app source in the tree.

# Development
start PSCR using the built-in webserver: 

``
php -S localhost:8000 $PROJECT_ROOT\index.php
``

## Roadmap
Things I would like to see in an actual official release (if that ever happens)
* An extension for session management that can integrate other extensions such as one for auth0
* Super basic implementation of a Session Identity, one that doesn't depend on a database because I'm not adding an ORM to this.
* implementation of management modules 
* extensions as composer packages
* PSCR itself as a composer package (pscr_content has a lot of includes, so presumably making a phar package would alleviate the include overhead. )
* Better default router (make it easier to write expressions for rather than basic preg_match expressions)
* Complete HTML element classes (there's quite a few)
* Use html_tag constructor parameters more, but be consistent about it
* Response validation based on request (Accept type is what we're responding with, ect.)
* Log writer for writing to a UNIX socket or a named pipe 
 
### Reasons for not having an ORM and a CRUD-heavy implementation within the framework: 
* It's hard to do right and even then it's never perfect
* The more correct an ORM is the more complex it becomes and the more difficult it will likely become for newcomers to work with. 
* ORMs are kind of esoteric, most NoSQL designs use JSON heavily which is easily serialized / deserialzed using their own native APIs
* It's not uncommon or far fetched to spin up a specialized database for a particular project (docker makes easy work of that.)

### Wishlist items

I think it would be cool to have a shallow implementation of Javascript DOM classes/objects (PHP classes that resemble DOM classes and objects without implementations) that can be used to write code with as if they were going to be run in PHP but instead reflect that implementation as either PHP bytecode or pure javascript code and have it run on the client side. It would be really neat if that code could actually run in PHP too, but it would be an awful lot of work for something that provides little to no benefit at that point.

On the other hand a PHP bytecode interpret itself could possibly be implemented in javascript using asm.js but the only way I have found that would allow reflection of bytecode requires a PECL module
that is not part of the core framework (at least as of PHP7) called bcompiler. A PHP bytecode interpreter in JS  even with only minor completeness could prove use useful in pscr_content even just for basic things like binding events. 

#### links
http://php.net/manual/en/book.bcompiler.php 

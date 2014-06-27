# BIFC AJAX Dashboard Deferred Demo

A demonstration app built using JQuery powered Ajax and Json. There are two version of the app in this project, a server enabled "live" version built with CodeIgniter and a "static" HTML version to be run locally without a web server.

## Installation

### Live Version

#### Requirements

Web Server Running:

- PHP 5.1+
- MySql 5+

To Install:

- Copy the contents of the _live_ folder to the __root__ of your web server.
- Move and rename the file _/live/data/database_install.php_ to _/live/application/config/database.php_ and update the settings to match your database settings.
- In PhpMyAdmin, import the _/live/data/bifc_json_dash.sql_ data
- Browse to your local web address to run the demo

### Static Version

- In the _static_ folder, right click and choose to **Open** the _index.html_ file in FireFox or Chrome. You can use IE, but why would you?
- You can also drag it directly into your browser.

## Authors

- Jeff Fox 
- HTML 5 Admin Template by Medialoot (http://www.medialoot.com/)

## Contribute to the development

Want to hack this and show off some cool AJAX/JSON tricks? Feel free. **Fork** the project, throw in your hacks and send me a pull request. If it's a really cool hack, you can come present it at one of our next meetups!

## License

Copyright (c) 2013 Jeff Fox.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
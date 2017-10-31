# Willow's Smart URL Titles for ExpressionEngine 3 & 4

This addon will check for an existing URL Title in the same channel and automatically append it to avoid errors when saving the entry. 

Example, if an existing URL title *willow-smart-url-title* exists, the addon will change it to *willow-smart-url-title-2*. It will also increment the number (up to 10) if future entries share the same URL title.

Additionally a message will be displayed under the URL Title field to let the editor know that a duplicate URL was found, and the URL Title was modified to avoid errors.

##Requirements

ExpressionEngine 3.0 and above is required.

##Installation

Just copy the willow_smart_url_titles folder to your **/user/addons** folder and activate it in the CPanel.

For support and more information visit [Willow Light Studio](https://willowlightstudio.com/contact)

##Changelog

- 1.1.0 Rewrote mechanism for checking for existing URL Titles and added support for EE4.
- 1.0.1 Improved JavaScript and replaced DB calls with Models.
- 1.0.0 Initial release

## License

The MIT License (MIT)
Copyright (c) 2016 Willow Light Studio LLC

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

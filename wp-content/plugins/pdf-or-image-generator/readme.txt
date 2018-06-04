=== PDF or image generator ===

Contributors: wposmosys, sampathkumar0019, priyankaac, prasanna03, siddhartha-osmosys
Donate link: http://osmosys.asia/
Tags: PDF converter, image converter, html to pdf, html to image, converter
Requires at least: 4.0
Requires PHP: 5.5
Tested up to: 4.9
Stable tag: 0.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

It is for converting web page content, HTML string or files with HTML or text into an image or PDF.



== Description ==

It provides the following functionalities

- Converting webpage content, HTML string or file into image. 
- Converting webpage content, HTML string or file into PDF.


== Getting Started ==

= Configuration =

* Go to plugin settings page through settings menu or settings link under plugin name in the plugins page.
* Download wkhtmltox from <a href="https://wkhtmltopdf.org/downloads.html" target="_blank">here</a>.
* Run that executable file then it will create wkhtmltox folder. Enter the absolute path of the files inside wkhtmltox->bin files.

= Usage =

* We have to call the following function with specified paramters and it will return the generated PDF/image path.

`PDFIG_generate($src, $src_type, $dest_file_name, $conversion_type);`

	* **$src** is required, expected string. Ex: <a href="http://osmosys.asia" target="_blank">"http://osmosys.asia"</a>, "home/osmosys/test.php" etc.
    * **$src_type** is required, expected string. It specifies what is the source type, It can be one of the 3 values which are specified in the possible values. Possible values: "TEMPLATE_PATH", "HTML_STRING", "URL".
    * **$dest_file_name** is optional, expected string. It is the file with which file will get downloaded. Ex: "test" etc.
    * **$conversion_type** is optional, expected string. It specifies to which format we have to convert the given source, it can be one among the 2 values which are specified in the possible values. Possible values: "PDF", "IMG".
* Simply insert the following shortcode `[PDFIG_generator_demo]` for a demo page.


== Screenshots ==
1. PDF or image generator settings page. 
2. PDF or image generator demo page.



== Installation ==

= Automatic installation =

* Go to the 'Plugins' menu in WordPress and click 'Add New'
* Search for 'PDF or image generator' and select 'Install Now'
* Activate the plugin when prompted


= Manual installation =

* Upload the 'pdf-img-generator' folder to the '/wp-content/plugins/' directory
* Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Where can I contribute to this plugin? =
<a href="https://github.com/OsmosysSoftware/pdf-image-generator" target="_blank">https://github.com/OsmosysSoftware/pdf-image-generator</a>


== Changelog ==

= 0.0.1 =
* Initial release.

== Upgrade Notice ==

= 0.1 =
* Initial release.


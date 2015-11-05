Admin 404 Checker – CueBlocks Scripts 


The Admin 404 Checker, created by CueBlocks, is a script that checks all the URLs and detects 404 URLs in the Magento admin. The script can be downloaded from Github.
 
If you have installed the recently released Magento SUPEE-6788 Patch to rid your Magento site of vulnerabilities and are wondering whether the website responded to its security resolutions without messing with your Magento admin URLs, then this script will be helpful in that case.

If you are aware of the functionalities of the patch, then you may also be aware that“this patch may break backward compatibility with customizations or extensions” which means that admin URLs of any extension or any customization done on your Magento store can get effected when the patch is run. 

The Admin Checker will come in handy in order to find all the affected URLs. This script will check all the Magento URLs from the Admin menu and system-> configuration. 

Purpose of the Admin Checker Script: 

1) Run it whenever you want to find out 404 URLs in the Magento Admin.
2) Run it after the implementation of the SUPEE-6788 Patch to list down “404 not found” URLs in the Magento admin.


Availability of the Admin Checker Script: 
The script has been made available by CueBlocks on Github and can be downloaded from there for free. 

Caveats:

1) This script checks each URL in the Magento Admin (listed in Admin menu and system-> configuration). It may take upto 30 minutes to run completely. Please run it during the non-peak hours if possible. 
2) Try it on development copy first, if possible.



Usage: 

1. Upload script to shell directory of your Magento installation.
2. Run from SSH:  php admin404checker.php –-username SpecifyAdminUserNameHere. 
3. All results are output to screen.
4. Output also gets logged into var/log/pagesChecked.log and var/log/404pages.log.
 


Who we are
This script has been created by CueBlocks, an eCommerce design, development and marketing company based out of India and Brno, Czech Republic. The script was developed as an effective solution to detect the 404 URLs that may follow after the SUPEE-6788 Patch is run. 

CueBlocks is a Magento Associate and has developed useful and customized extensions for Magento based stores. All our Magento extensions are available on: http://store.cueblocks.com/ and two of the extensions, the XML Sitemap Generator and Splitter Plus and XML Sitemap Generator and Splitter are compatible with the latest SUPEE-6788 patch. 

The Admin 404 Checker script is available at Github <insert link>. For more information/ suggestions or help required, please contact us at: support@cueblocks.com 

CueBlocks Technologies 
Web: www.CueBlocks.com 
http://store.cueblocks.com/ 
Email: support@cueblocks.com 
Phone: +91–172–2739754 





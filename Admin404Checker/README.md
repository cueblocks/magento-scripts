<h2>Admin 404 Checker - CueBlocks Scripts </h2>
<p>The Admin 404 Checker, created by CueBlocks, is a script that checks all the URLs and detects 404 URLs in the Magento admin. The script can be downloaded from Github.<br/>
 
If you have installed the recently released <b>Magento SUPEE-6788</b> Patch to rid your Magento site of vulnerabilities and are wondering whether the website responded to its security resolutions without messing with your Magento admin URLs, then this script will be helpful in that case.

If you are aware of the functionalities of the patch, then you may also be aware that "this patch may break backward compatibility with customizations or extensions" which means that admin URLs of any extension or any customization done on your Magento store can get effected when the patch is run. 

The Admin Checker will come in handy in order to find all the affected URLs. This script will check all the Magento URLs from the Admin menu and <b>system-> configuration.</b> </p>

<h3><b>Purpose of the Admin Checker Script: </b></h3>
1) Run it whenever you want to find out 404 URLs in the Magento Admin.<br/>
2) Run it after the implementation of the SUPEE-6788 Patch to list down "404 not found" URLs in the Magento admin.<br/>

<h3><b>Availability of the Admin Checker Script: </b></h3>
The script has been made available by CueBlocks on Github and can be downloaded from there for free. 
<br/>

<h3><b>Caveats:</b></h3>
1) This script checks each URL in the Magento Admin (listed in Admin menu and system-> configuration). It may take upto 30 minutes to run completely. Please run it during the non-peak hours if possible. <br/>
2) Try it on development copy first, if possible.<br/>

<h3><b>Usage: </b></h3>
1. Upload script to shell directory of your Magento installation.<br/>
2. Run from SSH:  php admin404checker.php --username SpecifyAdminUserNameHere. <br/>
3. All results are output to screen.<br/>
4. Output also gets logged into var/log/pagesChecked.log and var/log/404pages.log.<br/>
 







<?php
// $Id: rss_valid.php,v 1.1 2011/12/30 21:45:42 ohwada Exp $

// 2005-10-10 K.OHWADA
// show pda

// 2005-06-06 K.OHWADA
// move from index.php
// add rdf.php

//=========================================================
// What's New Module
// 2004/08/20 K.OHWADA
//=========================================================

include "../../mainfile.php";
include XOOPS_ROOT_PATH."/header.php";

// module name
$module_name = $xoopsModule->getVar('name');

?>
<h3 align='center'><?php echo $module_name; ?></h3>
<?php echo _WHATSNEW_RSS_PERM; ?><br /><br />
<ul>
<li><a href='index.php'><?php echo _WHATSNEW_MAIN_PAGE; ?></a><br /><br /></li>
<li><a href='atom.php' target="_blank"><img src="images/atom.png" alt="atom" /> (ATOM 1.0)</a><br /></li>
<li><a href='atom_auto.php'><?php echo _WHATSNEW_ATOM_AUTO; ?></a><br /><br /></li>
<li><a href='rss.php' target="_blank"><img src="images/rss.png" alt="rss" /> (RSS 2.0)</a><br /></li>
<li><a href='rss_auto.php'><?php echo _WHATSNEW_RSS_AUTO; ?></a><br /><br /></li>
<li><a href="rdf.php" target="_blank"><img src="images/rdf.png" alt="rdf" /> (RDF 1.0)</a><br /><br /></li>
<li><a href="pda.php" target="_blank"><img src="images/pda_blue.png" alt="pda" /> (PDA)</a><br /></li>
</ul>
<br />
<a href="http://feedvalidator.org/" target="_blank">FEED Validator</a>
 <?php echo _WHATSNEW_VALID; ?><br />
<br />
  <a href="http://feedvalidator.org/check.cgi?url=<?php echo XOOPS_URL; ?>/modules/whatsnew/atom.php" target="_blank">
<img src="images/valid-atom.png" alt="[Valid Atom]" title="Validate my Atom feed" width="88" height="31" /></a>
  <a href="http://feedvalidator.org/check.cgi?url=<?php echo XOOPS_URL; ?>/modules/whatsnew/rss.php" target="_blank">
<img src="images/valid-rss.png" alt="[Valid RSS]" title="Validate my RSS feed" width="88" height="31" /></a>
  <a href="http://feedvalidator.org/check.cgi?url=<?php echo XOOPS_URL; ?>/modules/whatsnew/rdf.php" target="_blank">
<img src="images/valid-rss.png" alt="[Valid RDF]" title="Validate my RDF feed" width="70" height="25" /></a>
<br />
<br />
<hr />
<?php

include XOOPS_ROOT_PATH.'/footer.php';

exit();

?>

/* ========================================================
 * $Id: whatsnew.js,v 1.1 2011/12/30 21:45:44 ohwada Exp $
 * ========================================================
 */

function whatsnew_on_off( id ) 
{
	doc = document.getElementById( id );
	switch ( doc.style.display ) 
	{
		case "none":
		doc.style.display = "block";
		break;

	case "block":
		doc.style.display = "none";
		break;
	}
}

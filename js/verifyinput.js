
var keybYN = new keybEdit('yn','Valid values are \'Y\' or \'N\'.');
var keybNumeric = new keybEdit('01234567890','Μόνο αριθμητικά δεδομένα επιτρέπονται.');
var keybAlpha = new keybEdit('abcdefghijklmnopqurstuvwxyz ','Μόνο χαρακτήρες.');
var keybAlphaNumeric = new keybEdit('abcdefghijklmnopqurstuvwxyz01234567890 ','Μόνο αλφαριθμητικά δεδομένα στη λατινική γλώσσα (αγγλικά) επιτρέπονται.');
var keybDecimal = new keybEdit('01234567890.','Decimal input only.');
var keybDate =  new keybEdit('01234567890/','Date input only');;
var keybYNNM = new keybEdit('yn');
var keybNumericNM = new keybEdit('01234567890');
var keybAlphaNM = new keybEdit('abcdefghijklmnopqurstuvwxy');
var keybAlphaNumericNM = new keybEdit('abcdefghijklmnopqurstuvwxy01234567890','Μόνο αλφαριθμητικά δεδομένα στη λατινική γλώσσα (αγγλικά) επιτρέπονται.');
var keybDecimalNM = new keybEdit('01234567890.');
var keybDateNM = new keybEdit('01234567890/');

function keybEdit(strValid, strMsg) {
	/*	Function:		keybEdit
		Creation Date:	October 11, 2001
		Purpose:		The purpose of this function is to be a constructor for
						the keybEdit object.  keybEdit objects are used by the
						function editKeyBoard to determine which keystrokes are
						valid for form objects.  In addition, if an error occurs,
						they provide the error message.

						Please note that the strValid is converted to both
						upper and lower case by this constructor.  Also, that
						the error message is prefixed with 'Error:'.

						The properties for this object are the following:
							valid	=	Valid input characters
							message	=	Error message

						The methods for this object are the following:
							getValid()	=	Returns a string containing valid
											characters.
							getMessage()=	Returns a string containing the
											error message.

		Update Date:	Programmer:			Description:
	*/

	//	Variables
	var reWork = new RegExp('[a-z]','gi');		//	Regular expression\

	//	Properties
	if(reWork.test(strValid))
		this.valid = strValid.toLowerCase() + strValid.toUpperCase();
	else
		this.valid = strValid;

	if((strMsg == null) || (typeof(strMsg) == 'undefined'))
		this.message = '';
	else
		this.message = strMsg;

	//	Methods
	this.getValid = keybEditGetValid;
	this.getMessage = keybEditGetMessage;
    }

	function keybEditGetValid() {
	/*	Function:		keybEdit
		Creation Date:	October 11, 2001
		Purpose:		The purpose of this function act as the getValid method
						for the keybEdit object.  Please note that most of the
						following logic is for handling numeric keypad input.

		Update Date:		Programmer:			Description:
	*/

		return this.valid.toString();
	}

	function keybEditGetMessage() {
	/*	Function:		keybEdit
		Creation Date:	October 11, 2001
		Purpose:		The purpose of this function act as the getMessage method
						for the keybEdit object.

		Update Date:	Programmer:			Description:
	*/

		return this.message;
	}





    function editKeyBoard(evt, objKeyb) {
    /*	Function:	 editKeyBoard
    Creation Date:	October 11, 2001
    Programmer:	 Edmond Woychowsky
    Purpose:	 The purpose of this function is to edit edit keyboard input
    to determine if the keystrokes are valid.

    Update Date:	 Programmer:	 Description:
    February 26, 2002	Edmond Woychowsky	Added logic to handle control key
    sequences.
    May 10, 2002	 Edmond Woychowsky	Modified logic for message-less
    errors.
    June 5, 2002	 Edmond Woychowsky	Modified logic to prevent dollar signs
    in numeric fields.
    June 11, 2003	 Edmond Woychowsky	Modified logic to accomadate backspace.
    April 11, 2007	 Edmond Woychowsky	Updated for cross-browser DOM support,
    also remove keypad logic.
    */

    var strWork = objKeyb.getValid();
    var strMsg = '';	 // Error message
    var blnValidChar = false;	 // Valid character flag
    var intCode = (evt.charCode) ? evt.charCode : evt.keyCode;

		
    // Part 1: Validate input
    if(!blnValidChar)

    switch(true) {
        case(intCode == 8):
        case(intCode == 9):
        case(intCode == 10):
        case(intCode == 13):
   

        blnValidChar = true;

        break;
        default:
        for(i=0;i < strWork.length;i++)
        if(intCode == strWork.charCodeAt(i)) {
          blnValidChar = true;
          break;
        }

        break;
    }
	


    // Part 2: Build error message
    if(!blnValidChar) {
        if(objKeyb.getMessage().toString().length != 0)
        alert(objKeyb.getMessage());

        evt.stopPropagation = true;

        try {
            evt.preventDefault();
        }
        catch(e) {
            window.event.returnValue = false;	 // Clear invalid character
        }
    }
}







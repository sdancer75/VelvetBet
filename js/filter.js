/*==========================================================================#
# * Function for adding a Filter to an Input Field                          #
# * @param  : [filterType  ] Type of filter 0=>Alpha, 1=>Num, 2=>AlphaNum   #
# * @param  : [evt         ] The Event Object                               #
# * @param  : [allowDecimal] To allow Decimal Point set this to true        #
# * @param  : [allowCustom ] Custom Characters that are to be allowed       #
#==========================================================================*/
function filterInput(filterType, evt, allowDecimal, allowCustom){
	var keyCode, Char, inputField, filter = '';
	var alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	var num   = '0123456789';
	// Get the Key Code of the Key pressed if possible else - allow
	if(window.event){
		keyCode = window.event.keyCode;
		evt = window.event;
	}else if (evt)keyCode = evt.which;
	else return true;
	// Setup the allowed Character Set
	if(filterType == 0) filter = alpha;
	else if(filterType == 1) filter = num;
	else if(filterType == 2) filter = alpha + num;
	if(allowCustom)filter += allowCustom;
	if(filter == '')return true;
	// Get the Element that triggered the Event
	inputField = evt.srcElement ? evt.srcElement : evt.target || evt.currentTarget;
	// If the Key Pressed is a CTRL key like Esc, Enter etc - allow
	if((keyCode==null) || (keyCode==0) || (keyCode==8) || (keyCode==9) || (keyCode==13) || (keyCode==27) )return true;
	// Get the Pressed Character
	Char = String.fromCharCode(keyCode);
	// If the Character is a number - allow
	if((filter.indexOf(Char) > -1)) return true;
	// Else if Decimal Point is allowed and the Character is '.' - allow
	else if(filterType == 1 && allowDecimal && (Char == '.') && inputField.value.indexOf('.') == -1)return true;
	else return false;
}

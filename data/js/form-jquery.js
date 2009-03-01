var sfEasyComments = { VERSION: '$Id$' };

/**
 * sfEasyComments.setupAjax - setup ajax form
 */
sfEasyComments.processSubmit = function(form) {
  try
  {
    var container = jQuery(form).parent('div.sfEasyCommentsFormContainer').eq(0);

    jQuery.ajax({
      type: 'POST',
      url:  form.action,
      data: jQuery(form).serialize(),
      success: function (txt) {
        container.html(txt);
      },
      error: function () {
        alert('An unpredicted error happened and your comment could not be posted.\n\nIf this error persists, please contact the site owner.');
      }
    });
  }
  catch (e)
  {
    try
    {
      console.log(e);
    }
    catch(_e)
    {
    }
  }

  return false;
}

(function($) {

  $.fn.render_errors = function(){
    $form = this;
    this.clear_previous_errors();

    $inputs = $(':input');

    $inputs.each(function(){
      if( !$(this).val() ){
        $(this).closest('.form-group').addClass('has-error').find('.help-block').html('Field required');
      }
    });
  };

  $.fn.validate = function(){
    $form = this;
    this.clear_previous_errors();

    //fields for validate
    $inputs = $('input[type="text"],input[type="password"],input[type="email"]');
    var empty = false;
    console.log("Empty: " + empty);

    $inputs.each(function(){
      if( !$(this).val() ){
        console.log($(this));
        empty = true;
        return;
      }
    });

    console.log("Empty: " + empty);
    return empty;
  };

  $.fn.clear_previous_errors = function(){
    $('.form-group.has-error', this).each(function(){
      $('.help-block', $(this)).html('');
      $(this).removeClass('has-error');
    });
  };

}(jQuery));
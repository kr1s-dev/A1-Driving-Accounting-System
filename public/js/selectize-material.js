$(document).ready(() => {
  mySelect = $('select#country').selectize({
    closeAfterSelect: true,
    allowEmptyOption: true,
    selectOnTab: true,
    onFocus: function(){
      ($(this.$wrapper).parent()).children('label').addClass('filled active');
    },
    onBlur: function(){
      ($(this.$wrapper).parent()).children('label').removeClass('active');
      if(this.items.length == 0){
        ($(this.$wrapper).parent()).children('label').removeClass('filled');
      }
    },
    onInitialize: function(){
      if(this.items.length > 0){
        $(this.$wrapper).siblings('label').addClass('filled');
      }
    },
  });
});
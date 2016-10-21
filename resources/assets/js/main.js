$(document).ready(function () {

  var updateTime = function () {
    var now = moment(new Date()).tz('Europe/Berlin');
    $('.js_moment').each(function (idx) {
      var $this = $(this);
      var createdAt = moment($this.data('time')).tz('Europe/Berlin');
      if (Math.abs(now.diff(createdAt, 'days')) < 60) {
        $this.text(moment($this.data('time')).fromNow());
      }
    });
  };
  updateTime();
  setInterval(updateTime, 60000);

  if ($('#bubble_type_selection').length > 0) {
    var $selection = $('#bubble_type_selection');
    $selection.on('change', function (e) {
      var type = $(this).find('option:selected').attr('value');
      $('.form-control').each(function () {
        $(this).removeAttr('disabled');
      });
      if (type === 'quest') {
        type = 'project';
      } else {
        type = 'quest';
      }
      $('#' + type + '_id').attr('disabled', 'disabled');
    });
  }

  $('.grid').masonry({
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true,
    transitionDuration: 0
  });

  // $('table > thead').parent().DataTable();

});

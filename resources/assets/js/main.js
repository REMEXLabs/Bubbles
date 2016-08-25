$(document).ready(function () {

  // Render time:
  var now = moment(new Date());
  $('.js_moment').each(function (idx) {
    var $this = $(this);
    var createdAt = moment($this.data('time'));
    if (Math.abs(now.diff(createdAt, 'days')) < 30) {
      $this.text(moment($this.data('time')).fromNow());
    }
  });

});

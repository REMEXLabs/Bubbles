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

});

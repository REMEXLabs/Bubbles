$(document).ready(function(){var t=function(){var t=moment(new Date).tz("Europe/Berlin");$(".js_moment").each(function(e){var i=$(this),n=moment(i.data("time")).tz("Europe/Berlin");Math.abs(t.diff(n,"days"))<60&&i.text(moment(i.data("time")).fromNow())})};if(t(),setInterval(t,6e4),$("#bubble_type_selection").length>0){var e=$("#bubble_type_selection");e.on("change",function(t){var e=$(this).find("option:selected").attr("value");$(".form-control").each(function(){$(this).removeAttr("disabled")}),e="quest"===e?"project":"quest",$("#"+e+"_id").attr("disabled","disabled")})}$(".grid").masonry({itemSelector:".grid-item",columnWidth:".grid-sizer",percentPosition:!0,transitionDuration:0})});
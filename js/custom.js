function toggle(id) {
    var e = document.getElementById(id);

    if (e.style.display == '')
        e.style.display = 'none';
    else
        e.style.display = '';
}
function readURL(e) {
    if (e.files && e.files[0]) {
        var t = new FileReader;
        t.onload = function (e) {
            $("#profile-pic").attr("src", e.target.result)
        }, t.readAsDataURL(e.files[0])
    }
}
function eee(e) {
    if (e.files && e.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#previewimage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}
$("#file2").change(function(){
    eee(this);
});
$(document).ready(function () {
    $(".chngepic").click(function () {
        $("#uploadimage").show()
    })

}), $(document).on("change", ".btn-file :file", function () {
    var e = $(this),
        t = e.get(0).files ? e.get(0).files.length : 1,
        a = e.val().replace(/\\/g, "/").replace(/.*\//, "");
    e.trigger("fileselect", [t, a])
}), $(document).ready(function () {
    $(".btn-file :file").on("fileselect", function (e, t, a) {
        var n = $(this).parents(".input-group").find(":text"),
            o = t > 1 ? t + " files selected" : a;
        n.length ? n.val(o) : o && alert(o)
    })
}), jQuery(function (e) {
    e("#text1").autoGrowTextArea();
}), jQuery(function (e) {
    e("#text2").autoGrowTextArea();
}), jQuery(function (e) {
    e(".txtare").autosize();
}), $("#uploadimg").change(function () {
    readURL(this)
}), $(".btncancel").click(function () {
    $img = $("#hiddenimg").val(), $("#profile-pic").attr("src", $img), $("#uploadimage").hide()
});
var nowTemp = new Date,
    now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
$("#dpd1").datepicker({
    format: "MM dd,yyyy",
    autoclose: !0,
    daysOfWeekDisabled: "0",
    orientation: "top right",
    clearBtn: !0,
    beforeShowDay: function (e) {
        return e.valueOf() >= now.valueOf()
    }
}).on("changeDate", function (e) {
    var t = new Date(e.date);
    t.setDate(t.getDate()),
        $("#dpd2").datepicker("setStartDate", t),
        $("#dpd2").focus()
}).on("clearDate", function () {
    $("#dpd2").datepicker("setStartDate", null),
        $("#dpd1").datepicker("setEndDate", null),
        $("#dpd1").datepicker("setStartDate", null),
        $("#dpd2").val(null),
        $("#totalleave").val(null)

}), $("#dpd2").datepicker({
    format: "MM dd,yyyy",
    autoclose: !0,
    daysOfWeekDisabled: "0",
    orientation: "top right"
}).on("changeDate", function () {
    var startDate = new Date($('#dpd1').val());
    var endDate = new Date($('#dpd2').val());
    var diff = endDate - startDate;
    var get = (Number(diff) / 86400000);
    var startTime = $('#timefrom').val();
    var endTime = $('#timeto').val();
    var st = startTime.split(':');
    var ed = endTime.split(':');
    if ((st[1].split(' '))[1] == 'pm')
        st[0] = parseInt(st[0]) + 12;
    if ((ed[1].split(' '))[1] == 'pm')
        ed[0] = parseInt(ed[0]) + 12;
    st[1] = (st[1].split(' '))[0];
    ed[1] = (ed[1].split(' '))[0];

    var diff = ((ed[0] * 60 + ed[1] * 60) - (st[0] * 60 + st[1] * 60)) / 60;
    if(diff == 0 && get == 0){
        $('#btn_pdse').attr('disabled', 'disabled');
    }

    if(diff < 0){
        $('#totalleave').val('NaN');
        $('#totalleaves').val('NaN');
        $('#btn_pdse').attr('disabled', 'disabled');
    }else if(diff == 0 && get == 0){
        $('#totalleave').val(get + ' day and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').attr('disabled', 'disabled');
    }
    else if(get <= 1 && diff <= 1){
        $('#totalleave').val(get + ' day and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }else if(get <= 1 && diff > 1){
        $('#totalleave').val(get + ' day and ' + diff + ' hours');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }else if(get > 1 && diff <=1){
        $('#totalleave').val(get + ' days and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }
    else{
        $('#totalleave').val(get + ' days and ' + diff + ' hours');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }


}).on("clearDate", function () {
    $("#dpd1").datepicker("setEndDate", null)
})

$('#timefrom').change(function(){
    var startDate = new Date($('#dpd1').val());
    var endDate = new Date($('#dpd2').val());
    var diff = endDate - startDate;
    var get = (Number(diff) / 86400000);
    var startTime = $('#timefrom').val();
    var endTime = $('#timeto').val();
    var st = startTime.split(':');
    var ed = endTime.split(':');
    if ((st[1].split(' '))[1] == 'pm')
        st[0] = parseInt(st[0]) + 12;
    if ((ed[1].split(' '))[1] == 'pm')
        ed[0] = parseInt(ed[0]) + 12;
    st[1] = (st[1].split(' '))[0];
    ed[1] = (ed[1].split(' '))[0];

    var diff = ((ed[0] * 60 + ed[1] * 60) - (st[0] * 60 + st[1] * 60)) / 60;
    if(diff == 0 && get == 0){
        $('#btn_pdse').attr('disabled', 'disabled');
    }
    if(diff < 0){
        $('#totalleave').val('NaN');
        $('#totalleaves').val('NaN');
        $('#btn_pdse').attr('disabled', 'disabled');
    }else if(diff == 0 && get == 0){
        $('#totalleave').val(get + ' day and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').attr('disabled', 'disabled');
    }
    else if(get <= 1 && diff <= 1){
        $('#totalleave').val(get + ' day and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }else if(get <= 1 && diff > 1){
        $('#totalleave').val(get + ' day and ' + diff + ' hours');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }else if(get > 1 && diff <=1){
        $('#totalleave').val(get + ' days and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }
    else{
        $('#totalleave').val(get + ' days and ' + diff + ' hours');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }
});
$('#timeto').change(function(){
    var startDate = new Date($('#dpd1').val());
    var endDate = new Date($('#dpd2').val());
    var diff = endDate - startDate;
    var get = (Number(diff) / 86400000);
    var startTime = $('#timefrom').val();
    var endTime = $('#timeto').val();
    var st = startTime.split(':');
    var ed = endTime.split(':');
    if ((st[1].split(' '))[1] == 'pm')
        st[0] = parseInt(st[0]) + 12;
    if ((ed[1].split(' '))[1] == 'pm')
        ed[0] = parseInt(ed[0]) + 12;
    st[1] = (st[1].split(' '))[0];
    ed[1] = (ed[1].split(' '))[0];

    var diff = ((ed[0] * 60 + ed[1] * 60) - (st[0] * 60 + st[1] * 60)) / 60;

    if(diff < 0){
        $('#totalleave').val('NaN');
        $('#totalleaves').val('NaN');
        $('#btn_pdse').attr('disabled', 'disabled');
    }else if(diff == 0 && get == 0){
        $('#totalleave').val(get + ' day and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').attr('disabled', 'disabled');
    }
    else if(get <= 1 && diff <= 1){
        $('#totalleave').val(get + ' day and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }else if(get <= 1 && diff > 1){
        $('#totalleave').val(get + ' day and ' + diff + ' hours');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }else if(get > 1 && diff <=1){
        $('#totalleave').val(get + ' days and ' + diff + ' hour');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }
    else{
        $('#totalleave').val(get + ' days and ' + diff + ' hours');
        $('#totalleaves').val(get + '.' + diff);
        $('#btn_pdse').removeAttr('disabled');
    }
});
$(document).ready(function () {
    $(".tip-top").tooltip({
        placement: "top"
    }), $(".tip-right").tooltip({
        placement: "right"
    }), $(".tip-bottom").tooltip({
        placement: "bottom"
    }), $(".tip-left").tooltip({
        placement: "left"
    })
})
$(document).ready(function () {

    var menu = $('#prof');
    var origOffsetY = menu.offset().top;

    function scroll() {
        if ($(window).scrollTop() >= origOffsetY) {
            $("#prof").addClass("sticky");
            $("#stat").addClass("static");
        } else {
            $("#prof").removeClass("sticky");
            $("#stat").removeClass("static");
        }


    }
    document.onscroll = scroll;
});
$(".preview-card").hover(function() {
    $(this).find(".details").stop(true, true).fadeIn();
}, function() {
    $(this).find(".details").stop(true, true).fadeOut();
});

jQuery(function (e) {
    e(".commenttext").autoGrowTextArea();
});
jQuery(function (e) {
    e(".text1").autoGrowTextArea()
})
$("#commenttext").on('keyup', function(event) {
    $comment = $('#commenttext').val().length;
    if($comment == 0){
        $('#btn_pdse').attr('disabled', 'disabled');
    }else{
        $('#btn_pdse').removeAttr('disabled');
    }
});

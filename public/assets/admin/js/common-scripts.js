/*---LEFT BAR ACCORDION----*/
$(function () {
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });

});
var Script = function () {
//    sidebar toggle
    $(function () {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#conainer').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }
            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });
    $('.fa-bars').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });
// custom scrollbar
    $("#sidebar").niceScroll({styler: "fb", cursorcolor: "#26a4c3", cursorwidth: '10', cursorborderradius: '10px', background: '#404040', spacebarenabled: false, cursorborder: ''});
    $("html").niceScroll({styler: "fb", cursorcolor: "#26a4c3", cursorwidth: '13', cursorborderradius: '10px', background: '#404040', spacebarenabled: false, cursorborder: '', zindex: '1000'});

// widget tools
    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });
    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });
//    tool tips
    $('.tooltips').tooltip();
//    popovers
    $('.popovers').popover();
// custom bar chart
    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000)
        })
    }
    //////////////////////// plugins
    $("input[type=submit]").click(function () {
        if ($(".style-form").length > 0) {
            if ($(".style-form").valid()) {
                $(".style-form").submit(function () {
                    $("input[type=submit]").attr('disabled', 'true');
                });
            }
        } else {
            $(this).parent("form").submit(function () {
                $("input[type=submit]").attr('disabled', 'true');
            });
        }
    });
    $.validator.addMethod('maxfilesize', function (value, element) {
        var maxsize = $(element).attr('maxlength');
        var field_name = $(element).attr('name');
        if (document.getElementById(field_name).files[0]) {
            var filesize = document.getElementById(field_name).files[0].size;
            if (filesize < maxsize) {
                return true;
            } else {
                return false;
            }
        } else
            return true;
    }, "The file(s) selected exceed the file size limit");
    $.validator.addMethod('integer', function (value) {
        if ($(".integer").val() != "")
            return /^\d+$/.test(value.trim());
        else
            return true;
    }, 'Please enter a valid integer value');
    $.validator.addMethod('facebook_link', function (value) {
        if ($(".facebook_link").val() != "")
            return /^(http|https):\/\/[www]+([-.]{1}[facebook]+)*.[com]+(\/.*)?$/i.test(value.trim());
        else
            return true;
    }, 'Please enter a valid facebook link');
    $.validator.addMethod('youtube_link', function (value) {
        if ($(".youtube_link").val() != "")
            return /^(http|https):\/\/[www]+([-.]{1}[youtube]+)*.[com]+(\/.*)?$/i.test(value.trim());
        else
            return true;
    }, 'Please enter a valid youtube link');
    $.validator.addMethod('twitter_link', function (value) {
        if ($(".twitter_link").val() != "")
            return /^(http|https):\/\/[www]+([-.]{1}[twitter]+)*.[com]+(\/.*)?$/i.test(value.trim());
        else
            return true;
    }, 'Please enter a valid twitter link');
    $.validator.addMethod('required_spinner', function (value) {
        if ($(".required_spinner").val() != "" && $(".required_spinner").val() != "0")
            return true;
        else {
            return false;
        }
    }, 'This field is required');
    $.validator.addMethod('phone', function (value) {
        if ($(".phone").val() != "")
            //return /^([+]\d+|\d+|\d+[-]\d+)$/.test(value.trim());
            return /^([0-9\s\-\+\(\)]*)$/.test(value.trim());
        else
            return true;
    }, 'Please enter a valid phone');
    $.validator.addMethod('float', function (value) {
        if ($(".float").val() != "")
            return /^(\d+[.]\d+)$/.test(value.trim());
        else
            return true;
    }, 'Please enter a valid value');
    $.validator.addMethod('numeric', function (value) {
        console.log("Numeric value: " + $(".numeric").val());
        if ($(".numeric").val() != "")
            return $.isNumeric(value.trim());
        else
            return true;
    }, 'Please enter a valid value');
    $(".popup").click(function () {
        var link_url = $(this).attr("href");
        var title = $(this).attr("title");
        var left = (screen.width / 2) - (800 / 2);
        var top = (screen.height / 2) - (600 / 2);
        window.open(link_url, title, "location=1,status=1,scrollbars=1,width=800,height=600,top=" + top + ", left=" + left);
        return false;
    });
    $(".disabled").click(function () {
        return false;
    });
    $(".main_image").load(function () {
        $(this).css("background", "none");
        $(this).fadeIn(500);
    });
    $('a[data-confirm]').click(function (ev) {
        var href = $(this).attr('href');
        var title = $(this).data("title");
        if (!$('#dataConfirmModal').length) {
            $('body').append('  <div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n\
						  <div class="modal-dialog">\n\
						    <div class="modal-content">\n\
						      <div class="modal-header">\n\
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n\
						        <h4 style="color:#000000" id="myModalLabel">' + title + '</h4>\n\
						      </div>\n\
						      <div class="modal-body">\n\
						        Hi there, I am a Modal Example for Dashio Admin Panel.\n\
						      </div>\n\
						      <div class="modal-footer">\n\
						        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>\n\
						        <a class="btn btn-danger" id="dataConfirmOK">نعم</a>\n\
						      </div>\n\
						    </div>\n\
						  </div>\n\
						</div> ');
        }
        $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    });
    $(".chosen").chosen();
    $(".select_all").click(function () {
        console.log('select all');
        $('.chosen option').prop('selected', true);
        $('.chosen').trigger('chosen:updated');
    });
    $(".deselect_all").click(function () {
        console.log('deselect all');
        $('.chosen option').prop('selected', false);
        $('.chosen').trigger('chosen:updated');
    });
    $(".chosen-container").css("width", "100%");
    $(".disabled a").click(function () {
        return false;
    });
    $(".switch").wrap('<div class="switch" />').parent().bootstrapSwitch();
    $(".timePicker").timepicker({
        autoclose: true,
        minuteStep: 1,
        showSeconds: true
    });
//    $(".datepickerui").datepicker({
//        changeMonth: true,
//        changeYear: true,
//        dateFormat: 'mm-dd-yy'
//    });
//    $(".datepicker2").datepicker({
//        autoclose: true,
//        format: 'mm-dd-yy',
//    });
//
//    $(".twodatepicker2").datepicker({
//        format: 'mm-dd-yy',
//        multidate: 2,
//        multidateSeparator: ','
//    });
    $(".datePicker").daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
        },
        singleDatePicker: true,
        showDropdowns: true
    });
    $(".dateRange").daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            separator: " , "
        },
        showDropdowns: true,
    });
    $(".dateTimePicker").daterangepicker({
        locale: {
            format: 'YYYY-MM-DD h:mm A'
        },
        timePicker: true,
        singleDatePicker: true,
        showDropdowns: true,
    });
    $(".dateTimePickerRange").daterangepicker({
        locale: {
            format: 'YYYY-MM-DD h:mm A',
            separator: " , "
        },
        showDropdowns: true,
        timePicker: true,
    });
    $(".touchSpinner").TouchSpin({
        min: 0,
        max: 10000000000,
        step: 1,
        //decimals: 2,
        boostat: 5,
        // maxboostedstep: 10,
        //postfix: '%'
    });
    $('.tags').tagsinput('add', {
        text: 'some tag',
        trimValue: true,
    });
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            //[groupname, [button list]]
            ['style', ['style']],
            ['style', ['fontname']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            //['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']], // picture
            //['table', ['table']], // no table button
            //['codeview', ['codeview']],
            ['undo', ['undo']],
            ['redo', ['redo']],
            ['fullscreen', ['fullscreen']],
            ['help', ['help']],
        ],
        onpaste: function (e) {
            var thisNote = $(this);
            var updatePastedText = function (someNote) {
                var original = someNote.code();
                var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
                someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
            };
            setTimeout(function () {
                //this kinda sucks, but if you don't do a setTimeout,
                //the function is called before the text is really pasted.
                updatePastedText(thisNote);
            }, 10);
        }
    });
    $('.froala_full').froalaEditor({
        enter: $.FroalaEditor.ENTER_BR
    })
    $('.froala').froalaEditor({
        // toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'bold', 'italic', 'underline', 'undo', 'redo', 'codeView'],
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'fontFamily', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'link', 'insertLink', 'insertHR'],
        enter: $.FroalaEditor.ENTER_BR
    });
    $(".fileinput").fileinput();
    function CleanPastedHTML(input) {
        // 1. remove line breaks / Mso classes
        var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
        var output = input.replace(stringStripper, ' ');
        // 2. strip Word generated HTML comments
        var commentSripper = new RegExp('<!--(.*?)-->', 'g');
        var output = output.replace(commentSripper, '');
        var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>', 'gi');
        // 3. remove tags leave content if any
        output = output.replace(tagStripper, '');
        // 4. Remove everything in between and including tags '<style(.)style(.)>'
        var badTags = ['style', 'script', 'applet', 'embed', 'noframes', 'noscript'];

        for (var i = 0; i < badTags.length; i++) {
            tagStripper = new RegExp('<' + badTags[i] + '.*?' + badTags[i] + '(.*?)>', 'gi');
            output = output.replace(tagStripper, '');
        }
        // 5. remove attributes ' style="..."'
        var badAttributes = ['style', 'start'];
        for (var i = 0; i < badAttributes.length; i++) {
            var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"', 'gi');
            output = output.replace(attributeStripper, '');
        }
        return output;
    }
    //////////////////////////// image button
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });
    $(document).on("click", ".delete_image", function () {
        if (confirm("Are you sure you want to delete this image?")) {
            var href = $(this).attr('href');
            var alertMsg = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Delete successfull</div>';
            $.get(href, function () {
                $("#main-content .mt").prepend(alertMsg);
            });
            $(this).parent().parent().remove();
            window.setTimeout(function () {
                $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
            return false;
        } else {
            console.log('ko');
        }
        return false;
    });
    ////////////////////////////////////'
    $("#checkall").click(function () {
        if ($("#checkall").is(':checked')) {
            $(".checkthis").each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $(".checkthis").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    //////////////////////////////////////////////////////////// end plugin

}();
function alert2(message) {
    if (!$('#dataConfirmModal').length) {
        $('body').append('<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n\
						  <div class="modal-dialog">\n\
						    <div class="modal-content">\n\
                            <div class="modal-header">\n\
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n\
						        <h4 id="myModalLabel">Error Message !</h4>\n\
						      </div>\n\
						      <div class="modal-body">\n\
						        Hi there, I am a Modal Example for Dashio Admin Panel.\n\
						      </div>\n\
						    </div>\n\
						  </div>\n\
						</div> ');
    }
    $('#dataConfirmModal').find('.modal-body').text(message);
    $('#dataConfirmModal').modal({show: true});
    return false;
}
